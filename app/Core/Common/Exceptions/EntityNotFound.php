<?php

namespace App\Core\Common\Exceptions;

use Exception;
use ReflectionClass;
use ReflectionException;
use Throwable;

final class EntityNotFound extends Exception
{
    /**
     * @param string $className
     * @param int $code
     * @param Throwable|null $previous
     *
     * @throws ReflectionException
     */
    public function __construct(string $className, int $code = 0, ?Throwable $previous = null)
    {
        $reflect = new ReflectionClass($className);
        parent::__construct($reflect->getShortName() . ' not found.', $code, $previous);
    }
}
