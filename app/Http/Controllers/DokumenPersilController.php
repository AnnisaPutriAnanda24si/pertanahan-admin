<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\DokumenPersil;
use Illuminate\Support\Facades\Storage;

class DokumenPersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['filter'] = DokumenPersil::select('jenis_dokumen')->distinct()->get();
        $filterableColumns = ['jenis_dokumen'];
        $searchableColumns = ['nomor','keterangan'];
        $data['dokumen_persil'] = DokumenPersil::with('persil.warga')
                    ->filter($request, $filterableColumns, $searchableColumns)
                    ->search($request, $searchableColumns)
					->paginate(10)
					->withQueryString();
        return view('pages.admin.dokumen_persil.tabel-dokumen', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         return view('pages.admin.dokumen_persil.form-dokumen');
    }
    public function store(Request $request)
    {
        // Validasi dokumen
        $data = $request->validate([
            'persil_id'      => 'required|exists:persil,persil_id',
            'nomor'          => 'required|string|max:100',
            'jenis_dokumen'  => 'required|string|max:100',
            'keterangan'     => 'nullable|string|max:255',
        ]); //saya minimize agar cukup sekali ss saja
        if ($request->hasFile('media_files')) {
            $request->validate([
                'media_files.*'    => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
                'media_captions.*' => 'nullable|string|max:255',
            ]);
        }
        $dokumen = DokumenPersil::create($data);
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $index => $file) {
                $path = $file->store('uploads/dokumen_persil', 'public');

                Media::create([
                    'ref_table' => 'dokumen_persil',
                    'ref_id'    => $dokumen->dokumen_id,
                    'file_name' => basename($path),
                    'caption'   => $request->media_captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order'=> $index,
                ]);
            }}
        return redirect()->route('dokumen_persil.index')->with('success', 'Dokumen persil berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dokumen = DokumenPersil::with('persil.warga')->findOrFail($id);

        $media = Media::where('ref_table', 'dokumen_persil')->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view(
            'pages.admin.dokumen_persil.show-dokumen',
            compact('dokumen', 'media')
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        $dokumen = DokumenPersil::with('persil.warga')->findOrFail($id);
        $media = Media::where('ref_table', 'dokumen_persil')->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();
        return view('pages.admin.dokumen_persil.edit-dokumen', compact('dokumen', 'media')
        );
    }
    public function update(Request $request, string $id)
    {
        $dokumen = DokumenPersil::findOrFail($id);
        $data = $request->validate([
            'nomor'          => 'required|string|max:100',
            'jenis_dokumen'  => 'required|string|max:100',
            'keterangan'     => 'nullable|string|max:255',
        ]); //saya minimze agar cukup sekali ss
        $dokumen->update($data);
        if ($request->hasFile('media_files')) {
            $request->validate
            ([
                'media_files.*'    => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
                'media_captions.*' => 'nullable|string|max:255',
            ]); //minimize
            $lastSort = Media::where('ref_table', 'dokumen_persil')
                ->where('ref_id', $id)
                ->max('sort_order') ?? -1;
            foreach ($request->file('media_files') as $index => $file) {
                $path = $file->store('uploads/dokumen_persil', 'public');
                Media::create([
                    'ref_table' => 'dokumen_persil',
                    'ref_id'    => $id,
                    'file_name' => basename($path),
                    'caption'   => $request->media_captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order'=> ++$lastSort,
                ]);}} return redirect()->route('dokumen_persil.index')->with('success', 'Dokumen persil berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mediaFiles = Media::where('ref_table', 'dokumen_persil')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')
                ->delete('uploads/dokumen_persil/' . $media->file_name);
            $media->delete();
        }

        $dokumen = DokumenPersil::findOrFail($id);
        $dokumen->delete();

        return redirect()
            ->route('dokumen_persil.index')
            ->with('success', 'Dokumen persil berhasil dihapus');
    }

    public function deleteMedia(string $id)
    {
        $media = Media::findOrFail($id);

        if ($media->ref_table === 'dokumen_persil') {
            Storage::disk('public')
                ->delete('uploads/dokumen_persil/' . $media->file_name);

            $media->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }


}
