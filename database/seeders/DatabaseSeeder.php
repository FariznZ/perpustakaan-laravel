<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Umum', 'slug' => 'umum'],
            ['name' => 'Teknik', 'slug' => 'teknik'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi'],
            ['name' => 'Sastra', 'slug' => 'sastra'],
            ['name' => 'Sejarah', 'slug' => 'sejarah'],
            ['name' => 'Agama', 'slug' => 'agama'],
            ['name' => 'Komputer', 'slug' => 'komputer'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $books = [
            ['title' => 'Laravel: Up & Running', 'author' => 'Matt Stauffer', 'publisher' => 'O\'Reilly Media', 'year' => 2019, 'isbn' => '9781492041205', 'category_id' => 7, 'pages' => 450, 'stock' => 3, 'description' => 'Panduan lengkap membangun aplikasi web dengan Laravel.'],
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'publisher' => 'Prentice Hall', 'year' => 2008, 'isbn' => '9780132350884', 'category_id' => 7, 'pages' => 464, 'stock' => 2, 'description' => 'Buku klasik tentang menulis kode yang bersih dan maintainable.'],
            ['title' => 'Design Patterns', 'author' => 'Gang of Four', 'publisher' => 'Addison-Wesley', 'year' => 1994, 'isbn' => '9780201633610', 'category_id' => 7, 'pages' => 395, 'stock' => 1, 'description' => 'Buku referensi pola desain perangkat lunak.'],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'publisher' => 'Avery', 'year' => 2018, 'isbn' => '9780735211292', 'category_id' => 1, 'pages' => 320, 'stock' => 5, 'description' => 'Cara membangun kebiasaan baik dan menghilangkan kebiasaan buruk.'],
            ['title' => 'Rich Dad Poor Dad', 'author' => 'Robert Kiyosaki', 'publisher' => 'Plata Publishing', 'year' => 1997, 'isbn' => '9781612680194', 'category_id' => 3, 'pages' => 336, 'stock' => 3, 'description' => 'Pendidikan keuangan dan investasi.'],
            ['title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata', 'publisher' => 'Bentang Pustaka', 'year' => 2005, 'isbn' => '9789793062792', 'category_id' => 4, 'pages' => 529, 'stock' => 4, 'description' => 'Novel tentang perjuangan anak-anak Belitung untuk sekolah.'],
            ['title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer', 'publisher' => 'Hasta Mitra', 'year' => 1980, 'isbn' => '9789798456007', 'category_id' => 4, 'pages' => 535, 'stock' => 2, 'description' => 'Kuatrilogi Buru jilid pertama.'],
            ['title' => 'Sejarah Indonesia Modern', 'author' => 'M.C. Ricklefs', 'publisher' => 'Gadjah Mada University Press', 'year' => 2008, 'isbn' => '9789794206010', 'category_id' => 5, 'pages' => 480, 'stock' => 2, 'description' => 'Sejarah Indonesia dari masa kolonial hingga merdeka.'],
            ['title' => 'Struktur Data dan Algoritma', 'author' => 'Rinaldi Munir', 'publisher' => 'Informatika', 'year' => 2018, 'isbn' => '9786023030555', 'category_id' => 7, 'pages' => 400, 'stock' => 3, 'description' => 'Buku teks kuliah struktur data.'],
            ['title' => 'Pemrograman Web dengan PHP', 'author' => 'Budi Raharjo', 'publisher' => 'Informatika', 'year' => 2020, 'isbn' => '9786023030883', 'category_id' => 7, 'pages' => 350, 'stock' => 4, 'description' => 'Belajar PHP dari dasar hingga framework.'],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        $members = [
            ['member_id' => 'ANG001', 'name' => 'Ahmad Santoso', 'nim' => '2021001', 'class_name' => 'TI-2A', 'phone' => '081234567890', 'email' => 'ahmad@student.ac.id', 'status' => 'Aktif'],
            ['member_id' => 'ANG002', 'name' => 'Siti Rahayu', 'nim' => '2021002', 'class_name' => 'TI-2B', 'phone' => '081234567891', 'email' => 'siti@student.ac.id', 'status' => 'Aktif'],
            ['member_id' => 'ANG003', 'name' => 'Budi Prasetyo', 'nim' => '2020015', 'class_name' => 'SI-3A', 'phone' => '081234567892', 'email' => 'budi@student.ac.id', 'status' => 'Aktif'],
            ['member_id' => 'ANG004', 'name' => 'Dewi Lestari', 'nim' => '2020016', 'class_name' => 'SI-3B', 'phone' => '081234567893', 'email' => 'dewi@student.ac.id', 'status' => 'Nonaktif'],
            ['member_id' => 'ANG005', 'name' => 'Rizki Maulana', 'nim' => '2022001', 'class_name' => 'TI-1A', 'phone' => '081234567894', 'email' => 'rizki@student.ac.id', 'status' => 'Aktif'],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }

        $this->call(UserSeeder::class);
    }
}