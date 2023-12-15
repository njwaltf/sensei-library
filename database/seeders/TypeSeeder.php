<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
    {
        Type::create([
            'name' => 'Manga',
            'desc' => 'Manga adalah komik atau novel grafik yang dibuat di Jepang atau menggunakan bahasa Jepang, sesuai dengan gaya yang dikembangkan di sana pada akhir abad ke-19. Manga memiliki sejarah awal yang panjang dan kompleks dalam seni Jepang terdahulu.',
        ]);
        Type::create([
            'name' => 'Science',
            'desc' => 'Ilmu, ilmu pengetahuan, atau sains adalah suatu usaha sistematis dengan metode ilmiah dalam pengembangan dan penataan pengetahuan yang dibuktikan dengan penjelasan dan prediksi yang teruji sebagai pemahaman manusia tentang alam semesta dan dunianya. Segi-segi ini dibatasi agar dihasilkan rumusan-rumusan yang pasti.',
        ]);
        Type::create([
            'name' => 'Manhua',
            'desc' => 'Manhua adalah komik atau novel grafik yang dibuat di Jepang atau menggunakan bahasa Jepang, sesuai dengan gaya yang dikembangkan di sana pada akhir abad ke-19. Manga memiliki sejarah awal yang panjang dan kompleks dalam seni Jepang terdahulu.',
        ]);
    }
}
