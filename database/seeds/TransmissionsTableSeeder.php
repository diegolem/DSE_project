<?php

use Illuminate\Database\Seeder;

class TransmissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transmissions')->insert([
            'name' => 'Manual',
            'description' => 'Transmisión manual'
        ]);

        DB::table('transmissions')->insert([
            'name' => 'Automática',
            'description' => 'Transmisión automática'
        ]);

        DB::table('transmissions')->insert([
            'name' => 'Secuencial',
            'description' => 'Transmisión secuencial'
        ]);
    }
}
