<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveControlDates extends DomainException
{
    protected $message = 'Loan must have both start and end dates. Expected (YYYY-MM-DD)';
}
