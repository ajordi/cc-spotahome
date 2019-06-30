<?php

namespace App\Shared\Application\Service;

use Ramsey\Uuid\UuidInterface;

class ErrorBuilder
{
    public function build(\Throwable $e, UuidInterface $uuid = null): array
    {
        return [
            'uuid' => $uuid ?? 'not traced error',
            'code' => $e->getCode(),
            'message' => $e->getMessage(),
        ];
    }
}
