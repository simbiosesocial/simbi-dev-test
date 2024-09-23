<?php

namespace App\Core\Domain\Library\ValueObjects;

use App\Core\Common\ValueObjects\ValueObject;
use App\Core\Domain\Library\Exceptions\InvalidUserEmail;

final class UserEmail implements ValueObject
{
    public string $email;

    public function __construct(?string $email = null)
    {
        $this->email = $email;
        $this->validate();
    }

    public function validate(): void
    {
        $isValidEmailFormat = !!filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if (!$isValidEmailFormat) {
            throw new InvalidUserEmail();
        }
    }
}
