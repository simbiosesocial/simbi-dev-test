<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoan;

final class DeleteLoanRequestModel
{
    public function __construct(private array $attributes = [])
    {
    }

    public function getLoanId(): string|null
    {
        return $this->attributes['loan_id'] ?? null;
    }
}