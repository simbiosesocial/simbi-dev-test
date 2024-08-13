<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class BookMustHaveAPublisher extends DomainException
{
    protected $message = 'Book must have a publisher';
}
