<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoan;

use App\Core\Domain\Library\Entities\Loan;

final class DeleteLoanResponseModel
{
    public function __construct(private string $loanId)
    {
    }

    public function getLoanId(): string
    {
        return $this->loanId;
    }
}
