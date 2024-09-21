<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;

class LoanTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_a_loan_with_valid_data()
    {
        $loanData = [
            'user_email' => 'teste@teste.com',
            'book_id' => '8ea2752e-2cd3-316e-b497-42ada56a0fdc',
            'author_id' => 'dcc68082-c518-33ce-b6c8-32a6fbbce307',
            'loan_date' => '2024-09-20',
            'return_date' => '2024-09-27',
        ];

        $loan = Loan::create($loanData);

        $this->assertInstanceOf(Loan::class, $loan);
        $this->assertEquals($loanData['user_email'], $loan->user_email);
        // ...
    }
}