<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidAuthorName extends InvalidArgumentException
{
    protected $message = 'Author name must have a first and last name';
}
