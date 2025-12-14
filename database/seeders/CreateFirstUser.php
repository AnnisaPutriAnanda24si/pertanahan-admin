<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateFirstUser extends Seeder
{

    /**
     * Run the database seeds.
     */

 public function run()
    {
         User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'Admin',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Client',
            'email' => 'client@example.com',
            'role' => 'Client',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@example.com',
            'role' => 'Staff',
            'password' => Hash::make('password123'),
        ]);
    }
}
