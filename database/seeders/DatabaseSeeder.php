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
        // $this->call(ContinentSeeder::class);
        // $this->call(CountriesSeeder::class);
        // $this->call(RegionSeeder::class);
        // $this->call(PermissionsSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(RolesPermissionsSeeder::class);
        // $this->call(CompanySeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(CrewJobTitlesSeeder::class);
        // $this->call(CrewMemberSeeder::class);
        // $this->call(VisitorTypeSeeder::class);
        // $this->call(ParkSeeder::class);
        // $this->call(HotelSeeder::class);
        // $this->call(SeasonSeeder::class);
        $this->call(HotelRateGroupSeeder::class);
        $this->call(HotelMealPlanSeeder::class);
    }
}
