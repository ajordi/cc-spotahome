<?php

namespace App\Shared\Infrastructure\Ui\Http;

use App\Shared\Application\Exception\ApplicationException;
use App\Shared\Application\Service\ErrorBuilder;
use App\Shared\Domain\Exception\DomainException;
use App\Shared\Domain\Exception\ExceptionInterface;
use App\Shared\Infrastructure\Exception\InfrastructureException;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonErrorResponseGenerator
{
    /** @var ErrorBuilder  */
    private $errorBuilder;

    public function __construct(ErrorBuilder $errorBuilder)
    {
        $this->errorBuilder = $errorBuilder;
    }

    public function generateError(\Throwable $e, UuidInterface $uuid): JsonResponse
    {
        switch (true) {
            case $e instanceof DomainException:
            case $e instanceof ApplicationException:
            case $e instanceof InfrastructureException:
                $jsonResponse = $this->createBadRequestResponse($e, $uuid);
                break;
            default:
                $jsonResponse = $this->createUnexpectedResponse($e, $uuid);
        }

        return $jsonResponse;
    }

    private function createBadRequestResponse(
        ExceptionInterface $e,
        UuidInterface $uuid
    ): JsonResponse {
        return JsonResponse::create([$this->errorBuilder->build($e, $uuid)], Response::HTTP_BAD_REQUEST);
    }

    private function createUnexpectedResponse(
        \Throwable $e,
        UuidInterface $uuid,
        int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return JsonResponse::create([$this->errorBuilder->build($e, $uuid)], $statusCode);
    }
}
