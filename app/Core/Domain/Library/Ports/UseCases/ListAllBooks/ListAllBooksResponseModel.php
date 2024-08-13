<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllBooks;

use App\Core\Domain\Library\Entities\Book;

final class ListAllBooksResponseModel
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
