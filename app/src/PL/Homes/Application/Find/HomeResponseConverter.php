<?php

namespace App\PL\Homes\Application\Find;

use App\PL\Homes\Domain\Home;

class HomeResponseConverter
{
    public function __invoke(array $homes): HomeResponseCollection
    {
        return new HomeResponseCollection(array_map(function (Home $home) {
            return new HomeResponse(
                $home->homeId()->value(),
                $home->title()->value(),
                $home->url()->value(),
                $home->city()->value()
            );
        }, $homes));
    }
}
