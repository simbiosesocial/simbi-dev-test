<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

final class CreateLoanRequestModel
{
    /**
     * @param array $attributes
     */
    public function __construct(private array $attributes = [])
    {
    }

    /**
     * @return string|null
     */
    public function getBookId(): string|null
    {
        return $this->attributes['book_id'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getStartLoanDate(): string|null
    {
        return $this->attributes['start_loan_date'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getEndLoanDate(): string|null
    {
        return $this->attributes['end_loan_date'] ?? null;
    }
}
