<?php

namespace App\Shared\Application\Exception\Bus\Query;

use App\Shared\Application\Exception\ApplicationException;

final class QueryHandlerNotFoundException extends ApplicationException
{
    public function __construct(string $queryHandler)
    {
        parent::__construct(sprintf('Query handler %s not found', $queryHandler));
    }
}
