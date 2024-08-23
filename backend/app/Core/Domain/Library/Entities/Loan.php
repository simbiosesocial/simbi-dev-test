<?php

namespace App\Core\Domain\Library\Entities;

use App\Core\Common\Entities\Entity;
use DateTime;

final class Loan extends Entity
{

    /**
     * @var Reader $reader
     */
    public Reader $reader;

    /**
     * @var Book $book
     */
    public Book $book;

    /**
     * @var Datetime $startLoanDate
     */
    public DateTime $startLoanDate;

    /**
     * @var Datetime $finalLoanDate
     */
    public Datetime $finalLoanDate;

    /**
     * @var bool $isBookBackToLibrary
     */
    public bool $isBookBackToLibrary;

    /**
     * @param ?string $id
     * @param Book book
     * @param Reader reader
     * @param Datetime $startLoanDate
     * @param Datetime $finalLoanDate
     * @param bool $isBookBackToLibrary
     */
    public function __construct(
        Book $book,
        Reader $reader,
        Datetime $startLoanDate,
        Datetime $finalLoanDate,
        bool $isBookBackToLibrary,
    ) {
        $this->book = $book;
        $this->reader = $reader;
        $this->startLoanDate = $startLoanDate;
        $this->finalLoanDate = $finalLoanDate;
        $this->isBookBackToLibrary = $isBookBackToLibrary;
    }
}
