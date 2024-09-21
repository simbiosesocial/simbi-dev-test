<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use Database\Factories\LoanFactory;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        LoanFactory::new()->count(10)->create();
    }
}
