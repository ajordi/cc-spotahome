<?php

namespace App\Shared\Infrastructure\Http;

class Url
{
    const ALLOWED_PREFIXES = ['http://', 'https://', '://'];

    /** @var string */
    private $path;

    /** @var bool */
    private $isRemote;

    public function __construct(string $path)
    {
        $this->isRemote = $this->isPathRemote($path);
        $this->path = $path;
    }

    public function __toString()
    {
        return $this->path;
    }

    public function value()
    {
        return (string) $this;
    }


    public function isRemote(): bool
    {
        return $this->isRemote;
    }

    private function isPathRemote(string $path): bool
    {
        foreach (self::ALLOWED_PREFIXES as $prefix) {
            if (0 === strpos($path, $prefix)) {
                return true;
            }
        }

        return false;
    }
}
