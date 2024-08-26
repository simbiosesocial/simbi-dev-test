<?php

namespace Tests\Unit;

use App\Core\Domain\Library\Entities\Loan;
use App\Core\Domain\Library\Exceptions\LoanMustHaveABook;
use App\Core\Domain\Library\Exceptions\LoanMustHaveAnInitDate;
use App\Core\Domain\Library\Exceptions\LoanMustHaveAReturnDate;
use DateTime;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{
    private $loanDate;
    private $returnDate;

    protected function setUp(): void
    {
        $this->loanDate = new DateTime();
        $this->returnDate = (clone $this->loanDate)->modify('+7 days');
    }

    public function testShouldBeAbleToInstantiateALoan()
    {
        $loan = new Loan(
            bookId: 'book_id_1234',
            loanDate: $this->loanDate,
            returnDate: $this->returnDate,
        );

        $this->assertIsString($loan->id);
        $this->assertEquals($this->loanDate, $loan->loanDate);
        $this->assertEquals($this->returnDate, $loan->returnDate);
        $this->assertNull($loan->returnedAt);
        $this->assertEquals('active', $loan->status);

    }

    public function testShouldThrowLoanMustHaveABook()
    {
        $this->expectException(LoanMustHaveABook::class);

        $invalidBookId = '';
        $loan = new Loan(bookId: $invalidBookId);
    }

    public function testShouldThrowLoanMustHaveAReturnDate()
    {
        $this->expectException(LoanMustHaveAReturnDate::class);

        $loan = new Loan(
            bookId: 'book_id_1234',
            loanDate: $this->loanDate,
        );
    }

}

