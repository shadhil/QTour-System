<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::connection('app_db')->table('tz_regions')->truncate();

        DB::connection('app_db')->table('tz_regions')->insert(array(
            array('id' => '1', 'region' => 'Arusha'),
            array('id' => '2', 'region' => 'Dar es Salaam'),
            array('id' => '3', 'region' => 'Dodoma'),
            array('id' => '4', 'region' => 'Geita'),
            array('id' => '5', 'region' => 'Iringa'),
            array('id' => '6', 'region' => 'Kagera'),
            array('id' => '7', 'region' => 'Kaskazini Pemba'),
            array('id' => '8', 'region' => 'Kaskazini Unguja'),
            array('id' => '9', 'region' => 'Katavi'),
            array('id' => '10', 'region' => 'Kigoma'),
            array('id' => '11', 'region' => 'Kilimanjaro'),
            array('id' => '12', 'region' => 'Kusini Pemba'),
            array('id' => '13', 'region' => 'Kusini Unguja'),
            array('id' => '14', 'region' => 'Lindi'),
            array('id' => '15', 'region' => 'Manyara'),
            array('id' => '16', 'region' => 'Mara'),
            array('id' => '17', 'region' => 'Mbeya'),
            array('id' => '18', 'region' => 'Mjini Magharibi'),
            array('id' => '19', 'region' => 'Morogoro'),
            array('id' => '20', 'region' => 'Mtwara'),
            array('id' => '21', 'region' => 'Mwanza'),
            array('id' => '22', 'region' => 'Njombe'),
            array('id' => '23', 'region' => 'Pwani'),
            array('id' => '24', 'region' => 'Rukwa'),
            array('id' => '25', 'region' => 'Ruvuma'),
            array('id' => '26', 'region' => 'Shinyanga'),
            array('id' => '27', 'region' => 'Simiyu'),
            array('id' => '28', 'region' => 'Singida'),
            array('id' => '29', 'region' => 'Tabora'),
            array('id' => '30', 'region' => 'Tanga'),
            array('id' => '31', 'region' => 'Songwe')
        ));
    }
}
