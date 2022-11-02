<?php

use Illuminate\Database\Seeder;

class MechanicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Ignite\User::class, 10)->create([
            'user_type_id' => 'MCO',
        ])->each(function($m) {
            $m->specialties()->save(factory(Ignite\Especialty::class)->make());
        });
    }
}
