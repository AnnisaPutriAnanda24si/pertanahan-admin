@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-0">Data Media Persil</h4>
                    <small class="text-muted">
                        Kode: <strong>{{ $persil->kode_persil }}</strong> |
                        Pemilik: <strong>{{ $persil->warga->nama }}</strong>
                    </small>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-round">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('persil.edit', $persil->persil_id) }}" class="btn btn-primary btn-round">
                        <i class="fa fa-upload"></i> Upload File
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Statistik --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <h3 class="mb-0">{{ $media->count() }}</h3>
                            <small class="text-muted text-uppercase">Total File</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-success">{{ $images->count() }}</h3>
                            <small class="text-muted text-uppercase">Gambar</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-primary">{{ $documents->count() }}</h3>
                            <small class="text-muted text-uppercase">Dokumen</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center">
                            <h3 class="mb-0 text-secondary">{{ $others->count() }}</h3>
                            <small class="text-muted text-uppercase">Lainnya</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th>File</th>
                            <th>Tipe</th>
                            <th>Keterangan</th>
                            <th>Tanggal Upload</th>
                            <th class="text-center" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($media as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i
                                            class="fas fa-file-alt fa-lg me-2
                                            @if (str_contains($item->mime_type, 'image')) text-success
                                            @elseif(str_contains($item->mime_type, 'pdf')) text-danger
                                            @elseif(str_contains($item->mime_type, 'word')) text-primary
                                            @elseif(str_contains($item->mime_type, 'excel')) text-success
                                            @else text-secondary @endif">
                                        </i>
                                        <div>
                                            <div class="fw-bold">{{ $item->file_name }}</div>
                                            <small class="text-muted">{{ $item->mime_type }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if (str_contains($item->mime_type, 'image'))
                                        <span class="badge bg-success">Gambar</span>
                                    @elseif(str_contains($item->mime_type, 'pdf'))
                                        <span class="badge bg-danger">PDF</span>
                                    @elseif(str_contains($item->mime_type, 'word'))
                                        <span class="badge bg-primary">Word</span>
                                    @else
                                        <span class="badge bg-secondary">File</span>
                                    @endif
                                </td>
                                <td>{{ $item->caption ?: '-' }}</td>
                                <td>
                                    <span>{{ $item->created_at->format('d-m-Y') }}</span><br>
                                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ $item->url }}" target="_blank" class="btn btn-link text-primary"
                                            title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                            class="btn btn-link text-success" title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <button type="button" class="btn btn-link text-danger delete-file-btn"
                                            data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}"
                                            title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <span class="text-muted">Belum ada file untuk persil ini</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <small class="text-muted">
                    Menampilkan {{ $media->count() }} file
                </small>
                {{-- {{ $media->links() }} --}}
            </div>
        </div>
    </div>

    @include('layouts.admin.js-show')
@endsection
