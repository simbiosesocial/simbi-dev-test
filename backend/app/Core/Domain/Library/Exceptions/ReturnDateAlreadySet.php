<?php

namespace App\Core\Domain\Library\Exceptions;

use DomainException;
use DateTime;

final class ReturnDateAlreadySet extends DomainException
{
    public DateTime $returnDate;
    public function __construct(DateTime $returnDate)
    {
        parent::__construct(
            'Return date already set to ' . $returnDate->format('Y-m-d H:i:s') .
            'Use renewLoan to extend the loan period.'
        );
        $this->returnDate = $returnDate;
    }
}
