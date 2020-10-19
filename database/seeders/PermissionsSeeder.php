<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('app_db')->table('permissions')->insert(array(
            array('id' => '1', 'name' => 'Add User', 'slug' => 'add-user'),
            array('id' => '2', 'name' => 'Add Reservation', 'slug' => 'add-reservation'),
            array('id' => '3', 'name' => 'View All Reservations', 'slug' => 'view-all-reservations'),
            array('id' => '4', 'name' => 'View My Reservations', 'slug' => 'view-my-reservations'),
            array('id' => '5', 'name' => 'Edit All Reservation', 'slug' => 'edit-all-reservation'),
            array('id' => '6', 'name' => 'Edit My Reservation', 'slug' => 'edit-my-reservation'),
            array('id' => '7', 'name' => 'Edit All Quotation', 'slug' => 'edit-all-quotation'),
            array('id' => '8', 'name' => 'Edit My Quotation', 'slug' => 'edit-my-quotation'),
            array('id' => '9', 'name' => 'Create Invoice', 'slug' => 'create-invoice'),
            array('id' => '10', 'name' => 'Add Hotel', 'slug' => 'add-hotel'),
            array('id' => '11', 'name' => 'Add Park', 'slug' => 'add-park'),
            array('id' => '12', 'name' => 'Add Crew', 'slug' => 'add-crew'),
            array('id' => '13', 'name' => 'Add User', 'slug' => 'add-user'),
            array('id' => '14', 'name' => 'View Users', 'slug' => 'view-users'),
            array('id' => '15', 'name' => 'Create Reports', 'slug' => 'create-reports')
        ));
    }
}
