<?php

use PHPUnit\Framework\TestCase;
use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Entities\Book;
use App\Core\Domain\Library\Entities\Reader;
use App\Core\Domain\Library\ValueObjects\ReaderAddress;
use App\Core\Domain\Library\ValueObjects\ReaderEmail;
use App\Core\Domain\Library\ValueObjects\ReaderName;

class LoanTest extends TestCase
{
    public function test_should_create_loan_instance_with_valid_parameters()
    {
        $currentDateTime = new DateTime('now');
        $book = new Book(1, 'The Robinson Crusoe Adventures', 'Daniel Defoe', '14', $currentDateTime, $currentDateTime);

        $readerName = new ReaderName('John', 'Doe');
        $readerAddress = new ReaderAddress('12345-678', 'S12345');
        $readerEmail = new ReaderEmail('john.doe@simbi.com');
        $reader = new Reader(null, $readerName, $readerAddress, $readerEmail);

        $startLoanDate = new DateTime('2023-01-01');
        $finalLoanDate = new DateTime('2023-01-15');
        $isBookBackToLibrary = false;

        $loan = new Loan($book, $reader, $startLoanDate, $finalLoanDate, $isBookBackToLibrary);

        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertSame($book, $loan->book);
        $this->assertSame($reader, $loan->reader);
        $this->assertEquals($startLoanDate, $loan->startLoanDate);
        $this->assertEquals($finalLoanDate, $loan->finalLoanDate);
        $this->assertFalse($loan->isBookBackToLibrary);
    }
}
