@extends('layouts.admin.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Detail Dokumen Persil</h4>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- HEADER INFO & AKSI --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-0">{{ $dokumen->nomor }}</h3>
                    <p class="text-muted mb-0">Detail berkas hukum dan lampiran media persil</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('media.create', ['ref_table' => 'dokumen_persil', 'ref_id' => $dokumen->dokumen_id]) }}"
                        class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah File
                    </a>
                    <a href="{{ route('dokumen_persil.edit', $dokumen->dokumen_id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edit Data
                    </a>
                </div>
            </div>

            {{-- GRID INFORMASI DOKUMEN --}}
            <div class="card mb-4 border">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Nomor Dokumen</label>
                            <h6 class="fw-bold text-primary">{{ $dokumen->nomor }}</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Jenis Dokumen</label>
                            <h6 class="fw-bold">{{ $dokumen->jenis_dokumen }}</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Kode Persil</label>
                            <h6 class="fw-bold">{{ $dokumen->persil->kode_persil ?? '-' }}</h6>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Pemilik Persil</label>
                            <h6 class="fw-bold">{{ $dokumen->persil->warga->nama ?? '-' }}</h6>
                        </div>
                        <div class="col-md-8">
                            <label class="text-muted mb-1">Keterangan / Catatan</label>
                            <h6 class="fw-bold small">{{ $dokumen->keterangan ?: 'Tidak ada keterangan tambahan.' }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            {{-- STATISTIK MEDIA --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-primary">{{ $media->count() }}</h3>
                            <small class="text-muted fw-bold">TOTAL FILE</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-success">
                                {{ $media->filter(fn($m) => str_contains($m->mime_type, 'image'))->count() }}
                            </h3>
                            <small class="text-muted fw-bold">GAMBAR</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-danger">
                                {{ $media->filter(fn($m) => str_contains($m->mime_type, 'pdf'))->count() }}
                            </h3>
                            <small class="text-muted fw-bold">DOKUMEN PDF</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-secondary">
                                {{ $media->filter(fn($m) => !str_contains($m->mime_type, 'image') && !str_contains($m->mime_type, 'pdf'))->count() }}
                            </h3>
                            <small class="text-muted fw-bold">LAINNYA</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL MEDIA --}}
            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0"><i class="fas fa-paperclip me-2"></i>Lampiran File Dokumen</h4>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Nama File</th>
                            <th>Tipe Konten</th>
                            <th>Keterangan</th>
                            <th>Diunggah Pada</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($media as $item)
                            <tr>
                                <td>
                                    <i
                                        class="fas fa-file me-2
                                        @if (str_contains($item->mime_type, 'image')) text-success
                                        @elseif(str_contains($item->mime_type, 'pdf')) text-danger
                                        @else text-primary @endif"></i>
                                    <strong>{{ $item->file_name }}</strong>
                                </td>
                                <td>
                                    @if (str_contains($item->mime_type, 'image'))
                                        <span class="badge bg-success">Gambar</span>
                                    @elseif(str_contains($item->mime_type, 'pdf'))
                                        <span class="badge bg-danger">PDF</span>
                                    @else
                                        <span class="badge bg-secondary">File</span>
                                    @endif
                                </td>
                                <td>{{ $item->caption ?: '-' }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ $item->url }}" target="_blank" class="btn btn-link btn-primary"
                                            title="Lihat">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                            class="btn btn-link btn-success" title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <button type="button" class="btn btn-link btn-danger delete-file-btn"
                                            data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}"
                                            title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                    Belum ada file media untuk dokumen ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-muted small mt-2">
                <i class="fas fa-info-circle me-1"></i> Menampilkan {{ $media->count() }} berkas lampiran.
            </div>

        </div>
    </div>

    @include('layouts.admin.js-show')
@endsection
