<?php

namespace App\Shared\Application\Service\Generator;

interface HashGenerator
{
    public function make(string $salt = ''): string;
}
