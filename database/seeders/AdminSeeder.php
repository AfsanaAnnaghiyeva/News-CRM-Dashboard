<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
            'first_name' => 'Əfsanə',
            'last_name' => 'Ənnağıyeva',
            'email' => 'afsana@gmail.com',
            'password' => bcrypt('Admin'),
            ],
            [
            'first_name' => 'Myth',
            'last_name' => 'Doe',
            'email' => 'myth@gmail.com',
            'password' => bcrypt('Admin'),
            ],
            [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@gmail.com',
            'password' => bcrypt('Admin'),
            ]
        ]);
    }
}
