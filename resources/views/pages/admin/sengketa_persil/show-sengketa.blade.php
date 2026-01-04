@extends('layouts.admin.app')

@section('content')
    <div class="card shadow-sm border-0">
        {{-- Header Utama --}}
        <div class="card-header d-flex justify-content-between align-items-center bg-white py-3 border-bottom">
            <div>
                <h4 class="card-title mb-0 fw-bold text-primary">
                    <i class="fas fa-map-marked-alt me-2"></i>Detail Sengketa Persil
                </h4>
                <div class="mt-1">
                    <span class="badge bg-primary text-white">Kode: {{ $sengketa->persil->kode_persil ?? '-' }}</span>
                    <span class="ms-2 text-muted small">
                        <i class="fas fa-user me-1"></i> Pemilik:
                        <strong>{{ $sengketa->persil->warga->nama ?? '-' }}</strong>
                    </span>
                </div>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                <i class="fa fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-start border-success border-4 shadow-sm mb-4"
                    role="alert">
                    <i class="fas fa-check-circle me-2 text-success"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                {{-- Bagian Kiri: Informasi Pihak & Konten --}}
                <div class="col-lg-8 border-end">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="p-3 rounded border-start border-primary border-4 bg-light">
                                <label class="text-uppercase text-primary fw-bold small mb-1 d-block">Pihak Pertama</label>
                                <h5 class="fw-bold mb-0 text-dark">{{ $sengketa->pihak_1 ?? '-' }}</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 rounded border-start border-primary border-4 bg-light">
                                <label class="text-uppercase text-primary fw-bold small mb-1 d-block">Pihak Kedua</label>
                                <h5 class="fw-bold mb-0 text-dark">{{ $sengketa->pihak_2 ?? '-' }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-uppercase text-muted fw-bold small mb-2">
                            <i class="fas fa-history me-1 text-primary"></i> Kronologi Sengketa
                        </label>
                        <div class="p-3 rounded border-start border-primary border-4 bg-light text-dark">
                            {{ $sengketa->kronologi ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="text-uppercase text-muted fw-bold small mb-2">
                            <i class="fas fa-check-double me-1 text-success"></i> Hasil Penyelesaian
                        </label>
                        <div class="p-3 rounded border-start border-success border-4 bg-light text-dark">
                            {{ $sengketa->penyelesaian ?? 'Belum ada data penyelesaian.' }}
                        </div>
                    </div>
                </div>

                {{-- Bagian Kanan: Status Card --}}
                <div class="col-lg-4">
                    @php
                        $status = strtolower($sengketa->status);
                        $bgStatus = match ($status) {
                            'proses' => 'bg-warning',
                            'selesai' => 'bg-success',
                            'dibatalkan' => 'bg-danger',
                            default => 'bg-secondary',
                        };
                    @endphp

                    <div class="card border-0 shadow-none mb-3 {{ $bgStatus }} text-white">
                        <div class="card-body text-center py-4">
                            <h6 class="text-uppercase fw-bold mb-3 opacity-75">Status Sengketa</h6>
                            <div
                                class="py-2 px-4 rounded-pill border border-white border-2 d-inline-block fw-bold shadow-sm">
                                {{ strtoupper($status ?? 'TIDAK DIKETAHUI') }}
                            </div>

                            <div class="mt-4 pt-3 border-top border-white border-opacity-25 text-start">
                                <div class="d-flex justify-content-between small mb-2">
                                    <span class="opacity-75"><i class="far fa-calendar-alt me-1"></i> Dibuat:</span>
                                    <span class="fw-bold">{{ $sengketa->created_at?->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="d-flex justify-content-between small">
                                    <span class="opacity-75"><i class="fas fa-sync-alt me-1"></i> Update:</span>
                                    <span class="fw-bold">{{ $sengketa->updated_at?->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('sengketa_persil.edit', $sengketa->sengketa_id) }}"
                            class="btn btn-success fw-bold py-2 shadow-sm">
                            <i class="fa fa-edit me-2"></i> Edit Detail Sengketa
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-5 opacity-25">

            {{-- Bagian Media: Statistik --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="fas fa-images me-2 text-success"></i>File Media Sengketa
                </h5>
                <a href="{{ route('sengketa_persil.edit', $sengketa->sengketa_id) }}"
                    class="btn btn-primary btn-round btn-sm">
                    <i class="fa fa-upload me-1"></i> Upload File
                </a>
            </div>

            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-none">
                        <div class="card-body text-center">
                            <h3 class="mb-0 fw-bold">{{ $media->count() }}</h3>
                            <small class="text-muted text-uppercase fw-bold">Total File</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-none">
                        <div class="card-body text-center border-bottom border-success border-4 rounded-bottom">
                            <h3 class="mb-0 text-success fw-bold">{{ $images->count() }}</h3>
                            <small class="text-muted text-uppercase fw-bold">Gambar</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-none">
                        <div class="card-body text-center border-bottom border-primary border-4 rounded-bottom">
                            <h3 class="mb-0 text-primary fw-bold">{{ $documents->count() }}</h3>
                            <small class="text-muted text-uppercase fw-bold">Dokumen</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-none">
                        <div class="card-body text-center border-bottom border-secondary border-4 rounded-bottom">
                            <h3 class="mb-0 text-secondary fw-bold">{{ $others->count() }}</h3>
                            <small class="text-muted text-uppercase fw-bold">Lainnya</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bagian Media: Tabel --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="fw-bold">FILE</th>
                            <th class="fw-bold">TIPE</th>
                            <th class="fw-bold">KETERANGAN</th>
                            <th class="fw-bold">TANGGAL UPLOAD</th>
                            <th class="text-center fw-bold">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($media as $item)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <i
                                            class="fas fa-file-alt fa-lg me-3
                                            @if (str_contains($item->mime_type, 'image')) text-success
                                            @elseif(str_contains($item->mime_type, 'pdf')) text-danger
                                            @elseif(str_contains($item->mime_type, 'word')) text-primary
                                            @else text-secondary @endif">
                                        </i>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $item->file_name }}</div>
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
                                    <div class="fw-bold">{{ $item->created_at->format('d-m-Y') }}</div>
                                    <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ $item->url }}" target="_blank" class="btn" title="Lihat">
                                            <i class="fa fa-eye text-primary"></i>
                                        </a>
                                        <a href="{{ $item->url }}" download="{{ $item->file_name }}" class="btn"
                                            title="Download">
                                            <i class="fa fa-download text-success"></i>
                                        </a>
                                        <button type="button" class="btn delete-file-btn"
                                            data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}">
                                            <i class="fa fa-trash text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i><br>
                                    Belum ada file untuk sengketa ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('layouts.admin.js-show')
@endsection
