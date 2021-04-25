<?php

use Illuminate\Database\Seeder;

class CrimeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('crime_categories')->insert([
            'category_name' =>'rape',
        ]);
    }
}
