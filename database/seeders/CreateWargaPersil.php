<?php

namespace Database\Seeders;

use App\Models\Warga;
use App\Models\Persil;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class CreateWargaPersil extends Seeder
{

    /**
     * Run the database seeds.
     */

    // public function run()
    // {
    //      $warga = Warga::create([
    //         'no_ktp' => '654321654321',
    //         'nama' => 'Nurtanio Luqman',
    //         'jenis_kelamin' => 'Male',
    //         'agama' => 'Islam',
    //         'pekerjaan' => 'Karyawan Swasta',
    //         'email' => 'luqman@email.com',
    //         'telp' => '081234567890',
    //     ]);

    //     Persil::create([
    //         'kode_persil' => 'P001',
    //         'pemilik_warga_id' => $warga->warga_id,
    //         'luas_m2' => 150,
    //         'penggunaan' => 'Perumahan',
    //         'alamat_lahan' => 'Jl. Merdeka No.1',
    //         'rt' => '01',
    //         'rw' => '02',
    //     ]);
    // }
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 150; $i++) {

            $warga = Warga::create([
                'no_ktp' => $faker->numerify('################'),
                'nama' => $faker->name(),
                'jenis_kelamin' => $faker->randomElement(['Male', 'Female']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu']),
                'pekerjaan' => $faker->jobTitle(),
                'email' => $faker->unique()->safeEmail(),
                'telp' => $faker->numerify('08##########')
            ]);

            $persilCount = rand(0, 4);

            for ($j = 0; $j < $persilCount; $j++) {
                Persil::create([
                    'kode_persil' => $faker->unique()->bothify('????'),
                    'pemilik_warga_id' => $warga->warga_id,
                    'luas_m2' => $faker->numberBetween(50, 1000),
                    'penggunaan' => $faker->randomElement(['Perumahan', 'Pertanian', 'Perdagangan', 'Peternakkan']),
                    'alamat_lahan' => $faker->address(),
                    'rt' => $faker->numberBetween(1, 20),
                    'rw' => $faker->numberBetween(1, 20)
                ]);
            }
        }
    }
}
