<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class AuthorIdIsRequired extends InvalidArgumentException
{
    protected $message = 'Author Id is required';
}
