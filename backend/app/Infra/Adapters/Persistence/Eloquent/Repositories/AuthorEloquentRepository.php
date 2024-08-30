<?php

namespace App\Infra\Adapters\Persistence\Eloquent\Repositories;

use App\Core\Domain\Library\Entities\Author;
use App\Core\Domain\Library\Ports\Persistence\AuthorRepository;
use App\Infra\Adapters\Persistence\Eloquent\Models\Author as EloquentAuthor;
use App\Infra\Adapters\Persistence\Eloquent\Models\Mappers\AuthorMapper;

final class AuthorEloquentRepository implements AuthorRepository
{
    /**
     * @param Author $author
     *
     * @return Author
     */
    public function create(Author $author): Author
    {
        $eloquentAuthor = AuthorMapper::toEloquentModel($author);
        $eloquentAuthor->save();

        return AuthorMapper::toDomainEntity($eloquentAuthor);
    }

    /**
     *
     * @return array<Author>
     */
    public function getAll(): array
    {
        $eloquentAuthors = EloquentAuthor::get()->all();

        if (empty($eloquentAuthors)) {
            return [];
        }

        return AuthorMapper::toManyDomainEntities($eloquentAuthors);
    }
}
