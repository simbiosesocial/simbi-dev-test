<?php
namespace Database\Factories;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'user_email' => $this->faker->email,
            'book_id' => $this->faker->uuid,
            'author_id' => $this->faker->uuid,
            'loan_date' => $this->faker->date,
            'return_date' => $this->faker->date,
        ];
    }
}
