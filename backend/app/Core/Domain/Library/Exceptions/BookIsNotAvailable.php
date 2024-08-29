<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class BookIsNotAvailable extends DomainException
{
    protected $message = 'Book is not available to loan';
}
