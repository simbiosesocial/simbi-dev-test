<?php

namespace Database\Factories;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use DateTime;

class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $book = Book::where('is_available', true)->inRandomOrder()->first() ?? Book::factory()->create();

        $loanDate = $this->faker->dateTimeBetween('-1 month', 'now');
        $returnDate = (clone $loanDate)->modify('+7 days');
        $now = new DateTime();
        $returned_at = $this->faker->optional()->dateTimeBetween($loanDate, $returnDate);
        $status = is_null($returned_at) ? ($returnDate < $now ? 'overdue' : 'active') : 'finished';
        $book->is_available = is_null($returned_at) ? false : true;
        $book->save();

        return [
            'id' => $this->faker->uuid(),
            'book_id' => $book->id,
            'loan_date' => $loanDate->format(DateTime::ATOM),
            'return_date' => $returnDate->format(DateTime::ATOM),
            'returned_at' => $returned_at ? $returned_at->format(DateTime::ATOM) : null,
            'status' => $status,
            'renewal_count' => 0,
            'last_renewed_at' => null,
        ];
    }
}
