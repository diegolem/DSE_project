<?php

use Illuminate\Database\Seeder;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\Ignite\CarModel::class, 10)->create();
        DB::table('models')->insert([
            'name' => 'Toyota Corolla',
            'brand_id' => 2
        ]);
        DB::table('models')->insert([
            'name' => 'Honda Civic',
            'brand_id' => 3
        ]);
        DB::table('models')->insert([
            'name' => 'Nissan Sentra',
            'brand_id' => 1
        ]);
        DB::table('models')->insert([
            'name' => 'Ford Focus',
            'brand_id' => 8
        ]);
        DB::table('models')->insert([
            'name' => 'Mercedez-AMG',
            'brand_id' => 6
        ]);
        DB::table('models')->insert([
            'name' => 'Audi A4',
            'brand_id' => 4
        ]);
        DB::table('models')->insert([
            'name' => 'Volkswagen Jettaa',
            'brand_id' => 5
        ]);
        DB::table('models')->insert([
            'name' => 'BMW X1',
            'brand_id' => 7
        ]);
        DB::table('models')->insert([
            'name' => 'Ford Explorer',
            'brand_id' => 8
        ]);
        DB::table('models')->insert([
            'name' => 'Chevrolet Tahoe',
            'brand_id' => 9
        ]);
        DB::table('models')->insert([
            'name' => 'Jeep Wrangler',
            'brand_id' => 10
        ]);
        DB::table('models')->insert([
            'name' => 'Fiat Cronos',
            'brand_id' => 11
        ]);
        DB::table('models')->insert([
            'name' => 'Peugeot 307',
            'brand_id' => 12
        ]);
        DB::table('models')->insert([
            'name' => 'Pontiac Vibe',
            'brand_id' => 13
        ]);
        DB::table('models')->insert([
            'name' => 'Mazda 3',
            'brand_id' => 14
        ]);
        DB::table('models')->insert([
            'name' => 'Kia Forte',
            'brand_id' => 15
        ]);
        DB::table('models')->insert([
            'name' => 'Hyundai Elantra',
            'brand_id' => 16
        ]);
        DB::table('models')->insert([
            'name' => 'Jaguar XE',
            'brand_id' => 17
        ]);
        DB::table('models')->insert([
            'name' => 'Volvo XC90',
            'brand_id' => 18
        ]);
        DB::table('models')->insert([
            'name' => 'Ferrari F12',
            'brand_id' => 19
        ]);
        DB::table('models')->insert([
            'name' => 'Lamborghini Diablo',
            'brand_id' => 20
        ]);
    }
}
