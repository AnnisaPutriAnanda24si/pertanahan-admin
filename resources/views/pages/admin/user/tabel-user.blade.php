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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Data User</h4>
                        <a href="{{ route('user.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>

                    <table id="datatable-admin" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nama / Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->name }}</div>
                                            <div class="status">{{ $item->email }}</div>
                                        </div>
                                    </td>

                                    <td>{{ $item->role ?? '-' }}</td>

                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
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
                </div>
            </div>
        </div>
    </div>
@endsection
