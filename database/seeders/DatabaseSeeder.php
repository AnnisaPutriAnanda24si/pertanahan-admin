<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            $name = $faker->unique()->name();
            $email = strtolower(str_replace(' ', '', $name)) . '@example.com';

            // Profile picture random: 30% kosong, 35% Man.jpg, 35% Woman.jpg
            $profilePicture = null;
            $random = rand(1, 100);

            if ($random <= 35) {
                $profilePicture = 'Man.png';
            } elseif ($random <= 70) {
                $profilePicture = 'Woman.png';
            }

            User::create([
                'name' => $name,
                'email' => $email,
                'role' => 'Client',
                'email_verified_at' => rand(0, 1) ? Carbon::now() : null,
                'password' => Hash::make('password'),
                'profile_picture' => $profilePicture,
            ]);
        }
    }
}
