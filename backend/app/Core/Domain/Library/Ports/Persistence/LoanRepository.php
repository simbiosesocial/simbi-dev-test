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
     * @param string $status,
     * @param DateTime $returnedAt,
     *
     * @return Loan
     */
    public function finalize(string $id, string $status, DateTime $returnedAt): Loan;

    /**
     * @param string $id,
     * @param string $status,
     * @param DateTime $lastRenewedAt,
     * @param DateTime $returnDate,
     *
     * @return Loan
     */
    public function renew(
        string $id,
        string $status,
        DateTime $lastRenewedAt,
        DateTime $returnDate,
    ): Loan;
}
