<?php

namespace App\Core\Domain\Library\Exceptions;

use InvalidArgumentException;

final class LoanIdIsRequired extends InvalidArgumentException
{
    protected $message = 'Loan Id is required';
}
