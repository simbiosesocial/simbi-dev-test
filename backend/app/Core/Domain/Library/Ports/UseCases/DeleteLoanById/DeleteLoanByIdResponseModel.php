<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoanById;

use App\Core\Domain\Library\Entities\Loan;

final class DeleteLoanByIdResponseModel
{
    public function __construct(private string $loanId)
    {
    }

    public function getLoanId(): string
    {
        return $this->loanId;
    }
}