@extends('layouts.admin.app')
<style>
    #map {
        height: 400px;
        width: 100%;
        border-radius: 6px;
    }
</style>

@section('content')
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">

                {{-- Alert --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">Detail Peta Persil</h4>
                        <small class="text-muted">
                            Kode: <strong>{{ $peta->persil->kode_persil ?? '-' }}</strong> |
                            Pemilik: <strong>{{ $peta->persil->warga->nama ?? '-' }}</strong>
                        </small>
                    </div>

                    <div>
                        <a href="{{ route('peta_persil.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('peta_persil.edit', $peta->peta_id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>

                {{-- DETAIL PERSIL --}}
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="text-muted">Kode Persil</label>
                                <h6>{{ $peta->persil->kode_persil ?? '-' }}</h6>
                            </div>

                            <div class="col-md-4">
                                <label class="text-muted">Pemilik</label>
                                <h6>{{ $peta->persil->warga->nama ?? '-' }}</h6>
                            </div>

                            <div class="col-md-4">
                                <label class="text-muted">Luas</label>
                                <h6>{{ $peta->persil->luas_m2 ?? '-' }} m²</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="text-muted">Panjang</label>
                                <h6>{{ $peta->panjang_m ?? '-' }} m</h6>
                            </div>

                            <div class="col-md-4">
                                <label class="text-muted">Lebar</label>
                                <h6>{{ $peta->lebar_m ?? '-' }} m</h6>
                            </div>

                            <div class="col-md-4">
                                <label class="text-muted">Alamat</label>
                                <h6>{{ $peta->persil->alamat_lahan ?? '-' }}</h6>
                            </div>
                        </div>

                        <div class="text-muted small mt-2">
                            <i class="fas fa-info-circle"></i>
                            Dibuat: {{ $peta->created_at?->format('d-m-Y H:i') ?? '-' }} |
                            Diperbarui: {{ $peta->updated_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- MAP GEOJSON --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <strong>Peta GeoJSON</strong>
                    </div>
                    <div class="card-body">
                        <div id="map"></div>

                        @if (!$peta->geojson)
                            <div class="text-center text-muted mt-3">
                                <i class="fas fa-info-circle"></i> GeoJSON belum tersedia
                            </div>
                        @endif
                    </div>
                </div>

                {{-- MEDIA PETA PERSIL --}}
                <div class="table-responsive">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">File Media Peta Persil</h4>
                            <small class="text-muted">
                                Total file: <strong>{{ $media->count() }}</strong>
                            </small>
                        </div>

                        <div>
                            <a href="{{ route('peta_persil.edit', $peta->peta_id) }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Upload File Baru
                            </a>
                        </div>
                    </div>

                    {{-- Statistik --}}
                    <div class="d-flex row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $media->count() }}</h3>
                                    <small class="text-muted">Total File</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $images->count() }}</h3>
                                    <small class="text-muted">Gambar</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $documents->count() }}</h3>
                                    <small class="text-muted">Dokumen</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $others->count() }}</h3>
                                    <small class="text-muted">Lainnya</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Media --}}
                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Tipe</th>
                                <th>Keterangan</th>
                                <th>Tanggal Upload</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($media as $item)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">
                                                <i
                                                    class="fas fa-file me-2
                                                @if (str_contains($item->mime_type, 'image')) text-success
                                                @elseif(str_contains($item->mime_type, 'pdf')) text-danger
                                                @elseif(str_contains($item->mime_type, 'word')) text-primary
                                                @elseif(str_contains($item->mime_type, 'excel')) text-success
                                                @else text-secondary @endif">
                                                </i>
                                                {{ $item->file_name }}
                                            </div>
                                            <div class="status">{{ $item->mime_type }}</div>
                                        </div>
                                    </td>

                                    <td>
                                        @if (str_contains($item->mime_type, 'image'))
                                            <div class="badge bg-success">Gambar</div>
                                        @elseif(str_contains($item->mime_type, 'pdf'))
                                            <div class="badge bg-danger">PDF</div>
                                        @elseif(str_contains($item->mime_type, 'word'))
                                            <div class="badge bg-primary">Word</div>
                                        @elseif(str_contains($item->mime_type, 'excel'))
                                            <div class="badge bg-success">Excel</div>
                                        @else
                                            <div class="badge bg-secondary">File</div>
                                        @endif
                                    </td>

                                    <td>{{ $item->caption ?: '-' }}</td>

                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->created_at->format('d-m-Y') }}</div>
                                            <div class="status">{{ $item->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ $item->url }}" target="_blank"
                                                class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                                class="btn btn-link btn-success btn-lg">
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
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                        Belum ada file untuk peta ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="text-muted small mt-2">
                        <i class="fas fa-info-circle"></i>
                        Menampilkan {{ $media->count() }} file
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.admin.js-show')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map').setView([-6.2, 106.8], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            @if ($peta->geojson)
                let geo = {!! $peta->geojson !!};

                //dri database datanya masih string, ubh dlu ke json
                if (typeof geo === 'string') {
                    try {
                        geo = JSON.parse(geo);
                    } catch (e) {
                        console.error("GeoJSON invalid", e);
                    }
                }
                let layer = L.geoJSON(geo).addTo(map);
                map.fitBounds(layer.getBounds());
            @endif

            setTimeout(() => map.invalidateSize(), 500);
        });
    </script>
@endsection
