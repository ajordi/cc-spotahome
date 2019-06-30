<?php

namespace App\PL\Homes\Infrastructure\Persistence;

use App\PL\Homes\Application\Find\FindHomesQuery;
use App\PL\Homes\Domain\Home;
use App\PL\Homes\Domain\HomeRepository;
use App\Shared\Infrastructure\Http\FileFetcher;
use App\Shared\Infrastructure\Http\Url;
use App\Shared\Infrastructure\Service\Generator\ArrayGenerator;
use App\Shared\Infrastructure\Service\Sorter\ArraySorter;

class XMLHomeRepository implements HomeRepository
{
    /** @var FileFetcher */
    private $fetcher;

    public function __construct(FileFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    /**
     * @inheritDoc
     */
    public function fetch(Url $url, string $column, int $direction): array
    {
        $file = $this->fetcher->fetch($url);
        $homesData = ArrayGenerator::fromXML(simplexml_load_file($file->path()), FindHomesQuery::FIELDS);
        $homesDataSorted = ArraySorter::fromMultiArray($column, $homesData, $direction);

        return array_map(function ($homeData) {
            return Home::fromArray($homeData);
        }, $homesDataSorted);
    }
}
