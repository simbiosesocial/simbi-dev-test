<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

use App\Core\Domain\Library\Entities\Loan;

final class CreateLoanResponseModel
{
    public function __construct(private Loan $loan)
    {
    }

    public function getLoan(): Loan
    {
        return $this->loan;
    }
}