<?php

namespace App\Shared\Application\Bus\Query;

interface QueryBus
{
    /**
     * @param Query $query
     * @return Response|null
     * @throws \App\Shared\Application\Exception\Bus\Query\QueryHandlerNotFoundException
     */
    public function ask(Query $query): ?Response;
}
