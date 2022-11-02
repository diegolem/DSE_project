<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Ignite\User::class, 10)->create([
            'user_type_id' => 'CLE',
        ]);
    }
}
