<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateAuthor;

final class CreateAuthorRequestModel
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
    public function getFirstName(): string|null
    {
        return $this->attributes['firstName'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getLastName(): string|null
    {
        return $this->attributes['lastName'] ?? null;
    }
}
