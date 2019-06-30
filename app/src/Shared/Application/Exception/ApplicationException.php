<?php

namespace App\Shared\Application\Exception;

use App\Shared\Domain\Exception\ExceptionInterface;
use Exception;

class ApplicationException extends Exception implements ExceptionInterface
{
    /** @var string */
    protected $message = 'General Application Exception';
}
