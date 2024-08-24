<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanMustHaveBookId extends DomainException
{
    protected $message = 'Loan must have a book id';
}
