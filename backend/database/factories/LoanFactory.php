<?php

namespace Database\Factories;

use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;
use Datetime;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition(): array
    {
        $minDaysForLoan = -30;
        $maxDaysForLoan = 30;

        $loanDays = $this->faker->numberBetween($minDaysForLoan, $maxDaysForLoan);
        $returnDays = $this->faker->numberBetween(
            $loanDays,
            $loanDays + $maxDaysForLoan,
        );

        $loanDate = new Datetime("{$loanDays} days");
        $returnDate = new Datetime("{$returnDays} days");

        return [
            "id" => Uuid::uuid4(),
            "book_id" => Book::factory(),
            "loan_date" => $loanDate,
            "return_date" => $returnDate,
            "created_at" => (new DateTime('now')),
            "updated_at" => (new DateTime('now')),
        ];
    }
}