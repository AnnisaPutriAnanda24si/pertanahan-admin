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

                    {{-- SEARCH ONLY --}}
                    <form method="GET" action="{{ route('peta_persil.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari kode persil / ukuran"
                                        aria-label="Search">
                                    <button type="submit" class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </button>

                                    @if (request('search'))
                                        <a href="{{ route('peta_persil.index') }}" class="btn btn-outline-secondary">
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="d-flex justify-content-end mb-3">
                                    <a href="{{ route('peta_persil.create') }}" class="btn btn-primary">
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
                                <th>Ukuran (m)</th>
                                <th>GeoJSON</th>
                                <th style="width:10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($peta_persil as $item)
                                <tr>
                                    {{-- MEDIA --}}
                                    <td class="text-center">
                                        <a href="{{ route('peta_persil.show', $item->peta_id) }}"
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

                                    {{-- UKURAN --}}
                                    <td>
                                        Panjang: {{ $item->panjang_m }} m <br>
                                        Lebar: {{ $item->lebar_m }} m
                                    </td>

                                    {{-- GEOJSON --}}
                                    <td>
                                        {{ Str::limit($item->geojson, 60) }}
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('peta_persil.edit', $item->peta_id) }}"
                                                class="btn btn-link btn-primary btn-lg" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('peta_persil.destroy', $item->peta_id) }}"
                                                method="POST" style="display:inline"
                                                onsubmit="return confirm('Yakin menghapus data peta persil ini?')">
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
                        {{ $peta_persil->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
