<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveAnInitDate extends DomainException
{
    protected $message = 'Loan must have an init date (loanDate)';
}
