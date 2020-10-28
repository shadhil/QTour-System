<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CrewJobTitlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('company_db')->table('crew_job_titles')->insert(array(
            array('id' => '1', 'job_title' => 'Driver'),
            array('id' => '2', 'job_title' => 'Cook'),
            array('id' => '3', 'job_title' => 'Potter')
        ));
    }
}
