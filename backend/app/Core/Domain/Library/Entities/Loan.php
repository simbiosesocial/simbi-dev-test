<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use DateTime;

final class Loan extends Entity
{

    // /**
    //  * @var Reader $reader
    //  */
    // public Reader $reader;

    /**
     * @var Book $book
     */
    public ?Book $book;

    /**
     * @var Datetime $LoanDate
     */
    public DateTime $LoanDate;

    /**
     * @var Datetime $ReturnDate
     */
    public Datetime $ReturnDate;

    /**
     * @param ?string $id
     * @param Book book
     * @param Datetime $LoanDate
     * @param Datetime $ReturnDate
     */
    public function __construct(
        ?string $id,
        ?Book $book,
        Datetime $LoanDate,
        Datetime $ReturnDate,
    ) {
        parent::__construct($id);
        $this->book = $book;
        $this->LoanDate = $LoanDate;
        $this->ReturnDate = $ReturnDate;
    }

    public function getFormatedLoanDate()
    {
        return $this->LoanDate->format("Y-m-d");
    }

    public function finalFormatedLoanDate()
    {
        return $this->LoanDate->format("Y-m-d");
    }

    public static function getFormatedDateFromDateString(string $loanDate)
    {
        return DateTime::createFromFormat("Y-m-d", $loanDate);
    }
}