<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user'] = User::all();
        return view('admin.user.tabel-user', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.form-user');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required'
    ]);

    $data['password'] = Hash::make($data['password']);

    User::create($data);

    return redirect()->route('user.index')->with('success','Penambahan Data Berhasil!');
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
    $data['user'] = User::findOrFail($id);
    return view('admin.user.edit-user', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $jenis = User::findOrFail($id);

    $data = $request->validate([
        'name' => ['required','string','max:255'],
        'email' => ['required', 'string','unique:users,email,' . $id . ',' . 'id'],
        'password' => 'required'
    ]);

    $data['password'] = Hash::make($data['password']);

    // $jenis->name = $request->name;
    // $jenis->email = $request->email;

    $jenis->fill($data);
    $jenis->save();

    return redirect()->route('user.index')->with('success', 'Perubahan Data User Berhasil!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
