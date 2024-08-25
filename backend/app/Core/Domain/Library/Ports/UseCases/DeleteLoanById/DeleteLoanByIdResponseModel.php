<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoanById;

use App\Core\Domain\Library\Entities\Loan;

final class DeleteLoanByIdResponseModel
{
    /**
     * @param Loan $loan
     */
    public function __construct(private string $loanId)
    {
    }

    /**
     * @return string
     */
    public function getLoanId(): string
    {
        return $this->loanId;
    }
}
