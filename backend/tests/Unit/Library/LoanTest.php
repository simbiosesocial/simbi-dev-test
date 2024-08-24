<?php

use PHPUnit\Framework\TestCase;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Entities\Book;

class LoanTest extends TestCase
{
    public function test_should_create_loan_instance_with_valid_parameters()
    {
        $currentDateTime = new DateTime('now');
        $book = new Book(1, 'The Robinson Crusoe Adventures', 'Daniel Defoe', '14', $currentDateTime, $currentDateTime);

        $startLoanDate = new DateTime('2023-01-01');
        $finalLoanDate = new DateTime('2023-01-15');
        $isBookBackToLibrary = false;

        $loan = new Loan(null, $book, $startLoanDate, $finalLoanDate, $isBookBackToLibrary);

        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertSame($book, $loan->book);
        $this->assertEquals($startLoanDate, $loan->startLoanDate);
        $this->assertEquals($finalLoanDate, $loan->finalLoanDate);
    }
}
