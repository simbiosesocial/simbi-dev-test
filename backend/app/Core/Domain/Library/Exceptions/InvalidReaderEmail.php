<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class InvalidReaderEmail extends InvalidArgumentException
{
    protected $message = 'Reader email must have valid format';
}
