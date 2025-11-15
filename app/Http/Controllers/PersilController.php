<?php

namespace App\Http\Controllers;

use App\Models\Persil;
use Illuminate\Http\Request;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['persil'] = Persil::all();
        return view('pages.admin.persil.tabel-persil', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.persil.form-persil');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_persil' => 'required|string|unique:persil,kode_persil',
            'pemilik_warga_id' => 'required|exists:warga,warga_id',
            'luas_m2' => 'required|integer',
            'penggunaan' => 'required|string|max:100',
            'alamat_lahan' => 'required|string|max:200',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
        ]);

        Persil::create($data);

    // return redirect()->route('warga.index')->with('success','Penambahan Data Berhasil!');
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
        $data['persil'] = Persil::findOrFail($id);
        return view('pages.admin.persil.tabel-persil', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $persil = Persil::findOrFail($id);
        $data = $request->validate([
            'kode_persil' => ['required','string','unique:persil,kode_persil' . $id . ',' . ',persil_id'],
            'pemilik_warga_id' => ['required','exists:warga,warga_id'],
            'luas_m2' => 'required|integer',
            'penggunaan' => 'required|string|max:100',
            'alamat_lahan' => 'required|string|max:200',
            'rt' => 'required|max:5',
            'rw' => 'required|max:5',
        ]);

        $persil->fill($data);
        $persil->save();

        // return redirect()->route('warga.index')->with('success', 'Perubahan Data Warga Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Persil::findOrFail($id);
        $data->delete();
        // return redirect()->route('warga.index')->with('success', 'Data berhasil dihapus');
    }
}
