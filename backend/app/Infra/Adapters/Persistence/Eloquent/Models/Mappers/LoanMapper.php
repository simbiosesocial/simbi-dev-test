<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models\Mappers;

use App\Core\Domain\Library\Entities\Loan as DomainLoan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan as EloquentLoan;
use DateTime;

final class LoanMapper
{
    /**
     * @param DomainLoan $loan
     *
     * @return EloquentLoan
     */
    public static function toEloquentModel(DomainLoan $loan): EloquentLoan
    {
        return new EloquentLoan([
            'id' => $loan->id,
            'book_id' => $loan->bookId,
            'loan_date' => $loan->loanDate,
            'return_date' => $loan->returnDate,
            'returned_at' => $loan->returnedAt,
            'status' => $loan->status,
            'renewal_count' => $loan->renewalCount,
            'last_renewed_at' => $loan->lastRenewedAt,
            'created_at' => $loan->createdAt,
            'updated_at' => $loan->updatedAt,
        ]);
    }

    /**
     * @param EloquentLoan $loan
     * @param bool $withRelations
     *
     * @return DomainLoan
     */
    public static function toDomainEntity(EloquentLoan $loan, bool $withRelations = true): DomainLoan
    {
        $domainLoan = new DomainLoan(
            id: $loan->id,
            bookId: $loan->book_id,
            loanDate: $loan->loan_date ? new DateTime($loan->loan_date) : null,
            returnDate: $loan->return_date ? new DateTime($loan->return_date) : null,
            returnedAt: $loan->returned_at ? new DateTime($loan->returned_at) : null,
            status: $loan->status,
            renewalCount: $loan->renewal_count,
            lastRenewedAt: $loan->last_renewed_at ? new DateTime($loan->last_renewed_at) : null,
            createdAt: new DateTime($loan->created_at),
            updatedAt: new DateTime($loan->updated_at),
        );

        if ($withRelations && ! empty($loan->book)) {
            $domainLoan->addBook(BookMapper::toDomainEntity($loan->book));
        }

        return $domainLoan;
    }

    /**
     * @param array<EloquentLoan> $loans
     *
     * @return array<DomainLoan>
     */
    public static function toManyDomainEntities(array $loans): array
    {
        return array_map(static fn($loan) => self::toDomainEntity($loan), $loans);
    }
}
