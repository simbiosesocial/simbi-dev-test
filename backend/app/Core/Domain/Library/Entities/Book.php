<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\Exceptions\{BookMustHaveAPublisher, BookMustHaveATitle, BookMustHaveAnAuthor};
use DateTime;

final class Book extends Entity
{
    use WithCreatedAt, WithUpdatedAt;

    /**
     * @var ?string $id
     */
    public ?string $id;
    /**
     * @var ?string $title
     */
    public ?string $title;
    /**
     * @var ?string $publisher
     */
    public ?string $publisher;
    /**
     * @var ?string $authorId
     */
    public ?string $authorId;
    /**
     * @var ?Author $author
     */
    public ?Author $author;

    /**
     * @param ?string $id
     * @param ?string $title
     * @param ?string $publisher
     * @param ?string $authorId
     */
    public function __construct(
        ?string $id = null,
        ?string $title = null,
        ?string $publisher = null,
        ?string $authorId = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
    ) {
        parent::__construct($id);
        $this->title = $title;
        $this->publisher = $publisher;
        $this->authorId = $authorId;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    /**
     * @param Author $author
     *
     * @return void
     */
    public function addAuthor(Author $author): void
    {
        $this->author = $author;
    }

    /**
     * @return void
     */
    public function validate(): void
    {
        if (empty($this->authorId)) {
            throw new BookMustHaveAnAuthor();
        }

        if (empty($this->title)) {
            throw new BookMustHaveATitle();
        }

        if (empty($this->publisher)) {
            throw new BookMustHaveAPublisher();
        }
    }
}
