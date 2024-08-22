<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveABook extends DomainException
{
    protected $message = 'Loan must have a book';
}
