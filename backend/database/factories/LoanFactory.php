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
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model"s default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minDaysForLoan = -30;
        $maxDaysForLoan = 30;

        $startLoanDaysAmount = $this->faker->numberBetween($minDaysForLoan, $maxDaysForLoan);
        $endLoanDaysAmount = $this->faker->numberBetween(
            $startLoanDaysAmount,
            $startLoanDaysAmount + $maxDaysForLoan,
        );

        $startLoanDate = new Datetime("{$startLoanDaysAmount} days");
        $endLoanDate = new Datetime("{$endLoanDaysAmount} days");

        return [
            "id" => Uuid::uuid4(),
            "book_id" => Book::factory(),
            "start_loan_date" => $startLoanDate,
            "end_loan_date" => $endLoanDate,
            "created_at" => (new DateTime('now')),
            "updated_at" => (new DateTime('now')),
        ];
    }
}
