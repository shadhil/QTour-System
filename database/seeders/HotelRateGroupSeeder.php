<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelRateGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('hotel_rate_groups')->insert(array(
            0 =>
            array(
                'code' => 'STO',
                'id' => 1,
                'rate_group' => 'Sell to Operator',
            ),
            1 =>
            array(
                'code' => 'RR',
                'id' => 2,
                'rate_group' => 'Rack Rate',
            ),
        ));
    }
}
