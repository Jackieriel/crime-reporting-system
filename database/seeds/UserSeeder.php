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
            [
                'name' => 'Tessy',
                'email' => 'tesscrsystem@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('password'),
                'gender' => 'female',
                'phone' => '08140800141',
                'role' => 'superAdmin',
                'photo' => 'uploads/profile/avater.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Udoh',
                'email' => 'wanaciousfellow@gmail.com',
                'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'password' => Hash::make('GreensoN'),
                'gender' => 'female',
                'phone' => '08140800141',
                'role' => 'reporter',
                'photo' => 'uploads/profile/avater.jpg',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
