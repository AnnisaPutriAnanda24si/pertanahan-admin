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
                    <table id="datatable-admin" class="display table table-striped table-hover">
                        <thead>
                            <tr>
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
                </div>
            </div>
        </div>
    </div>
@endsection
