<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('app_db')->table('roles_permissions')->insert(array(
            array('role_id' => '1', 'permission_id' => '1'),
            array('role_id' => '1', 'permission_id' => '2'),
            array('role_id' => '1', 'permission_id' => '3'),
            array('role_id' => '1', 'permission_id' => '4'),
            array('role_id' => '1', 'permission_id' => '5'),
            array('role_id' => '1', 'permission_id' => '6'),
            array('role_id' => '1', 'permission_id' => '7'),
            array('role_id' => '1', 'permission_id' => '8'),
            array('role_id' => '1', 'permission_id' => '9'),
            array('role_id' => '1', 'permission_id' => '10'),
            array('role_id' => '1', 'permission_id' => '11'),
            array('role_id' => '1', 'permission_id' => '12'),
            array('role_id' => '1', 'permission_id' => '13'),
            array('role_id' => '1', 'permission_id' => '14'),
            array('role_id' => '1', 'permission_id' => '15'),
            array('role_id' => '2', 'permission_id' => '3'),
            array('role_id' => '2', 'permission_id' => '7'),
            array('role_id' => '2', 'permission_id' => '9'),
            array('role_id' => '2', 'permission_id' => '14'),
            array('role_id' => '2', 'permission_id' => '15'),
            array('role_id' => '3', 'permission_id' => '4'),
            array('role_id' => '3', 'permission_id' => '6'),
            array('role_id' => '3', 'permission_id' => '8')
        ));
    }
}
