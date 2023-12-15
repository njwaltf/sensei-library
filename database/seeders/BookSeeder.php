<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        $books = [
            [
                'id' => 1,
                'title' => 'Jujutsu Kaisen 5',
                'publisher' => 'Elex Media Komputindo',
                'type_id' => 1,
                'stock' => 200,
                'publish_date' => '2023-12-10',
                'image' => 'book-image/UNTV5RtEg2kh5dMoqWlZfU718LMbB8Smcy97daIT.jpg',
                'desc' => 'Manga Jujutsu Kaisen yang dibuat oleh komikus bernama Akutami Gege ini bercerita tentang Yuuji adalah seorang jenius di trek dan lapangan. Tapi dia sama sekali tidak tertarik untuk berputar-putar, dia bahagia sebagai seorang clam di Klub Penelitian Ilmu Gaib. Meskipun dia hanya ada di klub untuk iseng, keadaan menjadi serius ketika semangat nyata muncul di sekolah! Hidup akan menjadi sangat aneh di SMA Kota Sugisawa!',
                'writer' => 'Gege Akutami',
                'created_at' => '2023-12-13 20:57:27',
                'updated_at' => '2023-12-13 21:57:17',
            ],
            [
                'id' => 6,
                'title' => 'Jujutsu Kaisen 0',
                'publisher' => 'Elex Media Komputindo',
                'type_id' => 1,
                'stock' => 199,
                'publish_date' => '2023-12-10',
                'image' => 'book-image/cover.jpg',
                'desc' => 'Manga Jujutsu Kaisen yang dibuat oleh komikus bernama Akutami Gege ini bercerita tentang Yuuji adalah seorang jenius di trek dan lapangan. Tapi dia sama sekali tidak tertarik untuk berputar-putar, dia bahagia sebagai seorang clam di Klub Penelitian Ilmu Gaib. Meskipun dia hanya ada di klub untuk iseng, keadaan menjadi serius ketika semangat nyata muncul di sekolah! Hidup akan menjadi sangat aneh di SMA Kota Sugisawa!',
                'writer' => 'Gege Akutami',
                'created_at' => '2023-12-13 20:57:27',
                'updated_at' => '2023-12-14 07:49:56',
            ],
            [
                'id' => 7,
                'title' => 'Samurai X',
                'publisher' => 'Elex Media Komputindo',
                'type_id' => 1,
                'stock' => 199,
                'publish_date' => '2023-12-10',
                'image' => 'book-image/P9XFBB41ClpPQBwO2ksYJQQcuUJbNzarUUUGMgbR.jpg',
                'desc' => 'Manga Jujutsu Kaisen yang dibuat oleh komikus bernama Akutami Gege ini bercerita tentang Yuuji adalah seorang jenius di trek dan lapangan. Tapi dia sama sekali tidak tertarik untuk berputar-putar, dia bahagia sebagai seorang clam di Klub Penelitian Ilmu Gaib. Meskipun dia hanya ada di klub untuk iseng, keadaan menjadi serius ketika semangat nyata muncul di sekolah! Hidup akan menjadi sangat aneh di SMA Kota Sugisawa!',
                'writer' => 'Nobuhiro Watsuki',
                'created_at' => '2023-12-13 20:57:27',
                'updated_at' => '2023-12-21 23:21:27',
            ],
            [
                'id' => 8,
                'title' => 'Naruto Vol.61',
                'publisher' => 'Elex Media Komputindo',
                'type_id' => 1,
                'stock' => 99,
                'publish_date' => '2023-12-10',
                'image' => 'book-image/Xi5dFhGeNPbQwEfU8YGnCfs5V3BV6YL1I2aty5uo.jpg',
                'desc' => 'Manga Jujutsu Kaisen yang dibuat oleh komikus bernama Akutami Gege ini bercerita tentang Yuuji adalah seorang jenius di trek dan lapangan. Tapi dia sama sekali tidak tertarik untuk berputar-putar, dia bahagia sebagai seorang clam di Klub Penelitian Ilmu Gaib. Meskipun dia hanya ada di klub untuk iseng, keadaan menjadi serius ketika semangat nyata muncul di sekolah! Hidup akan menjadi sangat aneh di SMA Kota Sugisawa!',
                'writer' => 'Masashi Kishimoto',
                'created_at' => '2023-12-13 20:57:27',
                'updated_at' => '2023-12-14 07:50:01',
            ],
            [
                'id' => 9,
                'title' => 'Chainsawman 3',
                'publisher' => 'Elex Media Komputindo',
                'type_id' => 1,
                'stock' => 199,
                'publish_date' => '2023-12-10',
                'image' => 'book-image/SnAVRNrHepFNXI0atmBgedzEvvrbSqkgRqVwUi5f.jpg',
                'desc' => 'Manga Jujutsu Kaisen yang dibuat oleh komikus bernama Akutami Gege ini bercerita tentang Yuuji adalah seorang jenius di trek dan lapangan. Tapi dia sama sekali tidak tertarik untuk berputar-putar, dia bahagia sebagai seorang clam di Klub Penelitian Ilmu Gaib. Meskipun dia hanya ada di klub untuk iseng, keadaan menjadi serius ketika semangat nyata muncul di sekolah! Hidup akan menjadi sangat aneh di SMA Kota Sugisawa!',
                'writer' => 'Tatsuki Fujimoto',
                'created_at' => '2023-12-13 20:57:27',
                'updated_at' => '2023-12-14 07:28:10',
            ],
        ];

        // Insert the data into the 'books' table
        DB::table('books')->insert($books);
    }
}
