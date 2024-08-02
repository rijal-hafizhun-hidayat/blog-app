<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => '$2a$10$u2A1gEVJDaIonQLLyZNnV.UH//Hpjly12XRnZGGWHDqhJ7xAXMsS6'
        ], [
            'name' => 'author',
            'username' => 'author',
            'password' => '$2a$10$SA3uo4bwjuZYbwQiN6ZJKuZTEhQFIdj2YDDVrDR9nWlIBshpubaeS'
        ]);

        DB::table('users')->insert([
            'name' => 'author',
            'username' => 'author',
            'password' => '$2a$10$SA3uo4bwjuZYbwQiN6ZJKuZTEhQFIdj2YDDVrDR9nWlIBshpubaeS'
        ]);
    }
}
