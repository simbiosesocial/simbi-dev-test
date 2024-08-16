<?php

namespace Database\Seeders;

use App\Infra\Adapters\Persistence\Eloquent\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Author::truncate();
        Author::factory()->count(5)->create();
    }
}
