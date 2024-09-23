<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Core\Domain\Library\Ports\Persistence\LoanRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\LoanMapper;
use DateTime;

final class LoanEloquentRepository implements LoanRepository
{
    public function createOne(DomainLoan $loan): DomainLoan
    {
        $eloquentLoan = LoanMapper::toEloquentEntity($loan);

        $eloquentLoan->save();

        return $loan;
    }

    public function getAll(): array
    {
        $eloquentLoans = EloquentLoan::get()->all();

        $convertedDomainLoans = LoanMapper::toDomainEntities($eloquentLoans);

        return $convertedDomainLoans;
    }

    public function isBookLoaned(string $book_id): bool
    {
        $book = EloquentLoan::where([
            ["book_id" => $book_id],
            ["is_book_back_to_library" => true],
        ])->exists();

        return $book;
    }

    public function isBookOverdue(string $book_id): bool
    {

        $eloquentLoan = EloquentLoan::where([
            ["book_id" => $book_id],
            ["is_book_back_to_library" => false], 
        ])->first();

       
        if (empty($eloquentLoan)) {
            return false;
        }

       
        $today = new DateTime("today");

        
        $isBookOverdue = $eloquentLoan->endLoanDate < $today;

        return $isBookOverdue;
    }

    public function deleteLoan(string $id): void
    {
        EloquentLoan::where(['id' => $id])->delete();
    }
}