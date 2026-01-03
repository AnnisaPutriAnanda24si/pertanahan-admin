<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
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

    public function create()
    {
        return view('pages.admin.user.form-user');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|unique:users,email',
                'role' => 'required',
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required'
            ]);

            $data['password'] = Hash::make($data['password']);
            User::create($data);

        return redirect()->route('user.index')->with('success','Penambahan Data Berhasil!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.user.show-user', compact('user'));
    }

    public function edit(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('pages.admin.user.edit-user', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $user->id,
                'role' => 'required|string',
                'password' => 'nullable|string|min:8',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);

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
                $path = $request->file('profile_picture')->store('uploads/profile_pictures', 'public');
                $user->profile_picture = $path;
            }

            $user->save();

            return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }

    public function updatePhoto(Request $request, $id)
    {
        $request->validate(['profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048']);
        $user = User::findOrFail($id);
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $path = $request->file('profile_picture')->store('uploads/profile_pictures', 'public');

        $user->update([
            'profile_picture' => $path
        ]);

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }
    public function deletePhoto($id)
    {
        $user = User::findOrFail($id);
        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->update(['profile_picture' => null]);
        }

        return back()->with('success', 'Foto profil berhasil dihapus');
    }
}
