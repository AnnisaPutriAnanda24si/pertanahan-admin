<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    //menggunakan data dari tabel persil
    $persil = [
        'kode_persil' => 'PRS-001',
        'pemilik' => 'Nurtanio', //tidak menggunakan pemilik_warga_id
        'luas_m2' => 250,
        'penggunaan' => 'Perumahan',
        'alamat_lahan' => 'Jl. Melati No.10',
        'rt' => '02',
        'rw' => '05'
    ];
    return view('home', $persil);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // komen kedua
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
    public function destroy(string $id)
    {
        //
    }
}
