<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PetaPersil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PetaPersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['panjang_m','lebar_m'];
        $peta_persil = PetaPersil::with('persil.warga')
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.peta_persil.tabel-peta', compact('peta_persil'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('pages.admin.peta_persil.form-peta');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'persil_id' => 'required|exists:persil,persil_id',
            'geojson'   => 'required|string',
            'panjang_m' => 'nullable|numeric',
            'lebar_m'   => 'nullable|numeric',
        ]);
        $peta = PetaPersil::create($data);
        if ($request->hasFile('media_files')) {
            $request->validate([ 'media_files.*' => 'file|mimes:geojson,json,jpg,jpeg,png,pdf|max:5120',
                                 'media_captions.*' => 'nullable|string|max:255',
            ]);
            foreach ($request->file('media_files') as $i => $file) {
                $path = $file->store('uploads/peta_persil', 'public');

                Media::create([
                    'ref_table' => 'peta_persil',
                    'ref_id'    => $peta->peta_id,
                    'file_name' => basename($path),
                    'caption'   => $request->media_captions[$i] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order'=> $i,
                ]);
            }
        }
        return redirect()->route('peta_persil.index')->with('success', 'Data peta persil berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $peta = PetaPersil::with('persil.warga')->findOrFail($id);

        $media = Media::where('ref_table', 'peta_persil')
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

        return view('pages.admin.peta_persil.show-peta', compact('peta', 'media', 'images', 'documents', 'others'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $peta = PetaPersil::findOrFail($id);
        $media = Media::where('ref_table', 'peta_persil')->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();
        return view('pages.admin.peta_persil.edit-peta', compact('peta', 'media'));
    }
    public function update(Request $request, $id)
    {
        $peta = PetaPersil::findOrFail($id);
        $data = $request->validate(['geojson'   => 'required|string',
                                    'panjang_m' => 'nullable|numeric',
                                    'lebar_m'   => 'nullable|numeric']);
        $peta->update($data);
        if ($request->hasFile('media_files')) {
            $lastSort = Media::where('ref_table', 'peta_persil')
                ->where('ref_id', $id)
                ->max('sort_order') ?? -1;
            foreach ($request->file('media_files') as $i => $file) {
                $path = $file->store('uploads/peta_persil', 'public');
                Media::create([
                    'ref_table' => 'peta_persil',
                    'ref_id'    => $id,
                    'file_name' => basename($path),
                    'caption'   => $request->media_captions[$i] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order'=> ++$lastSort,
                ]);
            }}
        return redirect()->route('peta_persil.index')
            ->with('success', 'Data peta persil berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mediaFiles = Media::where('ref_table', 'peta_persil')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')->delete('uploads/peta_persil/' . $media->file_name);
            $media->delete();
        }

        PetaPersil::findOrFail($id)->delete();

        return redirect()->route('peta_persil.index')
            ->with('success', 'Data peta persil berhasil dihapus');
    }
}
