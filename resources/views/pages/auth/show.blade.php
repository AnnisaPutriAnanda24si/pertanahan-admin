@extends('layouts.admin.app')

@section('content')
    <div class="page-inner">
        <div class="row">
            {{-- BAGIAN KIRI: FOTO DAN RINGKASAN --}}
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-body text-center pt-4">
                        <div class="mb-3">
                            @if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture))
                                <img src="{{ Storage::url($user->profile_picture) }}" class="rounded-circle border"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150"
                                    class="rounded-circle border">
                            @endif
                        </div>
                        <h4 class="fw-bold mb-0">{{ $user->name }}</h4>
                        <p class="text-muted">{{ strtoupper($user->role) }}</p>
                        <hr>

                        {{-- FORM UPLOAD FOTO STANDAR --}}
                        <form action="{{ route('user.update.photo', $user->id) }}" method="POST"
                            enctype="multipart/form-data" class="text-start">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-2">
                                <label class="small fw-bold">Ganti Foto Profil</label>
                                <input type="file" name="profile_picture" class="form-control form-control-sm" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        </form>

                        @if ($user->profile_picture)
                            <form action="{{ route('user.delete.photo', $user->id) }}" method="POST"
                                onsubmit="return confirm('Hapus foto profil?')" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                    <i class="fa fa-trash"></i> Hapus Foto
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- BAGIAN KANAN: DETAIL INFORMASI --}}
            <div class="col-md-8">
                {{-- INFORMASI AKUN --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Informasi Profil</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th width="30%">Nama Lengkap</th>
                                        <td>: {{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>: {{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Role / Hak Akses</th>
                                        <td>: <span class="badge bg-info text-white">{{ $user->role }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Terdaftar Sejak</th>
                                        <td>: {{ $user->created_at->format('d F Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- FORM KEAMANAN / GANTI PASSWORD --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Keamanan</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Kosongkan jika tidak diganti">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Ulangi password baru">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-save"></i> Perbarui Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
