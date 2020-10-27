<?php

namespace Database\Seeders;

use App\Models\CrewMember;
use Illuminate\Database\Seeder;

class CrewMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Fake members
        CrewMember::factory()->times(45)->create();
    }
}
