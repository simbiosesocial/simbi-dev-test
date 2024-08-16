<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateBook;

use App\Core\Domain\Library\Entities\Book;

final class CreateBookResponseModel
{
    /**
     * @param Book $book
     */
    public function __construct(private Book $book)
    {
    }

    /**
     * @return Book
     */
    public function getBook(): Book
    {
        return $this->book;
    }
}
