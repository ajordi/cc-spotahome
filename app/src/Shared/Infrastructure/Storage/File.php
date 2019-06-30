<?php

namespace App\Shared\Infrastructure\Storage;

use App\Shared\Infrastructure\Http\Url;

class File
{
    private $path;

    private $mimeType;

    public function __construct(Url $path, string $mimeType)
    {
        $this->path = $path;
        $this->mimeType = $mimeType;
    }

    public function path(): Url
    {
        return $this->path;
    }

    public function mimeType(): string
    {
        return $this->mimeType;
    }
}
