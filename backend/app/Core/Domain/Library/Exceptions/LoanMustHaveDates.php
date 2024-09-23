<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveDates extends DomainException
{
    protected $message = 'Loan must have loan and return dates. Expected (YYYY-MM-DD)';
}