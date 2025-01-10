<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        // $adminRole = Role::create(['name' => 'Admin']);
        // $editorRole = Role::create(['name' => 'Editor']);

        // Create users
        User::create([
            'name' => 'Super',
            'email' => 'super@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Manish',
            'email' => 'manish@example.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Ritesh',
            'email' => 'ritesh@example.com',
            'password' => Hash::make('password'),
        ]);

        // $viewerUser = User::create([
        //     'name' => 'Ritesh',
        //     'email' => 'ritesh@example.com',
        //     'password' => bcrypt('password'),
        // ]);

        // Assign roles to users
        // $adminUser->roles()->attach($adminRole->id); // Attach Admin role
        // $editorUser->roles()->attach($editorRole->id); // Attach Editor role
        // $editorUser->roles()->attach($editorRole->id); // Attach Editor role
    }
}
