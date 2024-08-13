<?php

namespace App\Exceptions\HttpExceptionHandlers;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Throwable;

abstract class HttpHandler
{
    /**
     * @var HttpHandler|null
     */
    protected ?HttpHandler $next = null;

    /**
     * @var string
     */
    protected string $className;
    /**
     * @var int
     */
    protected int $statusCode = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @param HttpHandler $nextHttpException
     *
     * @return HttpHandler
     */
    public function next(HttpHandler $nextHttpException): HttpHandler
    {
        $this->next = $nextHttpException;
        return $nextHttpException;
    }

    /**
     * @param Throwable $e
     *
     * @return int
     */
    public function getStatusCode(Throwable $e): int
    {
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }
        if (is_a($e, $this->className)) {
            return $this->statusCode;
        }
        if ($this->next === null) {
            return ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
        }

        return $this->next->getStatusCode($e);
    }
}
