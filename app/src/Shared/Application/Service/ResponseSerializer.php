<?php

namespace App\Shared\Application\Service;

use App\Shared\Application\Bus\Query\Response;

class ResponseSerializer
{
    public static function serialize($responses): array
    {
        if (false === is_array($responses)) {
            return static::serializeResponse($responses);
        }

        return array_map(function (Response $response) {
            return static::serializeResponse($response);
        }, $responses);
    }

    private static function serializeResponse(Response $response): array
    {
        return $response->serialize();
    }
}
