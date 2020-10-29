<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelMealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('hotel_meal_plans')->insert(array(
            0 =>
            array(
                'code' => 'BB',
                'id' => 1,
                'meal_plan' => 'Bed and Breakfast',
            ),
            1 =>
            array(
                'code' => 'HB',
                'id' => 2,
                'meal_plan' => 'Half Board',
            ),
            2 =>
            array(
                'code' => 'FB',
                'id' => 3,
                'meal_plan' => 'Full Board',
            ),
            3 =>
            array(
                'code' => 'BO',
                'id' => 4,
                'meal_plan' => 'Bed Only',
            ),
        ));
    }
}
