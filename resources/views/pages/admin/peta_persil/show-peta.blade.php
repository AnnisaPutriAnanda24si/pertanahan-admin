@extends('layouts.admin.app')

<style>
    #map {
        height: 400px;
        width: 100%;
        border-radius: 6px;
    }
</style>

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Detail Peta Persil</h4>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            {{-- Alert --}}
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
                    <h3 class="fw-bold mb-0">{{ $peta->persil->kode_persil ?? '-' }}</h3>
                    <p class="text-muted mb-0">Informasi lengkap koordinat dan dokumen lahan</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('peta_persil.edit', $peta->peta_id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edit Data
                    </a>
                </div>
            </div>

            {{-- GRID DETAIL PERSIL --}}
            <div class="card mb-4 border">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Kode Persil</label>
                            <h6 class="fw-bold text-primary">{{ $peta->persil->kode_persil ?? '-' }}</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Nama Pemilik</label>
                            <h6 class="fw-bold">{{ $peta->persil->warga->nama ?? '-' }}</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Luas Lahan</label>
                            <h6 class="fw-bold">{{ number_format($peta->persil->luas_m2 ?? 0, 0, ',', '.') }} m²</h6>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Panjang (M)</label>
                            <h6 class="fw-bold">{{ $peta->panjang_m ?? '0' }} m</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Lebar (M)</label>
                            <h6 class="fw-bold">{{ $peta->lebar_m ?? '0' }} m</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="text-muted mb-1">Alamat Lahan</label>
                            <h6 class="fw-bold small">{{ $peta->persil->alamat_lahan ?? '-' }}</h6>
                        </div>
                    </div>

                    <div class="text-muted small mt-2">
                        <i class="fas fa-calendar-alt"></i> Input: {{ $peta->created_at?->format('d/m/Y H:i') }} |
                        <i class="fas fa-sync"></i> Update: {{ $peta->updated_at?->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            {{-- MAP GEOJSON --}}
            <div class="card mb-4 border">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-map-marked-alt me-2"></i>Visualisasi Peta</h5>
                </div>
                <div class="card-body p-2">
                    <div id="map"></div>
                    @if (!$peta->geojson)
                        <div class="text-center text-muted mt-2 small">
                            <i class="fas fa-exclamation-triangle"></i> GeoJSON belum tersedia untuk persil ini.
                        </div>
                    @endif
                </div>
            </div>

            {{-- STATISTIK MEDIA --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-primary">{{ $media->count() }}</h3>
                            <small class="text-muted">Total File</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-success">{{ $images->count() }}</h3>
                            <small class="text-muted">Gambar</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-danger">{{ $documents->count() }}</h3>
                            <small class="text-muted">Dokumen</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-secondary">{{ $others->count() }}</h3>
                            <small class="text-muted">Lainnya</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL MEDIA --}}
            <div class="table-responsive">
                <h4 class="fw-bold mb-3">Lampiran Media Peta</h4>
                <table class="table table-striped table-hover table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Nama File</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Waktu Upload</th>
                            <th style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($media as $item)
                            <tr>
                                <td>
                                    <i
                                        class="fas fa-file me-2
                                        @if (str_contains($item->mime_type, 'image')) text-success
                                        @elseif(str_contains($item->mime_type, 'pdf')) text-danger
                                        @else text-primary @endif"></i>
                                    {{ $item->file_name }}
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
                                        <a href="{{ $item->url }}" target="_blank" class="btn btn-link btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                            class="btn btn-link btn-success">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <button type="button" class="btn btn-link btn-danger delete-file-btn"
                                            data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada file media yang diunggah.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @include('layouts.admin.js-show')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map', {
                scrollWheelZoom: false
            }).setView([-6.2, 106.8], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            @if ($peta->geojson)
                let geo = {!! $peta->geojson !!};
                if (typeof geo === 'string') {
                    try {
                        geo = JSON.parse(geo);
                    } catch (e) {
                        console.error("GeoJSON invalid", e);
                    }
                }
                let layer = L.geoJSON(geo).addTo(map);
                map.fitBounds(layer.getBounds(), {
                    padding: [20, 20]
                });
            @endif

            setTimeout(() => map.invalidateSize(), 500);
        });
    </script>
@endsection
