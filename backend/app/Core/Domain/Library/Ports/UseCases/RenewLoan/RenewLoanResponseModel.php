<?php

namespace App\Core\Domain\Library\Ports\UseCases\RenewLoan;

use App\Core\Domain\Library\Entities\Loan;

final class RenewLoanResponseModel
{
    /**
     * @param Loan $loan
     */
    public function __construct(private Loan $loan)
    {
    }

    /**
     * @return Loan
     */
    public function getLoan(): Loan
    {
        return $this->loan;
    }
}
