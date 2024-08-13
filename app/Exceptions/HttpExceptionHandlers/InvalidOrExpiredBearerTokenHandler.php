<?php

namespace App\Exceptions\HttpExceptionHandlers;

use App\Exceptions\InvalidOrExpiredBearerToken;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class InvalidOrExpiredBearerTokenHandler extends HttpHandler
{
    protected string $className = InvalidOrExpiredBearerToken::class;
    protected int $statusCode = ResponseAlias::HTTP_FORBIDDEN;
}
