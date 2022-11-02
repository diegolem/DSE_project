<?php

use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        //factory(\Ignite\Especialty::class, 10)->create();
        DB::table('specialties')->insert([
            'name' => 'Electrico',
            'description' => 'Sistema electrico en general'
        ]);
        DB::table('specialties')->insert([
            'name' => 'General',
            'description' => 'Mecanica general'
        ]);
        DB::table('specialties')->insert([
            'name' => 'Carroceria',
            'description' => 'Carroceria en general'
        ]);
        DB::table('specialties')->insert([
            'name' => 'Especial',
            'description' => 'Casos especiales, donde la mecanica general no es suficiente'
        ]);
    }
}
