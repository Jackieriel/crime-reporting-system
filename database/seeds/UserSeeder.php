<?php

use Illuminate\Database\Seeder;

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
            'email' => 'jackieriel@tesscrsystem',
            'password' => Hash::make('password'),
            'gender' => 'female',
            'phone' => '08131327382',
            'role' => 'superAdmin',
        ]);

    }
}
