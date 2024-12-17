<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonalCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_collections')->truncate();

        // Array untuk menyimpan kombinasi user_id dan book_id agar tidak duplikat
        $uniqueCollections = [];

        // Loop untuk user ID dari 1 sampai 200
        for ($userId = 1; $userId <= 200; $userId++) {
            // Pilih buku secara acak antara ID 1-8
            $bookId = rand(1, 8);

            // Pastikan kombinasi user_id dan book_id unik
            while (in_array([$userId, $bookId], $uniqueCollections)) {
                $bookId = rand(1, 8); // Cari buku lain jika sudah ada
            }

            // Simpan kombinasi ke dalam array
            $uniqueCollections[] = [$userId, $bookId];

            // Insert data ke dalam tabel
            PersonalCollection::create([
                'user_id' => $userId,
                'book_id' => $bookId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
