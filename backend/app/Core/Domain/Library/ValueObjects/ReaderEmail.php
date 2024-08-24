<?php

namespace App\Core\Domain\Library\ValueObjects;

use App\Core\Common\ValueObjects\ValueObject;
use App\Core\Domain\Library\Exceptions\InvalidReaderEmail;

final class ReaderEmail implements ValueObject
{
    /**
     * @var string $email
     */
    public string $email;

    public function __construct(?string $email = null)
    {
        $this->email = $email;
        $this->validate();
    }

    /**
     * @return void
     *
     * @throws InvalidReaderEmail
     */
    public function validate(): void
    {
        $isValidEmailFormat = !!filter_var($this->email, FILTER_VALIDATE_EMAIL);

        if (!$isValidEmailFormat) throw new InvalidReaderEmail();
    }
}
