<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Fajar Sidik Prasetio',
            'email' => 'fajarsidikprasetio@gmail.com',
            'password' => Hash::make("fajarsidik"),
            'phone' => '081318591184',
            'isOwner' => 1,
        ]);
    }
}
