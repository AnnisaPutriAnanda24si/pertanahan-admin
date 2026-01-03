@extends('layouts.admin.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Tabel
                </h4>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
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

                        <form method="GET" action="{{ route('dokumen_persil.index') }}" class="mb-3">
                            <div class="row g-2">
                                {{-- Filter Jenis Dokumen --}}
                                <div class="col-md-3">
                                    <select name="jenis_dokumen" class="form-select" onchange="this.form.submit()">
                                        <option value="">Semua Jenis Dokumen</option>
                                        @foreach ($filter as $item)
                                            <option value="{{ $item->jenis_dokumen }}"
                                                {{ request('jenis_dokumen') == $item->jenis_dokumen ? 'selected' : '' }}>
                                                {{ $item->jenis_dokumen }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control"
                                            value="{{ request('search') }}" placeholder="Cari nomor / keterangan">

                                        <button class="btn btn-outline-secondary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>

                                        @if (request('search') || request('jenis_dokumen'))
                                            <a href="{{ route('dokumen_persil.index') }}" class="btn btn-outline-danger">
                                                Clear
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-end mb-3">
                                        <a href="{{ route('dokumen_persil.create') }}" class="btn btn-primary">
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
                                    <th>Detail</th>
                                    <th>Nomor Dokumen</th>
                                    <th>Jenis Dokumen</th>
                                    <th>Keterangan</th>
                                    <th>Persil</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($dokumen_persil as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('dokumen_persil.show', $item->dokumen_id) }}"
                                                class="btn btn-sm btn-secondary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>

                                        <td>{{ $item->nomor }}</td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ $item->jenis_dokumen }}
                                            </span>
                                        </td>

                                        <td>{{ $item->keterangan ?? '-' }}</td>

                                        <td>
                                            @if ($item->persil)
                                                <div class="user-info">
                                                    <div class="username">{{ $item->persil->kode_persil }}</div>
                                                    <div class="status">
                                                        {{ $item->persil->warga->nama ?? 'Tidak ada pemilik' }}
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">Persil tidak tersedia</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="form-button-action">
                                                <a href="{{ route('dokumen_persil.edit', $item->dokumen_id) }}"
                                                    class="btn btn-link btn-primary btn-lg">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form action="{{ route('dokumen_persil.destroy', $item->dokumen_id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Hapus dokumen {{ $item->nomor }}?')"
                                                    style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-link btn-danger">
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
                            {{ $dokumen_persil->links('pagination::bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
