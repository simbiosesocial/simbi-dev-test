<?php

namespace App\Exceptions\HttpExceptionHandlers;

use App\Core\Common\Exceptions\EntityNotFound;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class EntityNotFoundHandler extends HttpHandler
{
    protected string $className = EntityNotFound::class;
    protected int $statusCode = ResponseAlias::HTTP_NOT_FOUND;
}
