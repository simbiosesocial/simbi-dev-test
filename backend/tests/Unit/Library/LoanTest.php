<?php

use PHPUnit\Framework\TestCase;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Entities\Book;

class LoanTest extends TestCase
{
    public function test_create_loan()
    {
        $currentDateTime = new DateTime('now');
        $book = new Book(1, 'The Robinson Crusoe Adventures', 'Daniel Defoe', '14', $currentDateTime, $currentDateTime);

        $loanDate = new DateTime('2023-01-01');
        $returnDate = new DateTime('2023-01-15');
        $isBookBackToLibrary = false;

        $loan = new Loan(null, $book, $loanDate, $returnDate, $isBookBackToLibrary);

        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertSame($book, $loan->book);
        $this->assertEquals($loanDate, $loan->LoanDate);
        $this->assertEquals($returnDate, $loan->ReturnDate);
    }
}