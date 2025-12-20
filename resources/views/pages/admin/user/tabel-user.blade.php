@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">

                    <form method="GET" action="{{ route('user.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="role" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>
                                        Admin</option>
                                    <option value="Super Admin" {{ request('role') == 'Super Admin' ? 'selected' : '' }}>
                                        Super Admin</option>
                                    <option value="Client" {{ request('role') == 'Client' ? 'selected' : '' }}>
                                        Client</option>
                                </select>

                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" id="exampleInputIconRight"
                                        value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                                    <button type="submit" class="input-group-text" id="basic-addon2">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                            class="btn btn-outline-secondary ml-3" id="clear-search"> Clear</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('user.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- <table id="datatable-admin" class="display table table-striped table-hover"> --}}
                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Foto Profil</th>
                                <th>Nama / Email</th>
                                <th>Role</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.show', $item->id) }}">
                                            @if ($item->profile_picture)
                                                {{-- kalau ada foto profil --}}
                                                <img src="{{ asset('storage/' . $item->profile_picture) }}"
                                                    class="avatar-img rounded-circle" alt="Foto"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                            @else
                                                {{-- kalau ga ada foto profil --}}
                                                <img src="{{ asset('assets/img/placeholders/PlaceholderProfile.png') }}"
                                                    class="avatar-img rounded-circle" alt="Foto"
                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->name }}</div>
                                            <div class="status">{{ $item->email }}</div>
                                        </div>
                                    </td>


                                    <td>
                                        @if ($item->role == 'Super Admin')
                                            <span class="badge bg-danger">{{ $item->role }}</span>
                                        @elseif ($item->role == 'Admin')
                                            <span class="badge bg-success">{{ $item->role }}</span>
                                        @elseif ($item->role == 'Client')
                                            <span class="badge bg-primary">{{ $item->role }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $item->role }}</span>
                                            {{-- warna default untuk role lain --}}
                                        @endif
                                    </td>


                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('user.edit', $item->id) }}"
                                                class="btn btn-link btn-primary btn-lg" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $item->name }}?');"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link btn-danger" title="Hapus Data">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $user->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
