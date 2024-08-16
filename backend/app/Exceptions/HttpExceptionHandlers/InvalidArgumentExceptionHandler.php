<?php

namespace App\Exceptions\HttpExceptionHandlers;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class InvalidArgumentExceptionHandler extends HttpHandler
{
    protected string $className = \InvalidArgumentException::class;
    protected int $statusCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
}
