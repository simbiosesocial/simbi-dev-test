<?php

namespace Tests\Unit;

use App\Core\Domain\Library\Entities\Loan;
use PHPUnit\Framework\TestCase;

class LoanTest extends TestCase
{
    public function testShouldBeAbleToInstantiateALoan()
    {
        $loan = new Loan(
            bookId: "123",
            loanDate: "2024-05-05 00:00:00",
            dueDate: "2024-05-20 00:00:00",
            returnDate: null,
            status: "active",
        );

        $this->assertIsString($loan->id);
        $this->assertEquals("2024-05-05 00:00:00", $loan->loanDate);
        $this->assertEquals("2024-05-20 00:00:00", $loan->dueDate);
        $this->assertEquals("active", $loan->status);
    }
}
