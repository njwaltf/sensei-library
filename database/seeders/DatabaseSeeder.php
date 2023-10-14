<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Database\Seeders\BookSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() : void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username' => 'admin_perpus',
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@gmail.com',
            'prof_pic' => 'images/profile/user-2.png',
            'role' => 'admin',
            'password' => Hash::make('admin_perpus')
        ]);

        User::create([
            'username' => 'gojooo',
            'name' => 'Gojo Satoru',
            'email' => 'gojo@gmail.com',
            'prof_pic' => 'images/profile/user-1.jpg',
            'role' => 'member',
            'password' => Hash::make('gojooo')
        ]);

        $this->call(BookSeeder::class);
    }
}