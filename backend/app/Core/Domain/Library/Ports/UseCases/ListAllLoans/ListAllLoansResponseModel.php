<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllLoans;

use App\Core\Domain\Library\Entities\Loan;

final class ListAllLoansResponseModel
{
    /**
     * @param array<Loan> $loans
     */
    public function __construct(private array $loans)
    {
    }

    /**
     * @return array<Loan>
     */
    public function getLoans(): array
    {
        return $this->loans;
    }
}
