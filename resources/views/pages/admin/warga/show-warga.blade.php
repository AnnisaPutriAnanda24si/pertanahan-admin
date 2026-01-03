@extends('layouts.admin.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Tabel
                </h4>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">Detail Warga</h4>
                        <a href="{{ route('warga.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- ===================== DATA WARGA ===================== --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <strong>Informasi Warga</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered mb-0">
                                <tr>
                                    <th width="180">Nama</th>
                                    <td>{{ $warga->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIK</th>
                                    <td>{{ $warga->no_ktp }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $warga->email }}</td>
                                </tr>
                                <tr>
                                    <th>Kontak</th>
                                    <td>{{ $warga->telp ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- ===================== PERSIL ===================== --}}
                    <div class="card">
                        <div class="card-header">
                            <strong>Daftar Persil Milik {{ $warga->nama }}</strong>
                        </div>

                        <div class="card-body">

                            @forelse ($warga->persil as $persil)
                                <div class="border rounded p-3 mb-4">

                                    <h5>
                                        {{ $persil->kode_persil }}
                                        <span class="badge bg-primary">{{ $persil->penggunaan }}</span>
                                    </h5>

                                    <p class="mb-1">
                                        <strong>Luas:</strong> {{ $persil->luas_m2 }} m² <br>
                                        <strong>Alamat:</strong> {{ $persil->alamat_lahan }} (RT {{ $persil->rt }}/RW
                                        {{ $persil->rw }})
                                    </p>

                                    {{-- ===================== DOKUMEN ===================== --}}
                                    <h6 class="mt-3">Dokumen Persil</h6>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Nomor</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($persil->dokumen_persil as $doc)
                                                <tr>
                                                    <td>{{ $doc->jenis_dokumen }}</td>
                                                    <td>{{ $doc->nomor }}</td>
                                                    <td>{{ $doc->keterangan ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">Tidak ada dokumen</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    {{-- ===================== SENGKETA ===================== --}}
                                    <h6 class="mt-3">Sengketa Persil</h6>
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Pihak 1</th>
                                                <th>Pihak 2</th>
                                                <th>Status</th>
                                                <th>Penyelesaian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($persil->sengketa_persil as $sg)
                                                <tr>
                                                    <td>{{ $sg->pihak_1 }}</td>
                                                    <td>{{ $sg->pihak_2 }}</td>
                                                    <td>{{ $sg->status }}</td>
                                                    <td>{{ $sg->penyelesaian ?? '-' }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center text-muted">Tidak ada sengketa
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    {{-- ===================== PETA ===================== --}}
                                    <h6 class="mt-3">Peta Persil</h6>

                                    @forelse ($persil->peta_persil as $peta)
                                        <div class="mb-3">
                                            <div id="map-{{ $peta->peta_id }}" class="map-box"></div>
                                        </div>

                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                var map = L.map('map-{{ $peta->peta_id }}');

                                                @if ($peta->geojson)
                                                    let geo = {!! $peta->geojson !!};
                                                    let layer = L.geoJSON(geo).addTo(map);
                                                    map.fitBounds(layer.getBounds());
                                                @else
                                                    map.setView([0, 0], 2);
                                                @endif

                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                                                    .addTo(map);

                                                setTimeout(() => map.invalidateSize(), 500);
                                            });
                                        </script>

                                    @empty
                                        <div class="text-muted">Tidak ada data peta</div>
                                    @endforelse

                                </div>
                            @empty
                                <div class="text-center text-muted">
                                    Tidak ada persil yang dimiliki warga ini
                                </div>
                            @endforelse

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <style>
        .map-box {
            width: 100%;
            height: 300px;
            border-radius: 6px;
        }
    </style>

@endsection
