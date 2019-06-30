<?php

namespace App\Shared\Application\Exception;

use App\Shared\Infrastructure\Ui\Http\InternalApiVerifier;
use App\Shared\Infrastructure\Ui\Http\JsonErrorResponseGenerator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionListener
{
    /** @var JsonErrorResponseGenerator */
    private $jsonErrorResponseGenerator;

    /** @var InternalApiVerifier */
    private $internalApiVerifier;

    public function __construct(
        JsonErrorResponseGenerator $jsonErrorResponseGenerator,
        InternalApiVerifier $internalApiVerifier
    ) {
        $this->jsonErrorResponseGenerator = $jsonErrorResponseGenerator;
        $this->internalApiVerifier = $internalApiVerifier;
    }

    /**
     * @param GetResponseForExceptionEvent $event
     * @throws \Exception
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($this->internalApiVerifier->isInternalApiCall($event->getRequest())) {
            $uuid = Uuid::uuid4();

            $response = $this->jsonErrorResponseGenerator->generateError($event->getException(), $uuid);

            $event->setResponse($response);
        }
    }
}
