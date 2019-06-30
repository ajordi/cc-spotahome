<?php

namespace App\Shared\Infrastructure\Ui\Http;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestListener
{
    /**
     * @param GetResponseEvent $event
     * @throws \Exception
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        /** @var Request $request */
        $request = $event->getRequest();

        if ($request->isMethod('post') && null === $request->request->get('request_id')) {
            $request->request->set('request_id', (string) Uuid::uuid4());
        }
    }
}
