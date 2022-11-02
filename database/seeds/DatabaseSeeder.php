<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            CountriesTableSeeder::class,
            UsersTypesTableSeeder::class,
            AdminsTableSeeder::class,
            // ClientsTableSeeder::class,
            // MechanicsTableSeeder::class,
            // AssistantsTableSeeder::class,
            // CountersTableSeeder::class,

            SpecialtiesTableSeeder::class,
            BrandsTableSeeder::class,
            TransmissionsTableSeeder::class,
            CategoriesTableSeeder::class,
            ModelsTableSeeder::class,
        ]);
    }
}
