<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;
use DateTime;

final class LoanAlreadyHaveFinished extends DomainException
{
    public DateTime $returnedAt;
    public function __construct(DateTime $returnedAt)
    {
        parent::__construct('Loan already have finished ' . $returnedAt->format('Y-m-d H:i:s') . '.');
        $this->returnedAt = $returnedAt;
    }
}
