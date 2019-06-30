<?php

namespace App\Shared\Application\Bus\Query;

interface Response
{
    public function serialize(): array;
}
