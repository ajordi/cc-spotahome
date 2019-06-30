<?php

namespace App\Shared\Infrastructure\Http;

use App\Shared\Infrastructure\Storage\File;

class FileFetcher
{
    private $tempDir;

    public function __construct(string $tempDir)
    {
        $this->tempDir = $tempDir;
    }

    public function fetch(Url $url): File
    {
        if (!$url->isRemote()) {
            return new File($url, mime_content_type((string) $url));
        }

        $filename = sprintf('%s/%s', $this->tempDir, pathinfo((string) $url, \PATHINFO_BASENAME));
        file_put_contents($filename, file_get_contents((string) $url));

        return new File(new Url($filename), mime_content_type($filename));
    }
}
