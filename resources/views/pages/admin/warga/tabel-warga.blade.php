@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    {{-- Warga table --}}
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

                <div class="table-responsive">

                    <form method="GET" action="{{ route('warga.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">

                                <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @foreach ($filter as $item)
                                        <option value='{{ $item->jenis_kelamin }}'
                                            {{ request('jenis_kelamin') == $item->jenis_kelamin ? 'selected' : '' }}>
                                            {{ $item->jenis_kelamin }}
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
                                    <a href="{{ route('warga.create') }}" class="btn btn-primary">
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
                                <th>Nama</th>
                                <th>Pekerjaan / Agama</th>
                                <th>Jenis Kelamin</th>
                                <th>Telp</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warga as $item)
                                <tr>
                                    <td>
                                        <a href="{{ route('warga.show', $item->warga_id) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        {{-- Menggunakan struktur layout seperti tabel Add Row --}}
                                        <div class="user-info">
                                            <div class="username">{{ $item->nama }}</div>
                                            <div class="status">{{ $item->email }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->pekerjaan }}</div>
                                            <div class="status">{{ $item->agama }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->jenis_kelamin == 'Male')
                                            <div class="badge bg-primary">Laki-laki</div>
                                        @elseif ($item->jenis_kelamin == 'Female')
                                            <div class="badge bg-danger">Perempuan</div>
                                        @else
                                            <div class="badge bg-warning">Other</div>
                                        @endif

                                    </td>
                                    <td>{{ $item->telp }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('persil.create', ['warga_id' => $item->warga_id]) }}"
                                                data-bs-toggle="tooltip" title="Tambah Data Persil"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-plus-square"></i>
                                            </a>

                                            <a href="{{ route('warga.edit', $item->warga_id) }}" data-bs-toggle="tooltip"
                                                title="Edit Data" class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-edit"></i>
                                            </a>


                                            <form action="{{ route('warga.destroy', $item->warga_id) }}"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $item->nama }}?');"
                                                method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-bs-toggle="tooltip" title="Hapus Data"
                                                    class="btn btn-link btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $warga->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End warga table --}}
    {{-- End Main Content --}}
@endsection
