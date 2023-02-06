<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Rendi Purwito Armin',
                'role' => 'admin',
                'email' => 'rendi@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'name' => 'Saputra',
                'role' => 'field_support',
                'email' => 'putra@gmail.com',
                'password' => bcrypt('12345'),
            ],
        ]);
    }
}
