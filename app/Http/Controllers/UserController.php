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

    public function index(Request $request)
    {

        $query = User::query();
        if ($request->verified == 'verified') {
            $query->whereNotNull('email_verified_at');
        }
        if ($request->verified == 'unverified') {
            $query->whereNull('email_verified_at');
        }

        $filterableColumns = ['role'];
        $searchableColumns = ['name', 'email'];
        $data['user'] = $query
                ->filter($request, $filterableColumns, $searchableColumns)
                ->search($request, $searchableColumns)
                ->paginate(10)
                ->withQueryString();
        return view('pages.admin.user.tabel-user', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.user.form-user');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|string|unique:users,email',
        'role' => 'required',
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
    return view('pages.admin.user.edit-user', $data);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    // Debug: Cek apa yang terjadi
    \Log::info('=== UPDATE USER DEBUG ===');
    \Log::info('Request Data:', $request->all());
    \Log::info('User ID: ' . $id);

    try {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'password' => 'nullable|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        \Log::info('Validated Data:', $validated);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        \Log::info('User updated successfully');

        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');

    } catch (\Exception $e) {
        \Log::error('Update Error: ' . $e->getMessage());
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
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
