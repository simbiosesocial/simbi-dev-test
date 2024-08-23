<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidReaderAddress extends InvalidArgumentException
{
    protected $message = 'Reader Address must have valids (string) zip code and house number';
}
