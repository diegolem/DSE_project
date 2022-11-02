<?php

use Illuminate\Database\Seeder;

class UsersTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users_types')->insert([
            'id' => 'ADM',
            'name' => 'Administrador',
            'description' => ''
        ]);

        DB::table('users_types')->insert([
            'id' => 'CLE',
            'name' => 'Cliente',
            'description' => ''
        ]);

        DB::table('users_types')->insert([
            'id' => 'MCO',
            'name' => 'Mecánico',
            'description' => ''
        ]);

        DB::table('users_types')->insert([
            'id' => 'ASI',
            'name' => 'Asistente',
            'description' => ''
        ]);
    }
}
