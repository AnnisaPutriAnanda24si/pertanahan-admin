@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    {{-- Tabel --}}
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                {{-- AKHIR BLOK PESAN SUKSES --}}

                <div class="table-responsive">
                    <form method="GET" action="{{ route('jenis_penggunaan.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="nama_penggunaan" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach ($filter as $item)
                                        <option value='{{ $item->nama_penggunaan }}'
                                            {{ request('nama_penggunaan') == $item->nama_penggunaan ? 'selected' : '' }}>
                                            {{ $item->nama_penggunaan }}
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
                                    <a href="{{ route('jenis_penggunaan.create') }}" class="btn btn-primary">
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
                                <th>NO</th>
                                <th>Nama Penggunaan</th>
                                <th>Keterangan</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenis_penggunaan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->nama_penggunaan }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('jenis_penggunaan.edit', $item->jenis_id) }}"
                                                data-bs-toggle="tooltip" title="Edit Data"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('jenis_penggunaan.destroy', $item->jenis_id) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data Jenis {{ $item->nama_penggunaan }}?');"
                                                method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-bs-toggle="tooltip" title="Hapus Data"
                                                    class="btn btn-link btn-danger">
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
                        {{ $jenis_penggunaan->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- Tabel --}}
    {{-- End Main Content --}}
@endsection
