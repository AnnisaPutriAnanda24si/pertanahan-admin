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
                    {{-- ID tabel menggunakan datatable-warga --}}
                    <table **id="datatable-admin"** class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                        {{-- !!! WAJIB: FOOTER UNTUK MULTI-FILTER !!! --}}
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Nama Penggunaan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        {{-- AKHIR <tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Tabel --}}
    {{-- End Main Content --}}
@endsection
