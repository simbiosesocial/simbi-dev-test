<?php

namespace App\Core\Domain\Library\Exceptions;

use App\Exceptions\HttpExceptionHandlers\EntityNotFoundHandler;


final class BookNotFound extends EntityNotFoundHandler
{
    protected $message = 'Book not found';
}
