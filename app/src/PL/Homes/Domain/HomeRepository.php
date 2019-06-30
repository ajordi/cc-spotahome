<?php

namespace App\PL\Homes\Domain;

use App\Shared\Infrastructure\Http\Url;

interface HomeRepository
{
    public const ASC = 'ASC';

    public const DESC = 'DESC';

    /**
     * @param Url $url
     * @param string $column
     * @param int $direction
     * @return Home[]
     */
    public function fetch(Url $url, string $column, int $direction): array;
}
