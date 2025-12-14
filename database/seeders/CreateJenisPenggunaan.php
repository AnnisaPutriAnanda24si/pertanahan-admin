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

    // 100 data
    $data = [
    ['nama' => 'Pemukiman', 'keterangan' => 'Untuk tempat tinggal penduduk'],
    ['nama' => 'Sawah', 'keterangan' => 'Lahan basah untuk padi'],
    ['nama' => 'Tegalan', 'keterangan' => 'Lahan kering untuk palawija'],
    ['nama' => 'Perkebunan Sawit', 'keterangan' => 'Kebun kelapa sawit'],
    ['nama' => 'Perkebunan Karet', 'keterangan' => 'Kebun karet'],
    ['nama' => 'Perkebunan Kopi', 'keterangan' => 'Kebun kopi'],
    ['nama' => 'Perkebunan Teh', 'keterangan' => 'Kebun teh'],
    ['nama' => 'Perkebunan Coklat', 'keterangan' => 'Kebun kakao'],
    ['nama' => 'Peternakan Sapi', 'keterangan' => 'Area peternakan sapi'],
    ['nama' => 'Peternakan Ayam', 'keterangan' => 'Peternakan unggas'],
    ['nama' => 'Tambak Ikan', 'keterangan' => 'Kolam budidaya ikan'],
    ['nama' => 'Tambak Udang', 'keterangan' => 'Budidaya udang'],
    ['nama' => 'Industri', 'keterangan' => 'Kawasan industri'],
    ['nama' => 'Perdagangan', 'keterangan' => 'Pusat perbelanjaan'],
    ['nama' => 'Perkantoran', 'keterangan' => 'Gedung kantor'],
    ['nama' => 'Sekolah', 'keterangan' => 'Lembaga pendidikan'],
    ['nama' => 'Rumah Sakit', 'keterangan' => 'Fasilitas kesehatan'],
    ['nama' => 'Masjid', 'keterangan' => 'Tempat ibadah Islam'],
    ['nama' => 'Gereja', 'keterangan' => 'Tempat ibadah Kristen'],
    ['nama' => 'Pura', 'keterangan' => 'Tempat ibadah Hindu'],
    ['nama' => 'Vihara', 'keterangan' => 'Tempat ibadah Buddha'],
    ['nama' => 'Taman', 'keterangan' => 'Area hijau publik'],
    ['nama' => 'Lapangan', 'keterangan' => 'Lapangan olahraga'],
    ['nama' => 'Pertambangan', 'keterangan' => 'Area penambangan'],
    ['nama' => 'Hutan Produksi', 'keterangan' => 'Hutan untuk produksi kayu'],
    ['nama' => 'Hutan Lindung', 'keterangan' => 'Hutan yang dilindungi'],
    ['nama' => 'Jalan', 'keterangan' => 'Prasarana transportasi'],
    ['nama' => 'Bandara', 'keterangan' => 'Bandar udara'],
    ['nama' => 'Pelabuhan', 'keterangan' => 'Pelabuhan laut'],
    ['nama' => 'Hotel', 'keterangan' => 'Akomodasi pariwisata'],
    ['nama' => 'Restoran', 'keterangan' => 'Usaha makanan'],
    ['nama' => 'Militer', 'keterangan' => 'Fasilitas pertahanan'],
    ['nama' => 'Kosong', 'keterangan' => 'Lahan tidak terpakai'],
    ['nama' => 'Perkebunan Kelapa', 'keterangan' => 'Kebun kelapa'],
    ['nama' => 'Perkebunan Lada', 'keterangan' => 'Kebun lada'],
    ['nama' => 'Perkebunan Vanili', 'keterangan' => 'Kebun vanili'],
    ['nama' => 'Peternakan Kambing', 'keterangan' => 'Area peternakan kambing'],
    ['nama' => 'Peternakan Domba', 'keterangan' => 'Area peternakan domba'],
    ['nama' => 'Kolam Renang', 'keterangan' => 'Fasilitas rekreasi air'],
    ['nama' => 'Gudang', 'keterangan' => 'Tempat penyimpanan barang'],
    ['nama' => 'SPBU', 'keterangan' => 'Stasiun Pengisian Bahan Bakar Umum'],
    ['nama' => 'Parkir', 'keterangan' => 'Area parkir kendaraan'],
    ['nama' => 'Pasar', 'keterangan' => 'Pusat perdagangan tradisional'],
    ['nama' => 'Mall', 'keterangan' => 'Pusat perbelanjaan modern'],
    ['nama' => 'Universitas', 'keterangan' => 'Perguruan tinggi'],
    ['nama' => 'Klinik', 'keterangan' => 'Fasilitas kesehatan kecil'],
    ['nama' => 'Apotek', 'keterangan' => 'Tempat penjualan obat'],
    ['nama' => 'Bengkel', 'keterangan' => 'Tempat perbaikan kendaraan'],
    ['nama' => 'Stadion', 'keterangan' => 'Tempat olahraga besar'],
    ['nama' => 'GOR', 'keterangan' => 'Gedung Olahraga'],
    ['nama' => 'Museum', 'keterangan' => 'Tempat penyimpanan benda bersejarah'],
    ['nama' => 'Perpustakaan', 'keterangan' => 'Tempat koleksi buku'],
    ['nama' => 'Kantor Pos', 'keterangan' => 'Layanan pos dan paket'],
    ['nama' => 'Stasiun Kereta', 'keterangan' => 'Tempat pemberhentian kereta'],
    ['nama' => 'Terminal Bus', 'keterangan' => 'Tempat pemberhentian bus'],
    ['nama' => 'Pompa Air', 'keterangan' => 'Sumber air masyarakat'],
    ['nama' => 'Menara', 'keterangan' => 'Bangunan tinggi untuk berbagai keperluan'],
    ['nama' => 'Rumah Pompa', 'keterangan' => 'Bangunan pengatur air'],
    ['nama' => 'Bendungan', 'keterangan' => 'Pengendali aliran air'],
    ['nama' => 'Waduk', 'keterangan' => 'Tempat penampungan air'],
    ['nama' => 'Pemakaman', 'keterangan' => 'Tempat penguburan jenazah'],
    ['nama' => 'Krematorium', 'keterangan' => 'Tempat pembakaran jenazah'],
    ['nama' => 'Panti Asuhan', 'keterangan' => 'Tempat pengasuhan anak yatim'],
    ['nama' => 'Panti Jompo', 'keterangan' => 'Tempat perawatan lansia'],
    ['nama' => 'Laboratorium', 'keterangan' => 'Tempat penelitian dan uji coba'],
    ['nama' => 'Green House', 'keterangan' => 'Rumah kaca untuk tanaman'],
    ['nama' => 'Kantor Polisi', 'keterangan' => 'Kantor kepolisian'],
    ['nama' => 'Kantor Pemadam', 'keterangan' => 'Kantor pemadam kebakaran'],
    ['nama' => 'Menara SUTET', 'keterangan' => 'Saluran Udara Tegangan Ekstra Tinggi'],
    ['nama' => 'Base Transceiver Station', 'keterangan' => 'Stasiun pemancar telekomunikasi'],
    ['nama' => 'Rumah Sakit Hewan', 'keterangan' => 'Fasilitas kesehatan hewan'],
    ['nama' => 'Kebun Binatang', 'keterangan' => 'Tempat koleksi satwa'],
    ['nama' => 'Taman Safari', 'keterangan' => 'Kawasan konservasi satwa'],
    ['nama' => 'Waterboom', 'keterangan' => 'Wahana permainan air'],
    ['nama' => 'Golf Course', 'keterangan' => 'Lapangan golf'],
    ['nama' => 'Perkebunan Tebu', 'keterangan' => 'Kebun tebu untuk gula'],
    ['nama' => 'Perkebunan Tembakau', 'keterangan' => 'Kebun tembakau'],
    ['nama' => 'Tambak Garam', 'keterangan' => 'Area produksi garam'],
    ['nama' => 'Lapangan Tembak', 'keterangan' => 'Area latihan menembak'],
    ['nama' => 'Helipad', 'keterangan' => 'Tempat pendaratan helikopter'],
    ['nama' => 'Dermaga', 'keterangan' => 'Tempat sandar kapal kecil'],
    ['nama' => 'Pangkalan Ojek', 'keterangan' => 'Tempat tunggu ojek'],
    ['nama' => 'Warung', 'keterangan' => 'Usaha makanan kecil'],
    ['nama' => 'Kios', 'keterangan' => 'Tempat usaha kecil'],
    ['nama' => 'Ruko', 'keterangan' => 'Rumah toko'],
    ['nama' => 'Rukan', 'keterangan' => 'Rumah kantor'],
    ['nama' => 'Kost', 'keterangan' => 'Tempat sewa kamar'],
    ['nama' => 'Kontrakan', 'keterangan' => 'Rumah sewa'],
    ['nama' => 'Villa', 'keterangan' => 'Rumah peristirahatan'],
    ['nama' => 'Bungalow', 'keterangan' => 'Rumah kecil di area wisata'],
    ['nama' => 'Resort', 'keterangan' => 'Akomodasi wisata lengkap'],
    ['nama' => 'Penginapan', 'keterangan' => 'Tempat menginap sederhana'],
    ['nama' => 'Asrama', 'keterangan' => 'Tempat tinggal bersama'],
    ['nama' => 'Mess', 'keterangan' => 'Tempat tinggal karyawan'],
    ['nama' => 'Gedung Serbaguna', 'keterangan' => 'Bangunan untuk berbagai acara'],
    ['nama' => 'Balai Desa', 'keterangan' => 'Kantor pemerintahan desa'],
    ['nama' => 'Kantor Kecamatan', 'keterangan' => 'Kantor pemerintahan kecamatan'],
    ['nama' => 'Kantor Kelurahan', 'keterangan' => 'Kantor pemerintahan kelurahan'],
    ['nama' => 'Tempat Pelelangan Ikan', 'keterangan' => 'Pasar ikan lelang'],
    ['nama' => 'Pabrik Es', 'keterangan' => 'Produksi es balok']
    ];

    foreach ($data as $index => $item) {
        JenisPenggunaan::create([
            'nama_penggunaan' => $item['nama'],
            'keterangan' => $item['keterangan'],
        ]);
    }
}


}
