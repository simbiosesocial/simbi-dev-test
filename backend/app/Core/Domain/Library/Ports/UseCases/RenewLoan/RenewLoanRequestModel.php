<?php

namespace App\Core\Domain\Library\Ports\UseCases\RenewLoan;

final class RenewLoanRequestModel
{
    /**
     * @param  array $attributes
     *
     * @return void
     */
    public function __construct(private array $attributes = [])
    {
    }

    /**
     * @return string|null
     */
    public function getLoanId(): string|null
    {
        return $this->attributes['loanId'] ?? null;
    }
}
