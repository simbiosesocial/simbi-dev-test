<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Loan;

interface LoanRepository
{
    /**
     * @param Loan $loan
     *
     * @return Loan
     */
    public function createOne(Loan $loan): Loan;

    /**
     * @return Loan[]
     */
    public function getAll(): array;

    /**
     * @param string $book_id
     *
     * @return bool;
     */
    public function isBookLoaned(string $book_id): bool;

    /**
     * @param string $book_id
     *
     * @return bool
     */
    public function isBookOverdue(string $book_id): bool;

    /**
     * @param Loan $loan
     *
     * @return void
     */
    public function deleteLoan(string $id): void;
}