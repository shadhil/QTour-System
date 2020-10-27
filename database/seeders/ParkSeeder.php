<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('parks')->insert(array(
            0 =>
            array(
                'id' => 1,
                'park_name' => 'Serengeti National Park',
                'region_id' => 16,
            ),
            1 =>
            array(
                'id' => 2,
                'park_name' => 'Ngorongoro National Park',
                'region_id' => 1,
            ),
            2 =>
            array(
                'id' => 3,
                'park_name' => 'Kilimanjaro National Park',
                'region_id' => 11,
            ),
            3 =>
            array(
                'id' => 4,
                'park_name' => 'Tarangire National Park',
                'region_id' => 1,
            ),
            4 =>
            array(
                'id' => 5,
                'park_name' => 'Arusha National Park',
                'region_id' => 1,
            ),
            5 =>
            array(
                'id' => 6,
                'park_name' => 'Mikumi National Park',
                'region_id' => 19,
            ),
            6 =>
            array(
                'id' => 7,
                'park_name' => 'Ruaha National Park',
                'region_id' => 19,
            ),
        ));
    }
}
