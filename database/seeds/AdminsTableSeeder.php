<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'dui' => '00000000-0',
            'email' => 'mariobeltran0699@gmail.comm',
            'password' => bcrypt('bg171969'),
            'name' => 'Mario Josue',
            'lastname' => 'Beltran Garcia',
            'birthdate' => '1998-09-26',
            'age' => 21,
            'address' => 'Sta. Tecla',
            'phone' => '0000-0000',
            'user_type_id' => 'ADM',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'dui' => '00000000-1',
            'email' => 'diego.lem077@gmail.com',
            'password' => bcrypt('lt171997'),
            'name' => 'Diego Alberto',
            'lastname' => 'Lemus Torres',
            'birthdate' => '1998-04-01',
            'age' => 18,
            'address' => 'Colonia la buena vida',
            'phone' => '0000-0000',
            'user_type_id' => 'ASI',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'dui' => '00000000-2',
            'email' => 'a1299r5@gmail.com',
            'password' => bcrypt('rq172027'),
            'name' => 'Kevin Alejandro',
            'lastname' => 'Romero Quijano',
            'birthdate' => '1999-04-07',
            'age' => 19,
            'address' => 'Por el volcán',
            'phone' => '0000-0000',
            'user_type_id' => 'ASI',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'dui' => '00000000-3',
            'email' => 'erickbvb009@gmail.com',
            'password' => bcrypt('au171965'),
            'name' => 'Erick Gilberto',
            'lastname' => 'Aguilar Urquilla',
            'birthdate' => '1999-07-10',
            'age' => 18,
            'address' => 'por san vicente',
            'phone' => '0000-0000',
            'user_type_id' => 'MCO',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);

        DB::table('users')->insert([
            'dui' => '00000000-4',
            'email' => 'lopezleonardo282@gmail.com',
            'password' => bcrypt('lc171998 '),
            'name' => 'Leonardo Elenilson',
            'lastname' => 'Lopez Cañas',
            'birthdate' => '1999-07-10',
            'age' => 18,
            'address' => 'por san vicente',
            'phone' => '0000-0000',
            'user_type_id' => 'MCO',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
