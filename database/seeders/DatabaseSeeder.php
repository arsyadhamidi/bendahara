<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Level::create([
            'namalevel' => 'Admin',
            'id_level' => '1',
        ]);

        Level::create([
            'namalevel' => 'Bendahara',
            'id_level' => '2',
        ]);

        Level::create([
            'namalevel' => 'Warga',
            'id_level' => '3',
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'password' => bcrypt('12345678'),
            'level_id' => '1',
            'telp' => '083852534934',
        ]);
    }
}
