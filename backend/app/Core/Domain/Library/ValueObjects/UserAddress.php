<?php

namespace App\Core\Domain\Library\ValueObjects;

use App\Core\Common\ValueObjects\ValueObject;
use App\Core\Domain\Library\Exceptions\InvalidUserAddress;

final class UserAddress implements ValueObject
{
    public string $zipCode;

    public string $Number;

    public function __construct(?string $zipCode = null, ?string $Number = null)
    {
        $this->zipCode = str_replace('-', '', $zipCode);
        $this->zipCode = str_replace(' ', '', $this->zipCode);
        $this->Number = $Number;
        $this->validate();
    }

    public function validate(): void
    {
        $isValidZipCode = preg_match('/^\d{8}$/', $this->zipCode);
        $isValidNumber = gettype($this->Number) == 'string';

        $isValidAddress = $isValidZipCode && $isValidNumber;

        if (!$isValidAddress)
            throw new InvalidUserAddress();
    }
}