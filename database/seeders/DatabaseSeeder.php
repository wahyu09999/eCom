<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'nama' => 'Adminsitrator',
            'alamat' => 'Malang',
            'no_hp' => '085648989767',
            'email' => 'admin@gmail.com',
            'role' => 'adm',
            'password' => Hash::make('admin2021'),
            'email_verified_at' => now()
        ]);

        User::create([
            'nama' => 'User',
            'alamat' => 'Malang',
            'no_hp' => '085648989767',
            'email' => 'user@gmail.com',
            'role' => 'usr',
            'password' => Hash::make('user2021'),
            'email_verified_at' => now()
        ]);
    }
}