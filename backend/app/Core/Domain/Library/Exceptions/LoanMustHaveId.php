<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveId extends DomainException
{
    protected $message = 'Loan must have an id';
}