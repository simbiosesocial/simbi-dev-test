<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoanById;

final class DeleteLoanByIdRequestModel
{
    public function __construct(private array $attributes = [])
    {
    }

    public function getLoanId(): string|null
    {
        return $this->attributes['loan_id'] ?? null;
    }
}