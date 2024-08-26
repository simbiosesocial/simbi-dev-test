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
        $loans = EloquentLoan::with(['book'])
            ->get()
            ->all();

        if (empty($loans)) {
            return [];
        }

        return LoanMapper::toManyDomainEntities($loans);
    }

    /**
     *
     *  @param uuid $id
     *
     * @return Loan
     */
    public function findById(string $id): ?Loan
    {
        $loan = EloquentLoan::with(['book'])->find($id);

        if (!$loan) {
            return null;
        }

        return LoanMapper::toDomainEntity($loan);
    }

    /**
     * @param string $id,
     * @param string $status,
     * @param DateTime $returnedAt,
     *
     * @return Loan
     */
    public function finalize($id, $status, $returnedAt): Loan
    {
        EloquentLoan::where('id', $id)->update([
            'status' => $status,
            'returned_at' => $returnedAt->format('Y-m-d H:i:s')
        ]);

        $loan = EloquentLoan::findOrFail($id);
        return LoanMapper::toDomainEntity($loan);
    }

    /**
     * @param string $id,
     * @param string $status,
     * @param DateTime $lastRenewedAt,
     * @param DateTime $returnDate,
     *
     * @return Loan
     */
    public function renew($id, $status, $lastRenewedAt, $returnDate): Loan
    {

        $loan = EloquentLoan::findOrFail($id);
        $loan->status = $status;
        $loan->last_renewed_at = $lastRenewedAt->format('Y-m-d H:i:s');
        $loan->return_date = $returnDate->format('Y-m-d H:i:s');
        $loan->increment('renewal_count');
        $loan->save();

        return LoanMapper::toDomainEntity($loan);
    }
}
