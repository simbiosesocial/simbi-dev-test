<?php

namespace App\Core\Domain\Library\Ports\UseCases\FinalizeLoan;

use App\Core\Domain\Library\Entities\Loan;

final class FinalizeLoanResponseModel
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
