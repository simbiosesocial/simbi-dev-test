<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListLoansByBook;

final class ListLoansByBookRequestModel
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
