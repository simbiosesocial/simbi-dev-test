<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\LoanMapper;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;


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

    /**
     *
     * @return array<Loan>
     */
    public function getAll(): array
    {
        $books = EloquentLoan::with(['book'])
            ->get()
            ->all();

        if (empty($books)) {
            return [];
        }

        return LoanMapper::toManyDomainEntities($books);
    }
}
