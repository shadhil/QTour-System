<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VisitorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('visitor_types')->insert(array(
            0 =>
            array(
                'id' => 1,
                'type' => 'East Africa Citizen',
            ),
            1 =>
            array(
                'id' => 2,
                'type' => 'Expatriate',
            ),
            2 =>
            array(
                'id' => 3,
                'type' => 'Non Resident',
            ),
            3 =>
            array(
                'id' => 4,
                'name' => 'Local Citizen',
            ),
        ));
    }
}
