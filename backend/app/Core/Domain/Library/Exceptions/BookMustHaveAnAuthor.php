<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class BookMustHaveAnAuthor extends DomainException
{
    protected $message = 'Book must have an author';
}
