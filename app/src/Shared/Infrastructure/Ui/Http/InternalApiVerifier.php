<?php

namespace App\Shared\Infrastructure\Ui\Http;

use Symfony\Component\HttpFoundation\Request;

class InternalApiVerifier
{
    const INTERNAL_API_CONTEXT = '/api/v1';

    public function isInternalApiCall(Request $request): bool
    {
        $uri = $request->getUri();

        return $this->isApiContext($uri);
    }

    private function isApiContext(string $uri)
    {
        return strpos($uri, self::INTERNAL_API_CONTEXT) !== false;
    }
}
