<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\Ignite\Brand::class, 10)->create();
        DB::table('brands')->insert([
            'name' => 'Nissan',
            'country_id' => 'JPN'
        ]);
        DB::table('brands')->insert([
            'name' => 'Toyota',
            'country_id' => 'JPN'
        ]);
        DB::table('brands')->insert([
            'name' => 'Honda',
            'country_id' => 'JPN'
        ]);
        DB::table('brands')->insert([
            'name' => 'Audi',
            'country_id' => 'DEU'
        ]);
        DB::table('brands')->insert([
            'name' => 'Volkswagen',
            'country_id' => 'DEU'
        ]);
        DB::table('brands')->insert([
            'name' => 'Mercedes Benz',
            'country_id' => 'DEU'
        ]);
        DB::table('brands')->insert([
            'name' => 'BMW',
            'country_id' => 'DEU'
        ]);
        DB::table('brands')->insert([
            'name' => 'Ford',
            'country_id' => 'USA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Chevrolet',
            'country_id' => 'USA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Jeep',
            'country_id' => 'USA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Fiat',
            'country_id' => 'ITA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Peugeot',
            'country_id' => 'FRA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Pontiac',
            'country_id' => 'USA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Mazda',
            'country_id' => 'JPN'
        ]);
        DB::table('brands')->insert([
            'name' => 'Kia',
            'country_id' => 'KOR'
        ]);
        DB::table('brands')->insert([
            'name' => 'Hyundai',
            'country_id' => 'KOR'
        ]);
        DB::table('brands')->insert([
            'name' => 'Jaguar',
            'country_id' => 'GBR'
        ]);
        DB::table('brands')->insert([
            'name' => 'Volvo',
            'country_id' => 'SWE'
        ]);
        DB::table('brands')->insert([
            'name' => 'Ferrari',
            'country_id' => 'ITA'
        ]);
        DB::table('brands')->insert([
            'name' => 'Lamborghini',
            'country_id' => 'ITA'
        ]);
    }
}
