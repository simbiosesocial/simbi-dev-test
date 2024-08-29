<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Book;
use App\Core\Domain\Library\Ports\Persistence\BookRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book as EloquentBook;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\BookMapper;

final class BookEloquentRepository implements BookRepository
{
    /**
     * @param Book $book
     *
     * @return Book
     */
    public function create(Book $book): Book
    {
        $eloquentBook = BookMapper::toEloquentModel($book);
        $eloquentBook->save();

        return BookMapper::toDomainEntity($eloquentBook);
    }

    /**
     * @return array<Book>
     */
    public function getAll(): array
    {
        $eloquentBooks = EloquentBook::with(['author'])
            ->get()
            ->all();

        if (empty($eloquentBooks)) {
            return [];
        }

        return BookMapper::toManyDomainEntities($eloquentBooks);
    }

    /**
     * @param string $authorId
     *
     * @return array<Book>
     */
    public function getBooksByAuthorId(string $authorId): array
    {
        $eloquentBooks = EloquentBook::where(['author_id' => $authorId])
            ->with(['author'])
            ->get()
            ->all();

        if (empty($eloquentBooks)) {
            return [];
        }

        return BookMapper::toManyDomainEntities($eloquentBooks);
    }

    /**
     * @param string $bookId
     *
     * @return ?Book
     */
    public function findById(string $bookId): ?Book
    {
        $eloquentBook = EloquentBook::with(['author'])->find($bookId);
        if (!$eloquentBook) {
            return null;
        }
        return BookMapper::toDomainEntity($eloquentBook);
    }

    /**
     * @param string $bookId
     *
     * @param bool $isAvailable
     *
     * @return Book
     */
    public function setAvailable(string $bookId, bool $isAvailable): Book
    {
        $eloquentBook = EloquentBook::findOrFail($bookId);
        $eloquentBook->isAvailable = $isAvailable;
        $eloquentBook->save();

        return BookMapper::toDomainEntity($eloquentBook);
    }
}
