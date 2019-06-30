<?php

namespace App\PL\Homes\Application\Find;

use App\Shared\Application\Bus\Query\ResponseCollection;

class HomeResponseCollection extends ResponseCollection
{
    protected function type(): string
    {
        return HomeResponse::class;
    }

    public function serialize(): array
    {
        return array_map(function (HomeResponse $homeResponse) {
            return $homeResponse->serialize();
        }, $this->items());
    }
}
