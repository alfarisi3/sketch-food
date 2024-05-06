<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin ',
            'phone' => '08123456789',
            'email' => 'admin@sketchfood.com',
            'password' => Hash::make('12345678'),
            'role' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'User Biasa',
            'phone' => '0812345678',
            'email' => 'user@sketchfood.com',
            'password' => Hash::make('12345678'),
            'role' => '0',
        ]);
    }
}
