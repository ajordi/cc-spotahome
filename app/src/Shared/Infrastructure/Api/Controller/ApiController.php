<?php

namespace App\Shared\Infrastructure\Api\Controller;

use App\Shared\Application\Bus\Query\Query;
use App\Shared\Application\Bus\Query\QueryBus;
use App\Shared\Application\Bus\Query\QueryResponseRepository;
use App\Shared\Application\Exception\QueryResponseNotFoundException;
use App\Shared\Application\Service\ResponseSerializer;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class ApiController
{
    /** @var QueryBus */
    private $queryBus;

    /** @var QueryResponseRepository */
    private $queryRepository;

    public function __construct(QueryBus $queryBus, QueryResponseRepository $queryRepository)
    {
        $this->queryBus = $queryBus;
        $this->queryRepository = $queryRepository;
    }

    protected function ask(Query $query): ?JsonResponse
    {
        $hash = $this->generateQueryHash($query);
        try {
            $data = $this->queryRepository->get($hash);
        } catch (QueryResponseNotFoundException $e) {
            $data = ResponseSerializer::serialize($this->queryBus->ask($query));
            $this->queryRepository->save($hash, $data);
        }
        return new JsonResponse($data);
    }

    private function generateQueryHash(Query $query): string
    {
        return md5(json_encode($query->serialize()));
    }
}
