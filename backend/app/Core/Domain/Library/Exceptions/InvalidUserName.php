<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidUserName extends InvalidArgumentException
{
    protected $message = 'Invalid name format!';
}
