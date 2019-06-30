<?php

namespace App\Shared\Infrastructure\Persistence\Query;

use App\Shared\Application\Bus\Query\QueryResponseRepository;
use App\Shared\Application\Exception\QueryResponseNotFoundException;
use Predis\ClientInterface;

class RedisQueryResponseRepository implements QueryResponseRepository
{
    /** @var ClientInterface */
    private $client;

    /** @var int */
    private $ttl;

    public function __construct(ClientInterface $client, int $ttl)
    {
        $this->client = $client;
        $this->ttl = $ttl;
    }

    public function save(string $id, array $data)
    {
        $this->client->setex(
            $id,
            $this->ttl,
            json_encode($data)
        );
    }

    /**
     * @inheritDoc
     */
    public function get(string $id): array
    {

        if ($data = json_decode($this->client->get($id))) {
            return $data;
        }

        throw new QueryResponseNotFoundException();
    }
}
