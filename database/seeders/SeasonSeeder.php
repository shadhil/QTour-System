<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('hotel_seasons')->insert(array(
            0 =>
            array(
                'code' => 'HS',
                'id' => 1,
                'season' => 'High Season',
            ),
            1 =>
            array(
                'code' => 'MH',
                'id' => 2,
                'season' => 'Mid Season',
            ),
            2 =>
            array(
                'code' => 'LS',
                'id' => 3,
                'season' => 'Low Season',
            ),
        ));
    }
}
