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
                'phone_number' => '081297096073',
                'password' => bcrypt('12345'),
                'address' => 'Jln Tunas Karsa No.56, RT 03/RW 06, Kec Tapos, Depok'
            ],
            [
                'name' => 'Saputra',
                'role' => 'field_support',
                'email' => 'putra@gmail.com',
                'phone_number' => '081297012312',
                'password' => bcrypt('12345'),
                'address' => 'Jln Raya Pelni, Kec Tapos, Depok'
            ],
        ]);
    }
}
