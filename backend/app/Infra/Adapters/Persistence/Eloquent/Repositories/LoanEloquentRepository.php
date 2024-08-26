<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\LoanMapper;

final class LoanEloquentRepository implements LoanRepository
{
    /**
     * @param Loan $loan
     *
     * @return Loan
     */
    public function create(Loan $loan): Loan
    {
        $eloquentLoan = LoanMapper::toEloquentModel($loan);
        $eloquentLoan->save();

        return LoanMapper::toDomainEntity($eloquentLoan);
    }
}
