<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Persil;
use App\Models\PetaPersil;
use Illuminate\Http\Request;
use App\Models\DokumenPersil;
use App\Models\SengketaPersil;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ===================== RINGKASAN PETA =====================
        $totalPeta = PetaPersil::count();
        $totalGeojson = PetaPersil::whereNotNull('geojson')->where('geojson', '!=', '')->count();
        $withoutGeojson = $totalPeta - $totalGeojson;

        // ===================== PERSIL USAGE PIE CHART =====================
        $labelPenggunaan = Persil::select('penggunaan')
            ->whereNotNull('penggunaan')
            ->distinct()
            ->pluck('penggunaan');

        $dataPenggunaan = Persil::selectRaw('penggunaan, COUNT(*) as total')
            ->whereNotNull('penggunaan')
            ->groupBy('penggunaan')
            ->pluck('total');

        // ===================== GEOJSON COLLECTION =====================
        $geojsonCollection = PetaPersil::whereNotNull('geojson')
            ->where('geojson', '!=', '')
            ->get()
            ->pluck('geojson')
            ->map(function($g){
                return json_decode($g, true);
            })
            ->values()
            ->toArray();

        // Jika kosong, biar tidak error di Leaflet
        $geojsonData = [
            "type" => "FeatureCollection",
            "features" => []
        ];

        foreach ($geojsonCollection as $geo) {
            if ($geo && isset($geo["features"])) {
                $geojsonData["features"] = array_merge(
                    $geojsonData["features"],
                    $geo["features"]
                );
            }
        }

            // ===================== WARGA =====================
            $totalWarga = Warga::count();
            $wargaPunyaPersil = Warga::whereHas('persil')->count();
            $wargaTanpaPersil = $totalWarga - $wargaPunyaPersil;

            // ===================== TOTAL PERSIL =====================
            $totalPersil = Persil::count();

            // ===================== DOKUMEN =====================
            $totalDokumen = DokumenPersil::count();

            $dokumenPerJenis = DokumenPersil::select('jenis_dokumen', DB::raw('COUNT(*) as total'))
                ->groupBy('jenis_dokumen')
                ->pluck('total', 'jenis_dokumen');

            // ===================== SENGKETA =====================
            $totalSengketa = SengketaPersil::count();

            $statusSengketa = SengketaPersil::select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');

            $sedangProses = $statusSengketa['proses'] ?? 0;
            $selesai = $statusSengketa['selesai'] ?? 0;
            $dibatalkan = $statusSengketa['dibatalkan'] ?? 0;


            // ===================== GRAFIK BULANAN =====================
$tahunSekarang = date('Y');
$persilBulanan = Persil::select(
        DB::raw('MONTH(created_at) as bulan'),
        DB::raw('COUNT(*) as total')
    )
    ->whereYear('created_at', $tahunSekarang)
    ->groupBy(DB::raw('MONTH(created_at)'))
    ->orderBy('bulan')
    ->get()
    ->pluck('total', 'bulan');

// Pastikan semua bulan ada (1-12), isi 0 jika tidak ada data
$chartData = [];
for ($bulan = 1; $bulan <= 12; $bulan++) {
    $chartData[$bulan] = $persilBulanan[$bulan] ?? 0;
}



        return view('pages.admin.dashboard', compact(
            'totalPeta',
            'totalGeojson',
            'withoutGeojson',
            'labelPenggunaan',
            'dataPenggunaan',
            'geojsonData',

            // tambahan baru
            'totalWarga',
            'wargaPunyaPersil',
            'wargaTanpaPersil',

            'totalDokumen',
            'dokumenPerJenis',

            'totalSengketa',
            'sedangProses',
            'selesai',
            'dibatalkan',

            'persilBulanan',
            'totalPersil'
        ));

    }
}
