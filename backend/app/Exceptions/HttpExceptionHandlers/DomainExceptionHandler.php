<?php

namespace App\Exceptions\HttpExceptionHandlers;

use DomainException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DomainExceptionHandler extends HttpHandler
{
    protected string $className = DomainException::class;
    protected int $statusCode = ResponseAlias::HTTP_BAD_REQUEST;
}
