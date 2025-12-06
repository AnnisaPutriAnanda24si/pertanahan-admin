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
                        <h4 class="mb-0">Data Persil</h4>
                        <a href="{{ route('warga.index') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                    <form method="GET" action="{{ route('persil.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="penggunaan" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach ($filter as $item)
                                        <option value='{{ $item->penggunaan }}'
                                            {{ request('penggunaan') == $item->penggunaan ? 'selected' : '' }}>
                                            {{ $item->penggunaan }}
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
                        </div>
                    </form>
                    {{-- <table id="datatable-admin" class="display table table-striped table-hover"> --}}
                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Media</th>
                                <th>Kode Persil / Nama Pemilik</th>
                                <th>Luas (m²)</th>
                                <th>Penggunaan</th>
                                <th>Lokasi (RT/RW)</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($persil as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('persil.show', $item->persil_id) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->kode_persil }}</div>
                                            <div class="status">
                                                {{ $item->warga->nama ?? 'Tidak ada pemilik' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->luas_m2 }} m²</td>
                                    <td>{{ $item->penggunaan }}</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->alamat_lahan }}</div>
                                            <div class="status">RT {{ $item->rt }}/RW {{ $item->rw }}</div>
                                        </div>
                                    </td>


                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('persil.edit', $item->persil_id) }}"
                                                class="btn btn-link btn-primary btn-lg" title="Edit Data">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('persil.destroy', $item->persil_id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->kode_persil }}?');"
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
                        {{ $persil->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
