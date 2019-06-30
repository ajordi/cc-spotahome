<?php

namespace App\Shared\Infrastructure\Exception;

class InvalidPersistenceException extends InfrastructureException
{
    public function __construct($message)
    {
        parent::__construct(sprintf('Invalid persistence exception: %d', $message));
    }
}
