<?php

namespace App\Core\Domain\Library\ValueObjects;

use App\Core\Common\ValueObjects\ValueObject;
use App\Core\Domain\Library\Exceptions\InvalidReaderAddress;

final class ReaderAddress implements ValueObject
{
    public string $zipCode;

    public string $houseNumber;

    public function __construct(?string $zipCode = null, ?string $houseNumber = null)
    {
        $this->zipCode = str_replace('-', '', $zipCode);
        $this->zipCode = str_replace(' ', '', $this->zipCode);
        $this->houseNumber = $houseNumber;
        $this->validate();
    }

    public function validate(): void
    {
        $isValidZipCode = preg_match('/^\d{8}$/', $this->zipCode);
        $isValidHouseNumber = gettype($this->houseNumber) == 'string';

        $isValidAddress = $isValidZipCode && $isValidHouseNumber;

        if (!$isValidAddress)
            throw new InvalidReaderAddress();
    }
}