<?php

namespace App\Core\Domain\Library\Ports\Persistence;

use App\Core\Domain\Library\Entities\Author;

interface AuthorRepository
{
    /**
     * @param Author $author
     *
     * @return Author
     */
    public function create(Author $author): Author;
}
