<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Default credentials
        // \App\Models\User::insert([
        //     [
        //         'first_name' => 'Left4code',
        //         'last_name' => 'Opps!',
        //         'email' => 'midone@left4code.com',
        //         //'email_verified_at' => now(),
        //         'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //         'gender' => 'male',
        //         //'active' => 1,
        //         //'remember_token' => Str::random(10)
        //     ]
        // ]);

        // Fake users
        User::factory()->times(100)->create();
        foreach (User::all() as $user) {
            $roles = Role::inRandomOrder()->take(rand(1, 1))->pluck('id');
            $permissions = Permission::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $user->roles()->attach($roles);
            $user->permissions()->attach($permissions);
        }
    }
}
