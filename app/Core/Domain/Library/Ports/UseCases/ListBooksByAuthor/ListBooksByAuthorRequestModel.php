<?php

namespace App\Core\Domain\Library\Ports\UseCases\ListBooksByAuthor;

final class ListBooksByAuthorRequestModel
{
    /**
     * @param  array $attributes
     *
     * @return void
     */
    public function __construct(private array $attributes = [])
    {
    }

    /**
     * @return string|null
     */
    public function getAuthorId(): string|null
    {
        return $this->attributes['authorId'] ?? null;
    }
}
