<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Models\Mappers;

use App\Core\Domain\Library\Entities\Author as DomainAuthor;
use App\Core\Domain\Library\ValueObjects\AuthorName;
use App\Infra\Adapters\Persistence\Eloquent\Models\Author as EloquentAuthor;

final class AuthorMapper
{
    /**
     * @param DomainAuthor $author
     *
     * @return EloquentAuthor
     */
    public static function toEloquentModel(DomainAuthor $author): EloquentAuthor
    {
        return new EloquentAuthor([
            'id' => $author->id,
            'first_name' => $author->firstName,
            'last_name' => $author->lastName,
        ]);
    }

    /**
     * @param EloquentAuthor $author
     *
     * @return DomainAuthor
     */
    public static function toDomainEntity(EloquentAuthor $author): DomainAuthor
    {
        return new DomainAuthor(
            id: $author->id,
            name: new AuthorName($author->first_name, $author->last_name),
            createdAt: $author->created_at,
            updatedAt: $author->updated_at,
        );
    }
}
