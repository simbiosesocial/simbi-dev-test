<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Book;

interface BookRepository
{
    /**
     * @param Book $book
     *
     * @return Book
     */
    public function create(Book $book): Book;

    /**
     * @return array<Book>;
     */
    public function getAll(): array;

    /**
     * @param string $authorId
     *
     * @return array<Book>;
     */
    public function getBooksByAuthorId(string $authorId): array;
}
