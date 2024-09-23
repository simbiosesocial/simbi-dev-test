<?php

namespace App\Core\Domain\Library\ValueObjects;

use App\Core\Common\ValueObjects\ValueObject;
use App\Core\Domain\Library\Exceptions\InvalidUserName;

final class UserName implements ValueObject
{
    public ?string $firstName;

    public ?string $lastName;

    public function __construct(?string $firstName = null, ?string $lastName = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->validate();
    }

    public function validate(): void
    {
        if (empty($this->firstName)) {
            throw new InvalidUserName();
        }

        if (empty($this->lastName)) {
            throw new InvalidUserName();
        }
    }
}