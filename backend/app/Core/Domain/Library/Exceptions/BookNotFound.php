<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class BookNotFound extends DomainException
{
    protected $message = 'Book not found';
}
