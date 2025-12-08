<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Warga;
use App\Models\Persil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::check()) {
        $data['filter'] = Persil::select('penggunaan')->distinct()->get();
        $filterableColumns = ['penggunaan'];
        $searchableColumns = ['penggunaan', 'kode_persil', 'luas_m2'];
        $data['persil'] = Persil::with('warga')
                    ->filter($request, $filterableColumns, $searchableColumns)
                    ->search($request, $searchableColumns)
					->paginate(10)
					->withQueryString(); //join
        return view('pages.admin.persil.tabel-persil', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $warga_id = $request->warga_id; //ambil id dari URL
        $nama_pemilik = Warga::where('warga_id', $warga_id)->value('nama');

        // dd(        [
        // 'warga_id' => $warga_id,
        // 'nama' => $nama_pemilik
        // ]);

        return view('pages.admin.persil.form-persil',
        [
        'warga_id' => $warga_id,
        'nama' => $nama_pemilik
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
    {
        // Validasi data persil
        $dataPersil = $request->validate([
            'kode_persil' => 'required|string|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2' => 'required|integer',
            'penggunaan' => 'required|string|max:100',
            'alamat_lahan' => 'required|string|max:200',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
        ]);

        // Validasi file (jika ada)
        if ($request->hasFile('media_files')) {
            $request->validate([
                'media_files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,xls,geojson,json|max:2048',
                'media_captions.*' => 'nullable|string|max:255',
            ]);
        }

        // 1. SIMPAN DATA PERSIL DULU (mendapatkan persil_id)
        $persil = Persil::create($dataPersil);

        // 2. SIMPAN FILE MEDIA JIKA ADA
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $index => $file) {
                // Simpan file ke storage
                $path = $file->store('uploads/persil', 'public');
                $fileName = basename($path);

                // Simpan ke tabel media
                Media::create([
                    'ref_table' => 'persil',
                    'ref_id' => $persil->persil_id, // ID persil yang baru dibuat
                    'file_name' => $fileName,
                    'caption' => $request->media_captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('persil.index')
            ->with('success', 'Data persil dan file berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id)
    {
        $persil = Persil::with('warga')->findOrFail($id);

        // Ambil semua media untuk persil ini
        $media = Media::where('ref_table', 'persil')
                     ->where('ref_id', $id)
                     ->orderBy('sort_order')
                     ->get();

        // Grouping untuk statistik
        $images = $media->filter(fn($item) => str_contains($item->mime_type, 'image'));
        $documents = $media->filter(fn($item) => str_contains($item->mime_type, 'pdf') ||
                                                str_contains($item->mime_type, 'word') ||
                                                str_contains($item->mime_type, 'excel'));
        $others = $media->filter(fn($item) => !str_contains($item->mime_type, 'image') &&
                                              !str_contains($item->mime_type, 'pdf') &&
                                              !str_contains($item->mime_type, 'word') &&
                                              !str_contains($item->mime_type, 'excel'));

        return view('pages.admin.persil.show-persil', compact('persil', 'media', 'images', 'documents', 'others'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $persil = Persil::findOrFail($id);

    $media = Media::where('ref_table', 'persil')
                 ->where('ref_id', $id)
                 ->orderBy('sort_order')
                 ->get();

    return view('pages.admin.persil.edit-persil', compact('persil', 'media'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
    {
        $persil = Persil::findOrFail($id);

        // Validasi data persil
        $data = $request->validate([
            'kode_persil' => ['required','string','unique:persil,kode_persil,' . $id . ',persil_id'],
            'pemilik_warga_id' => ['required','exists:warga,warga_id'],
            'luas_m2' => 'required|integer',
            'penggunaan' => 'required|string|max:100',
            'alamat_lahan' => 'required|string|max:200',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
        ]);

        // Update data persil
        $persil->update($data);

        // Simpan file baru jika ada (edit mode)
        if ($request->hasFile('media_files')) {
            $request->validate([
                'media_files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,xls,geojson,json|max:2048',
                'media_captions.*' => 'nullable|string|max:255',
            ]);

            $lastSort = Media::where('ref_table', 'persil')
                            ->where('ref_id', $id)
                            ->max('sort_order') ?? -1;

            foreach ($request->file('media_files') as $index => $file) {
                $path = $file->store('uploads/persil', 'public');
                $fileName = basename($path);

                Media::create([
                    'ref_table' => 'persil',
                    'ref_id' => $id,
                    'file_name' => $fileName,
                    'caption' => $request->media_captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order' => ++$lastSort,
                ]);
            }
        }

        return redirect()->route('persil.index')
            ->with('success', 'Data persil berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
       {
        // Hapus semua media terlebih dahulu
        $mediaFiles = Media::where('ref_table', 'persil')
                          ->where('ref_id', $id)
                          ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/persil/' . $media->file_name);
            $media->delete();
        }

        // Hapus persil
        $persil = Persil::findOrFail($id);
        $persil->delete();

        return redirect()->route('persil.index')->with('success', 'Data persil berhasil dihapus');
    }

    /**
     * Hapus file media (AJAX)
     */
    public function deleteMedia(string $id)
    {
        $media = Media::findOrFail($id);

        // Pastikan media ini milik persil
        if ($media->ref_table === 'persil') {
            // Hapus file dari storage
            Storage::disk('public')->delete('uploads/persil/' . $media->file_name);

            // Hapus dari database
            $media->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }
}
