<?php

namespace App\Shared\Infrastructure\Exception;

use Exception;

class FileNotExistException extends Exception
{
    /** @var string  */
    protected $message = 'File not exist';
}
