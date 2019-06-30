<?php

namespace App\Shared\Domain\Exception;

class DomainException extends \Exception implements ExceptionInterface
{
    /** @var string */
    protected $message = 'General Domain Exception';
}
