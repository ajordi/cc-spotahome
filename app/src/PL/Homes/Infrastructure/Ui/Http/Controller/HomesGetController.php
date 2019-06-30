<?php

namespace App\PL\Homes\Infrastructure\Ui\Http\Controller;

use App\PL\Homes\Application\Find\FindHomesQuery;
use App\PL\Homes\Domain\HomeRepository;
use App\Shared\Application\Bus\Query\QueryBus;
use App\Shared\Application\Bus\Query\QueryResponseRepository;
use App\Shared\Infrastructure\Api\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;

class HomesGetController extends ApiController
{
    /** @var string */
    private $resourcePath;

    public function __construct(QueryBus $queryBus, QueryResponseRepository $queryRepository, string $resourcePath)
    {
        parent::__construct($queryBus, $queryRepository);
        $this->resourcePath = $resourcePath;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse|null
     * @throws \App\Shared\Application\Exception\Bus\Query\QueryHandlerNotFoundException
     */
    public function execute(Request $request)
    {
        /* @uses \App\PL\Homes\Application\Find\FindHomesQueryHandler::handleFindHomesQuery() */
        return $this->ask(FindHomesQuery::fromArray([
            'url' => $this->resourcePath,
            'field' => $request->get('field', 'id'),
            'direction' => $request->get('direction', HomeRepository::ASC)
        ]));
    }
}
