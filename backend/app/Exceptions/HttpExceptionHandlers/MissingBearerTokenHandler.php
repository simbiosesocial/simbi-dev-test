<?php

namespace App\Exceptions\HttpExceptionHandlers;

use App\Exceptions\MissingBearerToken;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class MissingBearerTokenHandler extends HttpHandler
{
    protected string $className = MissingBearerToken::class;
    protected int $statusCode = ResponseAlias::HTTP_UNAUTHORIZED;
}
