<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Models\SengketaPersil;
use Illuminate\Support\Facades\Storage;
class SengketaPersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $data['filter'] = SengketaPersil::select('status')->distinct()->get();

            $filterableColumns = ['status'];
            $searchableColumns = ['pihak_1', 'pihak_2', 'kronologi'];

            $data['sengketa_persil'] = SengketaPersil::with('persil.warga')
                ->filter($request, $filterableColumns, $searchableColumns)
                ->search($request, $searchableColumns)
                ->paginate(10)
                ->withQueryString();

            return view('pages.admin.sengketa_persil.tabel-sengketa', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
         return view('pages.admin.sengketa_persil.form-sengketa');
        // $persil_id = $request->persil_id;

        // $persil = Persil::with('warga')
        //     ->findOrFail($persil_id);

        // return view('pages.admin.sengketa_persil.form-sengketa', [
        //     'persil' => $persil
        // ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'persil_id'   => 'required|exists:persil,persil_id',
            'pihak_1'     => 'required|string|max:255',
            'pihak_2'     => 'required|string|max:255',
            'status'      => 'required|string|max:50',
            'kronologi'   => 'required|string',
            'penyelesaian'=> 'nullable|string',
        ]);

        $sengketa = SengketaPersil::create($data);
        // ===== SIMPAN MEDIA =====
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $index => $file) {
                $path = $file->store('uploads/sengketa', 'public');

                Media::create([
                    'ref_table' => 'sengketa_persil',
                    'ref_id'    => $sengketa->sengketa_id,
                    'file_name' => basename($path),
                    'caption'   => $request->media_captions[$index] ?? null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order'=> $index,
                ]);
            }
        }

        return redirect()
            ->route('sengketa_persil.index')
            ->with('success', 'Data sengketa berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sengketa = SengketaPersil::with('persil.warga')
            ->findOrFail($id);

        $media = Media::where('ref_table', 'sengketa_persil')
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

        return view(
            'pages.admin.sengketa_persil.show-sengketa',
            compact('sengketa', 'media', 'images', 'documents', 'others')
        );
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sengketa = SengketaPersil::with('persil.warga')
            ->findOrFail($id);

        $media = Media::where('ref_table', 'sengketa_persil')
            ->where('ref_id', $id)
            ->orderBy('sort_order')
            ->get();

        return view(
            'pages.admin.sengketa_persil.edit-sengketa',
            compact('sengketa', 'media')
        );
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sengketa = SengketaPersil::findOrFail($id);

        $data = $request->validate([
            'pihak_1'      => 'required|string|max:150',
            'pihak_2'      => 'required|string|max:150',
            'kronologi'    => 'required|string',
            'status'       => 'required|string|max:50',
            'penyelesaian' => 'nullable|string',
        ]);

        $sengketa->update($data);

        // Media baru
        if ($request->hasFile('media_files')) {
            $request->validate([
                'media_files.*'    => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
                'media_captions.*' => 'nullable|string|max:255',
            ]);

            $lastSort = Media::where('ref_table', 'sengketa_persil')
                ->where('ref_id', $id)
                ->max('sort_order') ?? -1;

            foreach ($request->file('media_files') as $file) {
                $path = $file->store('uploads/sengketa_persil', 'public');

                Media::create([
                    'ref_table' => 'sengketa_persil',
                    'ref_id'    => $id,
                    'file_name' => basename($path),
                    'caption'   => null,
                    'mime_type' => $file->getMimeType(),
                    'sort_order'=> ++$lastSort,
                ]);
            }
        }

        return redirect()
            ->route('sengketa_persil.index')
            ->with('success', 'Data sengketa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mediaFiles = Media::where('ref_table', 'sengketa_persil')
            ->where('ref_id', $id)
            ->get();

        foreach ($mediaFiles as $media) {
            Storage::disk('public')
                ->delete('uploads/sengketa_persil/' . $media->file_name);
            $media->delete();
        }

        $sengketa = SengketaPersil::findOrFail($id);
        $sengketa->delete();

        return redirect()
            ->route('sengketa_persil.index')
            ->with('success', 'Data sengketa berhasil dihapus');
    }

    public function deleteMedia(string $id)
    {
        $media = Media::findOrFail($id);

        if ($media->ref_table === 'sengketa_persil') {
            Storage::disk('public')
                ->delete('uploads/sengketa_persil/' . $media->file_name);

            $media->delete();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 403);
    }

}
