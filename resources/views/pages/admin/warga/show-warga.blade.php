@extends('layouts.admin.app')

<style>
    .map-box {
        width: 100%;
        height: 300px;
        border-radius: 6px;
        border: 1px solid #ebedf2;
    }
</style>

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Detail Data Warga</h4>
                <a href="{{ route('warga.index') }}" class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">

            {{-- HEADER INFO & AKSI --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-0">{{ $warga->nama }}</h3>
                    <p class="text-muted mb-0">Informasi profil warga dan kepemilikan aset lahan</p>
                </div>
                <div>
                    <a href="{{ route('warga.edit', $warga->warga_id) }}" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>

            {{-- GRID INFORMASI WARGA --}}
            <div class="card mb-4 border">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="text-muted mb-1">Nama Lengkap</label>
                            <h6 class="fw-bold">{{ $warga->nama }}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted mb-1">NIK (No. KTP)</label>
                            <h6 class="fw-bold">{{ $warga->no_ktp }}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted mb-1">Email / Alamat</label>
                            <h6 class="fw-bold text-primary">{{ $warga->email }}</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="text-muted mb-1">No. Telepon</label>
                            <h6 class="fw-bold">{{ $warga->telp ?? '-' }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RINGKASAN ASET --}}
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-primary">{{ $warga->persil->count() }}</h3>
                            <small class="text-muted text-uppercase fw-bold">Total Bidang Persil</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-success">
                                {{ number_format($warga->persil->sum('luas_m2'), 0, ',', '.') }} m²
                            </h3>
                            <small class="text-muted text-uppercase fw-bold">Total Luas Lahan</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border-0">
                        <div class="card-body text-center p-3">
                            <h3 class="fw-bold mb-0 text-danger">
                                {{ $warga->persil->flatMap->sengketa_persil->count() }}
                            </h3>
                            <small class="text-muted text-uppercase fw-bold">Kasus Sengketa</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DAFTAR PERSIL --}}
            <h4 class="fw-bold mb-3"><i class="fas fa-layer-group me-2"></i>Daftar Kepemilikan Persil</h4>

            @forelse ($warga->persil as $persil)
                <div class="card border mb-4 shadow-none">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-primary">{{ $persil->kode_persil }}</h5>
                        <span class="badge bg-primary">{{ $persil->penggunaan }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="text-muted small">Alamat Lahan:</label>
                                <p class="fw-bold mb-1">{{ $persil->alamat_lahan }}</p>
                                <small class="text-muted">RT {{ $persil->rt }} / RW {{ $persil->rw }}</small>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <label class="text-muted small">Luas Bidang:</label>
                                <h4 class="fw-bold">{{ number_format($persil->luas_m2, 0, ',', '.') }} m²</h4>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Tabel Dokumen --}}
                            <div class="col-lg-6">
                                <h6 class="fw-bold mb-2 small text-uppercase text-muted">Dokumen Legalitas</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Nomor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($persil->dokumen_persil as $doc)
                                                <tr>
                                                    <td>{{ $doc->jenis_dokumen }}</td>
                                                    <td>{{ $doc->nomor }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center small">Tidak ada dokumen</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Tabel Sengketa --}}
                            <div class="col-lg-6">
                                <h6 class="fw-bold mb-2 small text-uppercase text-muted">Status Sengketa</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Lawan Sengketa</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($persil->sengketa_persil as $sg)
                                                <tr>
                                                    <td>{{ $sg->pihak_2 }}</td>
                                                    <td><span
                                                            class="badge bg-warning text-dark small">{{ $sg->status }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center small">Tidak ada sengketa</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Visualisasi Peta --}}
                        <div class="mt-3">
                            <h6 class="fw-bold mb-2 small text-uppercase text-muted">Lokasi Spasial</h6>
                            @forelse ($persil->peta_persil as $peta)
                                <div id="map-{{ $peta->peta_id }}" class="map-box mb-2"></div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                        var map = L.map('map-{{ $peta->peta_id }}', {
                                            scrollWheelZoom: false
                                        });
                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                                        @if ($peta->geojson)
                                            let geo = {!! $peta->geojson !!};
                                            if (typeof geo === 'string') geo = JSON.parse(geo);
                                            let layer = L.geoJSON(geo, {
                                                style: {
                                                    color: "#1572e8",
                                                    weight: 2,
                                                    fillOpacity: 0.2
                                                }
                                            }).addTo(map);
                                            map.fitBounds(layer.getBounds());
                                        @else
                                            map.setView([0, 0], 2);
                                        @endif

                                        setTimeout(() => map.invalidateSize(), 500);
                                    });
                                </script>
                            @empty
                                <div class="bg-light text-center py-4 rounded border text-muted">
                                    <i class="fas fa-map-marker-alt mb-2"></i><br>Data GeoJSON belum tersedia
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 border rounded bg-light">
                    <i class="fas fa-user-slash fa-3x mb-3 text-muted opacity-25"></i>
                    <p class="text-muted">Warga ini belum memiliki data persil terdaftar.</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection
