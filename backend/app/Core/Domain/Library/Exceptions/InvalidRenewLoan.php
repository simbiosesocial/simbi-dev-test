<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;

final class InvalidRenewLoan extends DomainException
{
    public function __construct(?string $message = '')
    {
        parent::__construct('Invalid renew loan. ' . $message);
    }
}
