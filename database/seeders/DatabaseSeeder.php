<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ContinentSeeder::class);
        //$this->call(CountriesSeeder::class);
        //$this->call(RegionSeeder::class);
        //$this->call(PermissionsSeeder::class);
        //$this->call(RolesSeeder::class);
        //$this->call(RolesPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CrewJobTypesSeeder::class);
        $this->call(CrewMemberSeeder::class);
    }
}
