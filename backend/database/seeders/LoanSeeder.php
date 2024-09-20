<?php

namespace Database\Seeders;

use App\Infra\Adapters\Persistence\Eloquent\Models\Loan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        Loan::truncate();
        Loan::factory()->count(3)->create();
    }
}