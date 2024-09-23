<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveValidDate extends DomainException
{
    protected $message = 'Expected date format: (YYYY-MM-DD)';
}
