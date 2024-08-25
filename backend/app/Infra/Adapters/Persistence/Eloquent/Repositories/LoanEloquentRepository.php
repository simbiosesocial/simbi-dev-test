<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\LoanMapper;
use DateTime;

final class LoanEloquentRepository implements LoanRepository
{
/**
     * @param DomainLoan $loan
     *
     * @return DomainLoan
     */
    public function createOne(DomainLoan $loan): DomainLoan {
        $eloquentLoan = LoanMapper::toEloquentEntity($loan);

        $eloquentLoan->save();

        return $loan;
    }

    /**
     * @return DomainLoan[]
     */
    public function getAll(): array {
        $eloquentLoans = EloquentLoan::get()->all();

        $convertedDomainLoans = LoanMapper::toDomainEntities($eloquentLoans);

        return $convertedDomainLoans;
    }

    /**
     * @param string $book_id
     *
     * @return bool;
     */
    public function isBookLoaned(string $book_id): bool {
        $book = EloquentLoan::where([
            ["book_id" => $book_id],
            ["is_book_back_to_library" => true],
        ])->exists();

        return $book;
    }

    /**
     * @param string $book_id
     *
     * @return bool
     */
    public function isBookLate(string $book_id): bool {
        $eloquentLoan = EloquentLoan::where([
            ["book_id" => $book_id],
            ["is_book_back_to_library" => false],
        ])->first();

        if (empty($eloquentLoan)) return false;

        $today = new DateTime("today");
        $isBookLate = $eloquentLoan->endLoanDate > $today;

        return $isBookLate;
    }

    /**
     * @param DomainLoan $loan
     *
     * @return void
     */
    public function deleteLoanById(string $id): void
    {
        EloquentLoan::where(['id' => $id])->delete();
    }
}
