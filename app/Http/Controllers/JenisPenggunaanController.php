<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPenggunaan;

class JenisPenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['filter'] = JenisPenggunaan::select('nama_penggunaan')->distinct()->get();
        $filterableColumns = ['nama_penggunaan'];
        $searchableColumns = ['nama_penggunaan', 'keterangan'];
        $data['jenis_penggunaan'] = JenisPenggunaan::filter($request, $filterableColumns, $searchableColumns)
                    ->search($request, $searchableColumns)
					->paginate(10)
					->withQueryString();
        return view('pages.admin.jenis_penggunaan.tabel-jenis', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.jenis_penggunaan.form-jenis');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_penggunaan' => 'required|string|max:100|unique:jenis_penggunaan,nama_penggunaan',
            'keterangan' => 'nullable|string',
        ]);

        JenisPenggunaan::create($data);

        return redirect()->route('jenis_penggunaan.index')->with('success','Penambahan Data Berhasil!');
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
    $data['jenis_penggunaan'] = JenisPenggunaan::findOrFail($id);
    return view('pages.admin.jenis_penggunaan.edit-jenis', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis = JenisPenggunaan::findOrFail($id);

        $data = $request->validate([
            'nama_penggunaan' => ['required','string','max:255','unique:jenis_penggunaan,nama_penggunaan,' . $id . ',' . 'jenis_id'],
            'keterangan' => 'nullable|string',
        ]);
        // $jenis->nama_penggunaan = $request->nama_penggunaan;
        // $jenis->keterangan = $request->keterangan;
        $jenis->fill($data);
        $jenis->save();

        return redirect()->route('jenis_penggunaan.index')->with('success', 'Perubahan Data Jenis Penggunaan Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JenisPenggunaan::findOrFail($id);
        $data->delete();
        return redirect()->route('jenis_penggunaan.index')->with('success', 'Data berhasil dihapus');
    }
}
