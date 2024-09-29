<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;
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

    /**
     * @return array<Loan>
     */
    public function getAll(): array
    {
        $loans = EloquentLoan::with(['book'])
            ->get()
            ->all();

        if (empty($loans)) {
            return [];
        }

        return LoanMapper::toManyDomainEntities($loans);
    }

    /**
     * @param string $authorId
     *
     * @return array<Book>
     */
    public function getLoansByBookId(string $bookId): array
    {
        $eloquentLoans = EloquentLoan::where(['book_id' => $bookId])
            ->with(['book'])
            ->get()
            ->all();

        if (empty($eloquentLoans)) {
            return [];
        }

        return LoanMapper::toManyDomainEntities($eloquentLoans);
    }
}
