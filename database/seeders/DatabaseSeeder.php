<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        User::factory()->create([
            "username" => "superadmin",
            "email" => "admin@email.com",
            "name" => "Super Admin",
            "telp" => "088221334412",
            "address" => "JL. Yos Sudarso no 40 Depok, Karanganyar",
            "password" => Hash::make("password"),
            "level" => "admin",
            "remember_token" => Str::random(10)
        ]);
        User::factory()->create([
            "username" => "user1",
            "email" => "user1@email.com",
            "name" => "User Satu",
            "telp" => "088221334444",
            "address" => "JL. Yos Sudarso no 40 Depok, Karanganyar",
            "password" => Hash::make("password"),
            "level" => "user",
            "remember_token" => Str::random(10)
        ]);
        User::factory()->create([
            "username" => "user2",
            "email" => "user2@email.com",
            "name" => "User Dua",
            "address" => "JL. Yos Sudarso no 40 Depok, Karanganyar",
            "password" => Hash::make("password"),
            "telp" => "0882213344121",
            "level" => "user",
            "remember_token" => Str::random(10)
        ]);
        User::factory()->create([
            "username" => "user3",
            "email" => "user2@email.com",
            "name" => "User Tiga",
            "telp" => "08822133433",
            "address" => "JL. Yos Sudarso no 40 Depok, Karanganyar",
            "password" => Hash::make("password"),
            "level" => "user",
            "remember_token" => Str::random(10)
        ]);
        User::factory(300)->create();
        $this->call([
            BookCategorySeeder::class,
            // LoanSeeder::class,
        ]);
        Book::create([
            'title' => 'Dilan',
                'slug' => 'dilan',
                'excerpt' => 'Dia adalah Dilanku Tahun 1990 mengisahkan cinta remaja Milea dan Dilan di Bandung tahun 1990, penuh momen manis, humor, dan nostalgia masa SMA.',
                'author' => 'Pidi Baiq',
                'publisher' => 'Bentang Pustaka',
                'yearPublished' => Carbon::now(),
                'synopsis' => 'Dia adalah Dilanku Tahun 1990 adalah novel remaja karya Pidi Baiq yang mengisahkan perjalanan cinta manis dan penuh kenangan antara Milea, seorang siswi baru di Bandung, dan Dilan, remaja cerdas namun unik dengan tingkah laku yang tak terduga. Berlatar tahun 1990, cerita ini membawa pembaca pada masa SMA yang penuh dinamika: dari cara Dilan merayu Milea dengan puisi, hadiah tak biasa, hingga perhatian yang tulus. Di balik kisah romantis itu, novel ini juga menyelipkan nuansa persahabatan, konflik masa muda, dan perjuangan untuk memahami cinta yang sederhana namun mendalam. Kombinasi humor, romansa, dan nostalgia membuat novel ini menjadi salah satu karya yang sangat populer dan menggugah hati pembacanya.',
                'category_id' => 1, // Fiksi Remaja
                'stock' => 18,
                'status' => 'available',
                'image' => 'gufoTuCuvOgyHg1wyVgpvXO6yGAu0nXkB6FmAkKP.jpg',
                'ori_image' => null
        ]);
        Book::create([
            'title' => 'Tenggelamnya Kapal Van Der Wijck',
                'slug' => 'tenggelamnya-kapal-van-der-wijck',
                'excerpt' => 'Tragedi cinta yang mengharukan di tengah pergolakan kolonialisme.',
                'author' => 'Hamka',
                'publisher' => 'Pustaka Jaya',
                'yearPublished' => Carbon::now(),
                'synopsis' => 'Salah satu novel klasik Indonesia yang sangat terkenal.',
                'category_id' => 1, // Fiksi Sejarah
                'stock' => 12,
                'status' => 'available',
                'image' => 'FkZjftFtKO3FY432Yyc4h3D2b0u2SF2lTE9MhuCP.jpg',
                'ori_image' => null
        ]);
        Book::create([
            'title' => 'Ayat-ayat Cinta',
                'slug' => 'ayat-ayat-cinta',
                'excerpt' => 'Kisah cinta seorang mahasiswa yang mencari jati diri.',
                'author' => 'Habiburrahman El Shirazy',
                'publisher' => 'Republika',
                'yearPublished' => Carbon::now(),
                'synopsis' => 'Novel religi yang sangat populer dan menginspirasi banyak film.',
                'category_id' => 2, // Religi
                'stock' => 15,
                'status' => 'available',
                'image' => 'u3LVL506PD8mydD9RIkoAm0JSofCXpbQlSvoDF5Q.jpg',
                'ori_image' => null
        ]);
        Book::create([
            'title' => 'Pulang',
                'slug' => 'pulang',
                'excerpt' => 'Kisah seorang anak perantauan yang kembali ke kampung halaman.',
                'author' => 'Tere Liye',
                'publisher' => 'Gramedia',
                'yearPublished' => Carbon::now(),
                'synopsis' => 'Novel yang menyentuh hati tentang keluarga dan akar.',
                'category_id' => 1, // Fiksi
                'stock' => 12,
                'status' => 'available',
                'image' => '1sJifB154cvbskqAzTcaRfY5tEy2Z0jkVhcRFrVP.jpg',
                'ori_image' => null
        ]);
        Book::create([
            'title' => 'Ranah 3 Warna',
                'slug' => 'ranah-3-warna',
                'excerpt' => 'Misteri pembunuhan yang menegangkan di sebuah desa terpencil.',
                'author' => 'Andrea Hirata',
                'publisher' => 'Gramedia',
                'yearPublished' => Carbon::now(),
                'synopsis' => 'Novel thriller yang penuh ketegangan.',
                'category_id' => 3, // Misteri
                'stock' => 15,
                'status' => 'available',
                'image' => '9Gtw3kKmVunf87LcQ1z1CBUzF6QPKTAgyC4E4g9y.jpg',
                'ori_image' => null
        ]);
        Book::create([
            'title' => 'Laskar Pelangi',
            'slug' => 'laskar-pelangi',
            'excerpt' => 'Kisah inspiratif tentang perjuangan anak-anak sekolah di Belitung.',
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'yearPublished' => Carbon::now(),
            'synopsis' => 'Novel yang menceritakan tentang sekelompok anak sekolah di sebuah desa terpencil di Belitung yang bermimpi untuk meraih pendidikan yang lebih tinggi.',
            'category_id' => 1, // Fiksi Remaja
            'stock' => 50,
            'status' => 'available',
            'image' => 'YwpiNKo4Vhsj1ceViM9GPSIbMk89CvxohQVcBFyK.jpg',
            'ori_image' => null
        ]);
        Book::create([
            'title' => 'Nanti Kita Cerita Tentang Hari Ini',
            'slug' => 'nanti-kita-cerita-tentang-hari-ini',
            'excerpt' => "A heartfelt memoir about family, love, and life's uncertainties.",
            'author' => 'Marchella FP',
            'publisher' => 'Bentang Pustaka',
            'yearPublished' => Carbon::now(),
            'synopsis' => "A collection of personal essays exploring the author's life experiences and reflections.",
            'category_id' => 3, // Memoir
            'stock' => 25,
            'status' => 'available',
            'image' => 'VzCkEFyRNS9MMH0KP4qPcPWPm0TGG0Zl2jNU8qG3.jpg',
            'ori_image' => null
        ]);
        Book::create([
            'title' => 'Sang Pemimpi',
            'slug' => 'sang-pemimpi',
            'excerpt' => 'A sequel to Laskar Pelangi, following the dreams of Ikal and Arai.',
            'author' => 'Andrea Hirata',
            'publisher' => 'Bentang Pustaka',
            'yearPublished' => Carbon::now(),
            'synopsis' => 'Ikal and Arai pursue their dreams of becoming a filmmaker and a doctor, respectively, facing challenges and triumphs along the way.',
            'category_id' => 1, // Fiction
            'stock' => 35,
            'status' => 'available',
            'image' => 'YwpiNKo4Vhsj1ceViM9GPSIbMk89CvxohQVcBFyK.jpg',
            'ori_image' => null
        ]);
        Book::create([
            'title' => 'Filosofi Kopi',
            'slug' => 'filosofi-kopi',
            'excerpt' => 'A heartwarming story about friendship, love, and the art of coffee.',
            'author' => 'Dethi Irawan',
            'publisher' => 'Gramedia Pustaka Utama',
            'yearPublished' => Carbon::now(),
            'synopsis' => 'Two friends open a coffee shop in Jakarta and learn valuable lessons about life, business, and relationships.',
            'category_id' => 2, // Lifestyle
            'stock' => 20,
            'status' => 'available',
            'image' => '9Ar2LPARGsLCOvK8O29kWd8ffdL7YcntzyjKylUi.jpg',
            'ori_image' => null
        ]);
        $this->call([
            BookSeeder::class,
            BookReviewSeeder::class,
            PersonalCollectionSeeder::class
        ]);
    }
}