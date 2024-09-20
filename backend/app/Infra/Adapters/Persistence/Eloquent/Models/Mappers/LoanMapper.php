<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models\Mappers;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;
use DateTime;

final class LoanMapper
{
    public static function toDomainEntity(EloquentLoan $eloquentLoan, bool $withRelations = true): DomainLoan
    {
        $domainLoan = new DomainLoan(
            id: $eloquentLoan->id,
            book: null,
            startLoanDate: DomainLoan::getFormatedDateFromDateString($eloquentLoan->start_loan_date),
            finalLoanDate: DomainLoan::getFormatedDateFromDateString($eloquentLoan->end_loan_date),
        );

        if ($withRelations) {
            $domainLoan->book = BookMapper::toDomainEntity($eloquentLoan->book);
        }

        return $domainLoan;
    }

    public static function toDomainEntities(array $eloquentLoans)
    {
        return array_map(static fn($loan) => self::toDomainEntity($loan), $eloquentLoans);
    }

    public static function toEloquentEntity(DomainLoan $domainLoan): EloquentLoan
    {
        $eloquentLoan = new EloquentLoan([
            'id' => $domainLoan->id,
            'book_id' => $domainLoan->book->id,
            'start_loan_date' => $domainLoan->startLoanDate,
            'end_loan_date' => $domainLoan->finalLoanDate,
        ]);

        return $eloquentLoan;
    }
}