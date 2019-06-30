<?php

namespace App\Shared\Infrastructure\Exception;

use App\Shared\Domain\Exception\ExceptionInterface;
use Exception;

class InfrastructureException extends Exception implements ExceptionInterface
{
    protected $message = 'General Infrastructure Exception';
}
