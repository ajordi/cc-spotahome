<?php

namespace App\Shared\Application\Bus\Query;

use App\Shared\Application\Exception\QueryResponseNotFoundException;

interface QueryResponseRepository
{
    public function save(string $id, array $data);

    /**
     * @param string $id
     * @return array
     * @throws QueryResponseNotFoundException
     */
    public function get(string $id): array;
}
