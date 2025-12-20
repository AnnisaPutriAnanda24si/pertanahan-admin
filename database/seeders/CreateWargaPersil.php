<?php

namespace Database\Seeders;

use App\Models\Warga;
use App\Models\Persil;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

// class CreateWargaPersil extends Seeder
// {

//     public function run()
//     {
//         $faker = Faker::create('id_ID');

//         for ($i = 0; $i < 1000; $i++) {
//             $name = $faker->unique()->name();
//             $email = strtolower(str_replace(' ', '', $name)) . '@example.com';

//             $warga = Warga::create([
//                 'no_ktp' => $faker->numerify('################'),
//                 'nama' => $name,
//                 'jenis_kelamin' => $faker->randomElement(['Male', 'Female']),
//                 'agama' => $faker->randomElement(['Islam', 'Kristen', 'Protestan', 'Hindu', 'Budha', 'Konghucu']),
//                 'pekerjaan' => $faker->jobTitle(),
//                 'email' => $email,
//                 'telp' => $faker->numerify('08##########')
//             ]);

//             for ($j = 0; $j < rand(0, 4); $j++) {
//                 Persil::create([
//                     'kode_persil' => 'P' . $faker->unique()->numerify('#####'),
//                     'pemilik_warga_id' => $warga->warga_id,
//                     'luas_m2' => $faker->numberBetween(50, 1000),
//                     'penggunaan' => $faker->randomElement(['Rumah', 'Sawah', 'Kebun', 'Toko', 'Peternakkan']),
//                     'alamat_lahan' => $faker->address(),
//                     'rt' => $faker->numberBetween(1, 10),
//                     'rw' => $faker->numberBetween(1, 10)
//                 ]);
//             }
//         }
//     }
// }

class CreateWargaPersil extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Jenis dokumen yang tersedia
        $jenisDokumen = ['SHM', 'SHGB', 'AJB', 'Girik', 'Letter C', 'SKT'];

        // Status sengketa
        $statusSengketa = ['proses', 'selesai', 'dibatalkan'];

        for ($i = 0; $i < 100; $i++) {
            // Buat warga
            $name = $faker->unique()->name();
            $email = strtolower(str_replace(' ', '', $name)) . '@example.com';

            $warga = Warga::create([
                'no_ktp' => $faker->numerify('################'),
                'nama' => $name,
                'jenis_kelamin' => $faker->randomElement(['Male', 'Female']),
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Protestan', 'Hindu', 'Budha', 'Konghucu']),
                'pekerjaan' => $faker->jobTitle(),
                'email' => $email,
                'telp' => $faker->numerify('08##########')
            ]);

            // Buat persil untuk warga ini (0-4 persil per warga)
            $jumlahPersil = rand(0, 4);

            for ($j = 0; $j < $jumlahPersil; $j++) {
                $persil = Persil::create([
                    'kode_persil' => 'P' . $faker->unique()->numerify('#####'),
                    'pemilik_warga_id' => $warga->warga_id,
                    'luas_m2' => $faker->numberBetween(50, 1000),
                    'penggunaan' => $faker->randomElement(['Rumah', 'Sawah', 'Kebun', 'Toko', 'Peternakkan']),
                    'alamat_lahan' => $faker->address(),
                    'rt' => $faker->numberBetween(1, 10),
                    'rw' => $faker->numberBetween(1, 10)
                ]);

                // ===================== DOKUMEN PERSIL (1-3 dokumen per persil) =====================
                $jumlahDokumen = rand(1, 3);
                for ($d = 0; $d < $jumlahDokumen; $d++) {
                    DokumenPersil::create([
                        'persil_id' => $persil->persil_id,
                        'nomor' => $faker->numberBetween(1000, 99999), // integer
                        'jenis_dokumen' => $faker->randomElement($jenisDokumen),
                        'keterangan' => $faker->sentence(6)
                    ]);
                }

                // ===================== SENGGETA PERSIL (30% kemungkinan punya sengketa) =====================
                if (rand(1, 100) <= 30) { // 30% persil memiliki sengketa
                    SengketaPersil::create([
                        'persil_id' => $persil->persil_id,
                        'pihak_1' => $faker->name(),
                        'pihak_2' => $faker->name(),
                        'kronologi' => $faker->paragraph(3),
                        'status' => $faker->randomElement($statusSengketa),
                        'penyelesaian' => $faker->optional(0.7)->paragraph(2) // 70% memiliki penyelesaian
                    ]);
                }

                if (rand(1, 100) <= 80) { // 80% persil memiliki peta
                    // Buat geojson sederhana
                    $geojson = [
                        'type' => 'Feature',
                        'geometry' => [
                            'type' => 'Polygon',
                            'coordinates' => [[
                                [$faker->longitude(), $faker->latitude()],
                                [$faker->longitude(), $faker->latitude()],
                                [$faker->longitude(), $faker->latitude()],
                                [$faker->longitude(), $faker->latitude()],
                                [$faker->longitude(), $faker->latitude()] // kembali ke titik awal
                            ]]
                        ],
                        'properties' => [
                            'name' => $persil->kode_persil,
                            'luas' => $persil->luas_m2
                        ]
                    ];

                    PetaPersil::create([
                        'persil_id' => $persil->persil_id,
                        'geojson' => json_encode($geojson),
                        'panjang_m' => $faker->numberBetween(10, 100),
                        'lebar_m' => $faker->numberBetween(10, 50)
                    ]);
                }
            }

            // Progress indicator
            if (($i + 1) % 100 == 0) {
                echo "Created " . ($i + 1) . " warga with their data...\n";
            }
        }

        echo "\nSeeder completed!\n";
        echo "Total Warga: " . Warga::count() . "\n";
        echo "Total Persil: " . Persil::count() . "\n";
        echo "Total Dokumen: " . DokumenPersil::count() . "\n";
        echo "Total Sengketa: " . SengketaPersil::count() . "\n";
        echo "Total Peta: " . PetaPersil::count() . "\n";
    }
}
