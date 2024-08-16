<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use App\Core\Common\Traits\{WithCreatedAt, WithUpdatedAt};
use App\Core\Domain\Library\ValueObjects\AuthorName;
use DateTime;

final class Author extends Entity
{
    use WithCreatedAt, WithUpdatedAt;
    /**
     * @var string $firstName
     */
    public string $firstName;
    /**
     * @var string $lastName
     */
    public string $lastName;
    /**
     * @var mixed $books
     */
    private mixed $books;
    /**
     * @param ?string $id
     * @param ?AuthorName $name
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(
        ?string $id = null,
        ?AuthorName $name = null,
        ?DateTime $createdAt = null,
        ?DateTime $updatedAt = null,
    ) {
        parent::__construct($id);
        $this->firstName = $name->firstName;
        $this->lastName = $name->lastName;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return void
     */
    public function addBooks(): void
    {
        // todo
    }

    /**
     * @return mixed
     */
    public function getBooks(): mixed
    {
        return []; // todo
    }
}
