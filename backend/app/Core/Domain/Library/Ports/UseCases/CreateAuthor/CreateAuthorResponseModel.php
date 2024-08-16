<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateAuthor;

use App\Core\Domain\Library\Entities\Author;

final class CreateAuthorResponseModel
{
    /**
     * @param Author $author
     */
    public function __construct(private Author $author)
    {
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }
}
