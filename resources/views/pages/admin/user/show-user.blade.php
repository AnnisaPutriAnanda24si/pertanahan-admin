@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">

                {{-- ALERT --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- HEADER --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">Profil Pengguna</h4>
                        <small class="text-muted">
                            Nama: <strong>{{ $user->name }}</strong> | Role: <strong>{{ $user->role }}</strong>
                        </small>
                    </div>

                    <a href="{{ route('user.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>

                {{-- CARD PROFILE --}}
                <div class="row">

                    {{-- FOTO PROFIL --}}
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">

                                <h5 class="mb-3">Foto Profil</h5>

                                @if ($user->profile_picture && Storage::exists('public/' . $user->profile_picture))
                                        <img src="{{ Storage::url($user->profile_picture) }}" class="rounded"
                                            style="width:140px; height:140px; object-fit:cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=140"
                                        class="rounded">
                                @endif

                                <p class="text-muted mt-2 small">
                                    Format: jpg, png, jpeg
                                </p>

                                {{-- UPLOAD FOTO --}}
                                <form action="{{ route('user.update.photo', $user->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <input type="file" name="profile_picture" class="form-control mb-2" required>

                                    <button class="btn btn-primary w-100">
                                        <i class="fa fa-upload"></i> Upload / Ganti Foto
                                    </button>
                                </form>

                                {{-- HAPUS FOTO --}}
                                @if ($user->profile_picture)
                                    <form action="{{ route('user.delete.photo', $user->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus foto profil?')" class="mt-2">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger w-100">
                                            <i class="fa fa-trash"></i> Hapus Foto
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </div>
                    </div>

                    {{-- DATA USER --}}
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">

                                <h5 class="mb-3">Informasi Pengguna</h5>

                                <table class="table table-bordered">
                                    <tr>
                                        <th width="180">Nama</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $user->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Role</th>
                                        <td>
                                            <span class="badge bg-primary">{{ $user->role }}</span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Tanggal Dibuat</th>
                                        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
