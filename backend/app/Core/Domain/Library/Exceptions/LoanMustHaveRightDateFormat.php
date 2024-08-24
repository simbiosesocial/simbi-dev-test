<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveRightDateFormat extends DomainException
{
    protected $message = 'Loan must have a right date format. Expected (YYYY-MM-DD)';
}
