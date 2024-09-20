<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidReaderEmail extends InvalidArgumentException
{
    protected $message = 'Invalid reader e-mail!';
}