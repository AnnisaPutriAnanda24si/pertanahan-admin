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
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Data Warga</h4>
                        <a href="{{ route('warga.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Tambah Data
                        </a>
                    </div>
                    <table id="datatable-admin" class="display table table-striped table-hover">
                        <thead>
                            <tr>
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
                </div>
            </div>
        </div>
    </div>
    {{-- End warga table --}}
    {{-- End Main Content --}}
@endsection
