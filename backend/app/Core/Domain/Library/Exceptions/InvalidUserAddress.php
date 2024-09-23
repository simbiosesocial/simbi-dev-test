<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidUserAddress extends InvalidArgumentException
{
    protected $message = 'Invalid User address';
}
