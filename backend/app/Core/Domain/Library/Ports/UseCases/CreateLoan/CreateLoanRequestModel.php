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
        return $this->attributes['bookId'] ?? null;
    }
}
