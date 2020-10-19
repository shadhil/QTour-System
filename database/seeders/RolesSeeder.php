<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('app_db')->table('roles')->insert(array(
            array('id' => '1', 'name' => 'Admin', 'slug' => 'admin'),
            array('id' => '2', 'name' => 'Accountant', 'slug' => 'accountant'),
            array('id' => '3', 'name' => 'Booker', 'slug' => 'Booker')
        ));
    }
}
