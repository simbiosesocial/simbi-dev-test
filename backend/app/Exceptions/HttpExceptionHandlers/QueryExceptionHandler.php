<?php

namespace App\Exceptions\HttpExceptionHandlers;

use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class QueryExceptionHandler extends HttpHandler
{
    protected string $className = QueryException::class;
    protected int $statusCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
}
