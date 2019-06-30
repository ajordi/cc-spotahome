<?php

namespace App\PL\Homes\Application\Find;

use App\PL\Homes\Domain\HomeRepository;
use App\Shared\Application\Bus\Query\SimpleQueryHandler;

class FindHomesQueryHandler extends SimpleQueryHandler
{
    /** @var HomeRepository */
    private $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    public function handleFindHomesQuery(FindHomesQuery $findHomes) : HomeResponseCollection
    {
        $homes = $this->homeRepository->fetch($findHomes->url(), $findHomes->field(), $findHomes->direction());
        $homeResponseConverter = new HomeResponseConverter();

        return $homeResponseConverter($homes);
    }
}
