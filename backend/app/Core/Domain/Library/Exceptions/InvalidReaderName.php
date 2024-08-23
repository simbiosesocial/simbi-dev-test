<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidReaderName extends InvalidArgumentException
{
    protected $message = 'Reader name must have valids (string) first and last name';
}
