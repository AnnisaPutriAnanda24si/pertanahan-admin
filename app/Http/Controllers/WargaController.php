<?php

namespace App\Http\Controllers;
use App\Models\Warga;

use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['filter'] = Warga::select('jenis_kelamin')->distinct()->get();
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'email', 'telp'];
        $data['warga'] = Warga::filter($request, $filterableColumns, $searchableColumns)
                    ->search($request, $searchableColumns)
					->paginate(10)
					->withQueryString();
        return view('pages.admin.warga.tabel-warga', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.warga.form-warga');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'no_ktp' => 'required|string|unique:warga,no_ktp',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:255',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255|unique:warga,email',
        ]);

        Warga::create($data);

        return redirect()->route('warga.index')->with('success','Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            $warga = Warga::with([
            'persil',
            'persil.dokumen_persil',
            'persil.sengketa_persil',
            'persil.peta_persil'
        ])->findOrFail($id);

        return view('pages.admin.warga.show-warga', compact('warga'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $data['warga'] = Warga::findOrFail($id);
    return view('pages.admin.warga.edit-warga', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $data = $request->validate([
            'no_ktp' => ['required','string','unique:warga,no_ktp,' . $id . ',' . 'warga_id'],
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:255',
            'telp' => 'required|string|max:15',
            'email' => ['required','email','max:255','unique:warga,email,' . $id . ',' . 'warga_id'],
        ]);

        $warga->fill($data);
        $warga->save();

        return redirect()->route('warga.index')->with('success', 'Perubahan Data Warga Berhasil!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Warga::findOrFail($id);
        $data->delete();
        return redirect()->route('warga.index')->with('success', 'Data berhasil dihapus');
    }

    public function search(Request $request) {
    return Warga::query()
        ->search($request, ['nama', 'nik', 'telp']) // Sebutkan kolom yang mau dicari
        ->limit(10)
        ->get();
}
}
