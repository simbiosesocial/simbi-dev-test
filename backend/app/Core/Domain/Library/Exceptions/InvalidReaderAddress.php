<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidReaderAddress extends InvalidArgumentException
{
    protected $message = 'Invalid reader address';
}