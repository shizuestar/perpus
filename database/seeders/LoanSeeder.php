<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();

        for ($i = 1; $i <= 12; $i++) {
            Loan::create([
                'user_id' => 1, // Always attach to user_id 1
                'book_id' => $books->random()->id, // Random book
                'return_date' =>  null,
                // 'return_date' => rand(0, 1) ? now()->addDays(rand(5, 20))->format('Y-m-d') : null,
                'status' => ['process', 'approved', 'rejected', 'returned'][rand(0, 3)], // Random status
            ]);
        }
    }
}
