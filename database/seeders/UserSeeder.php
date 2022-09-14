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
        $faker = Faker::create('id_ID');
    	for($i = 1; $i <= 5; $i++){
    		DB::table('users')->insert([
    			'name' => $faker->name,
                'role' => 'admin',
    			'email' => $faker->unique()->email,
    			'no_telepon' => $faker->phoneNumber,
    			'password' => $faker->randomDigit,
    			'alamat' => $faker->address
    		]);
    	}
    }
}
