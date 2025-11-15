<?php

namespace Database\Seeders;

use App\Models\Warga;
use App\Models\Persil;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateWargaPersil extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
         $warga = Warga::create([
            'no_ktp' => '1234567890123456',
            'nama' => 'Nurtanio Luqman',
            'jenis_kelamin' => 'Male',
            'agama' => 'Islam',
            'pekerjaan' => 'Karyawan Swasta',
            'email' => 'luqman@email.com',
            'telp' => '081234567890',
        ]);

        Persil::create([
            'kode_persil' => 'P001',
            'pemilik_warga_id' => $warga->warga_id,
            'luas_m2' => 150,
            'penggunaan' => 'Perumahan',
            'alamat_lahan' => 'Jl. Merdeka No.1',
            'rt' => '01',
            'rw' => '02',
        ]);
    }
}
