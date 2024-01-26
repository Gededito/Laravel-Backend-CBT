<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 Data Fake User (Pengguna) Seuai dengan table yang ada
        \App\Models\User::factory(10)->create();

        // Membuat data secara statik
        \App\Models\User::create([
            'name' => 'Admin Wijaya',
            'email' => 'wijaya@admin.com',
            'password' => Hash::make('12345678'),
            'roles' => 'ADMIN',
            'phone' => '0987654321',
        ]);
    }
}
