<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class LoanNotFound extends DomainException
{
    protected $message = 'Loan not found';

    public function __construct()
    {
        parent::__construct($this->message);
    }
}
