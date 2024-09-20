<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidReaderName extends InvalidArgumentException
{
    protected $message = 'Invalid name format!';
}