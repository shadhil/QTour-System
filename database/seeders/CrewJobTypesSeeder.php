<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewJobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('crew_job_types')->insert(array(
            array('id' => '1', 'job_type' => 'Driver'),
            array('id' => '2', 'job_type' => 'Potter'),
            array('id' => '3', 'job_type' => 'Cook')
        ));
    }
}
