<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Support\Str;
use App\Models\BookCategory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = BookCategory::all();

        for ($i = 1; $i <= 90; $i++) {
            $category = $categories->random();

            Book::create([
                'title' => "Book Title $i",
                'slug' => Str::slug("Book Title $i"),
                'author' => "Author $i",
                'publisher' => "Publisher $i",
                'excerpt' => "20kata random",
                'yearPublished' => Carbon::now(),
                'synopsis' => "Synopsis for Book $i.",
                'stock' => 8,
                'image' => "YwpiNKo4Vhsj1ceViM9GPSIbMk89CvxohQVcBFyK.jpg",
                'ori_image' => null,
                'category_id' => $category->id,
                'status' => 'available',
            ]);
        }
    }
}
