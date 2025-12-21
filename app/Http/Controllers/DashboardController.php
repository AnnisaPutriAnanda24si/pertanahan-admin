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
        // Ringkasan Peta Persil
        $totalPeta = PetaPersil::count();
        $totalGeojson = PetaPersil::whereNotNull('geojson')->where('geojson', '!=', '')->count();
        $withoutGeojson = $totalPeta - $totalGeojson;

        // Label Persil
        $labelPenggunaan = Persil::select('penggunaan')
            ->whereNotNull('penggunaan')
            ->distinct()
            ->pluck('penggunaan');

        $dataPenggunaan = Persil::selectRaw('penggunaan, COUNT(*) as total')
            ->whereNotNull('penggunaan')
            ->groupBy('penggunaan')
            ->pluck('total');

        $geojsonData = [
            "type" => "FeatureCollection",
            "features" => []
        ];

            // Hitung Warga
            $totalWarga = Warga::count();
            $wargaPunyaPersil = Warga::whereHas('persil')->count();
            $wargaTanpaPersil = $totalWarga - $wargaPunyaPersil;

            // Hitung Persil
            $totalPersil = Persil::count();

            // Hitung Dokumen
            $totalDokumen = DokumenPersil::count();
            $dokumenPerJenis = DokumenPersil::select('jenis_dokumen', DB::raw('COUNT(*) as total'))
                ->groupBy('jenis_dokumen')
                ->pluck('total', 'jenis_dokumen');

            // Hitung Sengketa
            $totalSengketa = SengketaPersil::count();
            $statusSengketa = SengketaPersil::select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status');
            $sedangProses = $statusSengketa['proses'] ?? 0;
            $selesai = $statusSengketa['selesai'] ?? 0;
            $dibatalkan = $statusSengketa['dibatalkan'] ?? 0;


        return view('pages.admin.dashboard', compact(
            'totalPeta',
            'totalGeojson',
            'withoutGeojson',
            'labelPenggunaan',
            'dataPenggunaan',
            'geojsonData',
            'totalWarga',
            'wargaPunyaPersil',
            'wargaTanpaPersil',

            'totalDokumen',
            'dokumenPerJenis',

            'totalSengketa',
            'sedangProses',
            'selesai',
            'dibatalkan',

            // 'persilBulanan',
            'totalPersil'
        ));

    }
}
