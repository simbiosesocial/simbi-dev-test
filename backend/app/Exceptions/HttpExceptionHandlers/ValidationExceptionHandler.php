<?php

namespace App\Exceptions\HttpExceptionHandlers;

use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ValidationExceptionHandler extends HttpHandler
{
    protected string $className = ValidationException::class;
    protected int $statusCode = ResponseAlias::HTTP_BAD_REQUEST;
}
