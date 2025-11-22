<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\JenisPenggunaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateJenisPenggunaan extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run()
{
    $faker = Faker::create('id_ID');

    for ($i = 0; $i < 100; $i++) {
        JenisPenggunaan::create([
            'nama_penggunaan' => $faker->unique()->word(),
            'keterangan' => $faker->sentence(1),
        ]);
    }
}

}
