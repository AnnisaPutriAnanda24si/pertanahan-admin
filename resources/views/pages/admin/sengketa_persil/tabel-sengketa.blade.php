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

                    <form method="GET" action="{{ route('persil.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach ($filter as $item)
                                        <option value="{{ $item->status }}"
                                            {{ request('status') == $item->status ? 'selected' : '' }}>
                                            {{ $item->status }}
                                        </option>
                                    @endforeach
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
                                    <a href="{{ route('sengketa_persil.create') }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Media</th>
                                <th>Persil</th>
                                <th>Pihak Sengketa</th>
                                <th>Status</th>
                                <th>Kronologi</th>
                                <th>Penyelesaian</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($sengketa_persil as $item)
                                <tr>
                                    {{-- MEDIA --}}
                                    <td class="text-center">
                                        <a href="{{ route('sengketa_persil.show', $item->sengketa_id) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>

                                    {{-- DATA PERSIL --}}
                                    <td>
                                        <div class="user-info">
                                            <div class="username">
                                                {{ $item->persil->kode_persil ?? '-' }}
                                            </div>
                                            <div class="status">
                                                {{ $item->persil->warga->nama ?? 'Pemilik tidak diketahui' }}
                                            </div>
                                        </div>
                                    </td>

                                    {{-- PIHAK --}}
                                    <td>
                                        <strong>Pihak 1:</strong> {{ $item->pihak_1 }} <br>
                                        <strong>Pihak 2:</strong> {{ $item->pihak_2 }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        <span class="badge bg-info">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>

                                    {{-- KRONOLOGI --}}
                                    <td>
                                        {{ Str::limit($item->kronologi, 80) }}
                                    </td>

                                    {{-- PENYELESAIAN --}}
                                    <td>
                                        {{ $item->penyelesaian ?? '-' }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('sengketa_persil.edit', $item->sengketa_id) }}"
                                                class="btn btn-link btn-primary btn-lg" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('sengketa_persil.destroy', $item->sengketa_id) }}"
                                                method="POST" style="display:inline"
                                                onsubmit="return confirm('Yakin menghapus data sengketa ini?')">
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
                        {{ $sengketa_persil->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
