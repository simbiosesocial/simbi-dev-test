<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidUserEmail extends InvalidArgumentException
{
    protected $message = 'Invalid User e-mail!';
}
