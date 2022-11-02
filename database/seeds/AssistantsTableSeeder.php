<?php

use Illuminate\Database\Seeder;

class AssistantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Ignite\User::class, 3)->create([
            'user_type_id' => 'ASI',
        ]);
    }
}
