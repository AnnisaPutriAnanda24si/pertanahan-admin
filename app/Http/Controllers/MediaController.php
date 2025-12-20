<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['filter'] = Media::select('ref_table')->distinct()->get();

        $filterableColumns = ['ref_table'];

        $searchableColumns = [
            'file_name',
            'caption',
            'mime_type'
        ];

        $data['media'] = Media::query()
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->orderBy('media_id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.admin.media.tabel-media', $data);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $media = Media::findOrFail($id);
        Storage::disk('public')->delete('uploads/' . $media->ref_table . '/' . $media->file_name);
        $media->delete();
        return response()->json(['success' => true]);
    }
}
