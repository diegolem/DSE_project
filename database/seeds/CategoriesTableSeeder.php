<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(\Ignite\Category::class, 10)->create();
        DB::table('categories')->insert([
            'name' => 'Fallo de motor',
            'description' => 'Fallo de motor'
        ]);
        DB::table('categories')->insert([
            'name' => 'Fallo del sistema electric',
            'description' => 'Fallo del sistema electric'
        ]);
        DB::table('categories')->insert([
            'name' => 'Defectos en carroceria',
            'description' => 'Carroceria en mal estado'
        ]);
        DB::table('categories')->insert([
            'name' => 'Llantas en mal estado',
            'description' => 'Llantas en mal estado'
        ]);
    }
}
