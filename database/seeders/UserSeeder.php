<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@perpustakaan.test'],
            [
                'name' => 'Administrator Perpustakaan',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'petugas@perpustakaan.test'],
            [
                'name' => 'Siti Pustakawan',
                'password' => Hash::make('password'),
                'role' => 'Pustakawan',
            ]
        );
    }
}

