<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class AuthorNotFound extends DomainException
{
    protected $message = 'Author not found';
}
