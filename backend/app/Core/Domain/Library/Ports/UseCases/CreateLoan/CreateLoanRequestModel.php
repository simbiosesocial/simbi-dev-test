<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateLoan;

final class CreateLoanRequestModel
{
    public function __construct(private array $attributes = [])
    {
    }

    public function getBookId(): string|null
    {
        return $this->attributes['book_id'] ?? null;
    }

    public function getStartLoanDate(): string|null
    {
        return $this->attributes['start_loan_date'] ?? null;
    }

    public function getEndLoanDate(): string|null
    {
        return $this->attributes['end_loan_date'] ?? null;
    }
}