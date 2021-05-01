<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
            'name' =>'Tessy',
            'email' => 'tessy@tesscrsystem.com',
            'password' => Hash::make('password'),
            'gender' => 'female',
            'phone' => '08131327382',
            'role' => 'superAdmin',
            'photo' => 'uploads/profile/avater.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    }
}

