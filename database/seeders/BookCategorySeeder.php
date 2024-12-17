<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Fiction', 'Non-fiction', 'Science', 'History', 'Biography'];

        foreach ($categories as $category) {
            BookCategory::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }
    }
}
