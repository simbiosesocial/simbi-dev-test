<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateBook;

final class CreateBookRequestModel
{
    /**
     * @param array $attributes
     */
    public function __construct(private array $attributes = [])
    {
    }

    /**
     * @return string|null
     */
    public function getTitle(): string|null
    {
        return $this->attributes['title'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPublisher(): string|null
    {
        return $this->attributes['publisher'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getAuthorId(): string|null
    {
        return $this->attributes['authorId'] ?? null;
    }
}
