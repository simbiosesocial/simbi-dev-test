<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Loan;
use DateTime;

interface LoanRepository
{
    /**
     * @param Loan $loan
     *
     * @return Loan
     */
    public function create(Loan $loan): Loan;

    /**
     *
     * @return array<Loan>
     */
    public function getAll(): array;

    /**
     * @param string $id,
     *
     * @return Loan
     */
    public function findById(string $id): ?Loan;

    /**
     * @param string $id,
     * @param string $returnedAt,
     *
     * @return Loan
     */
    public function finalize(string $id, string $returnedAt): Loan;

    /**
     * @param string $id,
     * @param string $lastRenewedAt,
     * @param string $returnDate,
     *
     * @return Loan
     */
    public function renew(
        string $id,
        string $lastRenewedAt,
        string $returnDate,
    ): Loan;
}
