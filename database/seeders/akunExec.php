<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class akunExec extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'fmi',
            'email' => 'fmi',
            'role' => 'Admin',
            'password' => Hash::make('fmi'),
        ]);

        User::create([
            'name' => 'fmihmn',
            'email' => 'fmihmn',
            'role' => 'Client',
            'password' => Hash::make('fmihmn'),
        ]);

        User::create([
            'name' => 'hmn',
            'email' => 'hmn',
            'role' => 'Staff',
            'password' => Hash::make('hmn'),
        ]);
    }
}
