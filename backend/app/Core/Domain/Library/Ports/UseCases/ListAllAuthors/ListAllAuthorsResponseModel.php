<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListAllAuthors;

use App\Core\Domain\Library\Entities\Author;

final class ListAllAuthorsResponseModel
{
    /**
     * @param array<Author> $authors
     */
    public function __construct(private array $authors)
    {
    }

    /**
     * @return array<Author>
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }
}
