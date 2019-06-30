<?php

namespace App\Shared\Application\Bus\Query;

interface Query
{
    public static function fromArray(array $data): self;

    public function serialize(): array;
}
