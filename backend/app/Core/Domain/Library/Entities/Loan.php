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
     * @var Datetime $startLoanDate
     */
    public DateTime $startLoanDate;

    /**
     * @var Datetime $finalLoanDate
     */
    public Datetime $finalLoanDate;

    /**
     * @param ?string $id
     * @param Book book
     * @param Datetime $startLoanDate
     * @param Datetime $finalLoanDate
     */
    public function __construct(
        ?string $id,
        ?Book $book,
        // Reader $reader,
        Datetime $startLoanDate,
        Datetime $finalLoanDate,
    ) {
        parent::__construct($id);
        $this->book = $book;
        // $this->reader = $reader;
        $this->startLoanDate = $startLoanDate;
        $this->finalLoanDate = $finalLoanDate;
    }

    public function getFormatedStartLoanDate()
    {
        return $this->startLoanDate->format("Y-m-d");
    }

    public function finalFormatedStartLoanDate()
    {
        return $this->startLoanDate->format("Y-m-d");
    }

    public static function getFormatedDateFromDateString(string $loanDate)
    {
        return DateTime::createFromFormat("Y-m-d", $loanDate);
    }
}