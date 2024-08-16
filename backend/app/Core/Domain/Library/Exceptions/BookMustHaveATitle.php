<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class BookMustHaveATitle extends DomainException
{
    protected $message = 'Book must have a title';
}
