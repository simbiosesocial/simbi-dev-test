<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllLoans;

use App\Core\Domain\Library\Entities\Loan;

final class ListAllLoansResponseModel
{
    public function __construct(private array $loans)
    {
    }

    public function getLoans(): array
    {
        return $this->loans;
    }
}
