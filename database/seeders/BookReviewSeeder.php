<?php

namespace Database\Seeders;

use App\Models\BookReview;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookReview::factory()->count(50)->create();
    }
}
