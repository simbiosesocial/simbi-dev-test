<?php

namespace App\Core\Domain\Library\Ports\UseCases\DeleteLoanById;

final class DeleteLoanByIdRequestModel
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
    public function getLoanId(): string|null
    {
        return $this->attributes['loan_id'] ?? null;
    }
}
