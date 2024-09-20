<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveRightDateFormat extends DomainException
{
    protected $message = 'Expected date format: (YYYY-MM-DD)';
}