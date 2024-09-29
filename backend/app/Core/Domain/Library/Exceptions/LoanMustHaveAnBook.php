<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveAnBook extends DomainException
{
    protected $message = 'Loan must have an book';
}
