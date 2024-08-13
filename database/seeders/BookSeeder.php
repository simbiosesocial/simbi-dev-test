<?php

namespace Database\Seeders;

use App\Infra\Adapters\Persistence\Eloquent\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Book::truncate();
        Book::factory()->count(5)->create();
    }
}
