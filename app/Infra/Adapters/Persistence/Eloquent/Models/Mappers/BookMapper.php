<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models\Mappers;

use App\Core\Domain\Library\Entities\Book as DomainBook;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book as EloquentBook;

final class BookMapper
{
    /**
     * @param DomainBook $book
     *
     * @return EloquentBook
     */
    public static function toEloquentModel(DomainBook $book): EloquentBook
    {
        return new EloquentBook([
            'id' => $book->id,
            'title' => $book->title,
            'publisher' => $book->publisher,
            'author_id' => $book->authorId,
        ]);
    }

    /**
     * @param EloquentBook $book
     * @param bool $withRelations
     *
     * @return DomainBook
     */
    public static function toDomainEntity(EloquentBook $book, bool $withRelations = true): DomainBook
    {
        $domainBook = new DomainBook(
            id: $book->id,
            title: $book->title,
            publisher: $book->publisher,
            authorId: $book->author_id,
            createdAt: $book->created_at,
            updatedAt: $book->updated_at,
        );

        if ($withRelations && ! empty($book->author)) {
            $domainBook->addAuthor(AuthorMapper::toDomainEntity($book->author));
        }

        return $domainBook;
    }

    /**
     * @param array<EloquentBook> $books
     *
     * @return array<DomainBook>
     */
    public static function toManyDomainEntities(array $books): array
    {
        return array_map(static fn ($book) => self::toDomainEntity($book), $books);
    }
}
