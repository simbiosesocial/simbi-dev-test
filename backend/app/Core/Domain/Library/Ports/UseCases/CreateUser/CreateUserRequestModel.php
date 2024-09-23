<?php

namespace App\Core\Domain\Library\Ports\UseCases\CreateUser;

final class CreateUserRequestModel
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
    public function getName(): string|null
    {
        return $this->attributes['name'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getEmail(): string|null
    {
        return $this->attributes['email'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getPassword(): string|null
    {
        return $this->attributes['password'] ?? null;
    }
}
