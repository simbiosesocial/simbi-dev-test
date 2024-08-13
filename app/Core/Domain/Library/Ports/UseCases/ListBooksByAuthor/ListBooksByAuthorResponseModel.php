<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor;

use App\Core\Domain\Library\Entities\Book;

final class ListBooksByAuthorResponseModel
{
    /**
     * @param array<Book> $books
     */
    public function __construct(private array $books)
    {
    }

    /**
     * @return array<Book>
     */
    public function getBooks(): array
    {
        return $this->books;
    }
}
