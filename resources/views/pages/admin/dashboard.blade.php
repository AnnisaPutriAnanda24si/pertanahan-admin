@extends('layouts.admin.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <!-- STATISTIK UTAMA -->
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Warga</p>
                                        <h4 class="card-title">{{ number_format($totalWarga) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-info mt-2">
                                <div class="progress-label">
                                    <span class="text-success">
                                        <i class="fas fa-check-circle"></i>
                                        {{ $wargaPunyaPersil }} punya persil
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-map"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Persil</p>
                                        <h4 class="card-title">{{ number_format($totalPersil) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-info mt-2">
                                <div class="progress-label">
                                    <span>
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $totalGeojson }} punya peta
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Dokumen</p>
                                        <h4 class="card-title">{{ number_format($totalDokumen) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-info mt-2">
                                <div class="progress-label">
                                    @foreach ($dokumenPerJenis as $jenis => $total)
                                        <span class="badge badge-light mr-1">{{ $jenis }}:
                                            {{ $total }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-balance-scale"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Sengketa</p>
                                        <h4 class="card-title">{{ number_format($totalSengketa) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-info mt-2">
                                <div class="progress-label">
                                    <span class="badge badge-warning mr-1">Proses: {{ $sedangProses }}</span>
                                    <span class="badge badge-success mr-1">Selesai: {{ $selesai }}</span>
                                    <span class="badge badge-danger mr-1">Batal: {{ $dibatalkan }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHART UTAMA -->
            {{-- <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Statistik Penambahan Persil ({{ date('Y') }})</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Penggunaan Persil</div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h4>{{ $totalPersil }} Total Persil</h4>
                            </div>
                            <div class="pull-in">
                                <canvas id="penggunaanChart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card card-round">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-end text-primary">
                                @php
                                    $totalSengketaChart = $sedangProses + $selesai + $dibatalkan;
                                    $persentaseSelesai =
                                        $totalSengketaChart > 0 ? round(($selesai / $totalSengketaChart) * 100) : 0;
                                @endphp
                                {{ $persentaseSelesai }}%
                            </div>
                            <h2 class="mb-2">{{ $selesai }}</h2>
                            <p class="text-muted">Sengketa Selesai</p>
                            <div class="pull-in sparkline-fix">
                                <div id="sengketaChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <!-- PETA DAN GEOJSON -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <h4 class="card-title">Peta Persil</h4>
                                <div class="card-tools">
                                    <button class="btn btn-icon btn-link btn-primary btn-xs">
                                        <span class="fa fa-expand"></span>
                                    </button>
                                </div>
                            </div>
                            <p class="card-category">
                                Visualisasi data geospasial persil warga
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive table-hover table-sales">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Status Peta</th>
                                                    <th class="text-end">Jumlah</th>
                                                    <th class="text-end">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="flag">
                                                            <i class="fas fa-check-circle text-success"></i>
                                                            <span class="ms-2">Punya GeoJSON</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">{{ $totalGeojson }}</td>
                                                    <td class="text-end">
                                                        @php
                                                            $percentGeo =
                                                                $totalPeta > 0
                                                                    ? round(($totalGeojson / $totalPeta) * 100, 2)
                                                                    : 0;
                                                        @endphp
                                                        {{ $percentGeo }}%
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="flag">
                                                            <i class="fas fa-times-circle text-danger"></i>
                                                            <span class="ms-2">Tanpa GeoJSON</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">{{ $withoutGeojson }}</td>
                                                    <td class="text-end">
                                                        @php
                                                            $percentNoGeo =
                                                                $totalPeta > 0
                                                                    ? round(($withoutGeojson / $totalPeta) * 100, 2)
                                                                    : 0;
                                                        @endphp
                                                        {{ $percentNoGeo }}%
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="flag">
                                                            <i class="fas fa-database text-info"></i>
                                                            <span class="ms-2">Total Data Peta</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">{{ $totalPeta }}</td>
                                                    <td class="text-end">100%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $percentGeo }}%" aria-valuenow="{{ $totalGeojson }}"
                                                aria-valuemin="0" aria-valuemax="{{ $totalPeta }}">
                                                {{ $totalGeojson }} dengan peta
                                            </div>
                                            <div class="progress-bar bg-danger" role="progressbar"
                                                style="width: {{ $percentNoGeo }}%"
                                                aria-valuenow="{{ $withoutGeojson }}" aria-valuemin="0"
                                                aria-valuemax="{{ $totalPeta }}">
                                                {{ $withoutGeojson }} tanpa peta
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert alert-info">
                                        <h5><i class="fas fa-map-marked-alt"></i> Informasi Peta</h5>
                                        <p>
                                            Total <strong>{{ count($geojsonData['features']) }}</strong> feature
                                            GeoJSON tersedia.
                                            @if (count($geojsonData['features']) > 0)
                                                <a href="{{ route('peta_persil.index') }}"
                                                    class="btn btn-sm btn-outline-info mt-2">
                                                    Lihat Peta Lengkap
                                                </a>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="map-placeholder border rounded p-3 text-center"
                                        style="height: 200px; background: #f8f9fa;">
                                        <i class="fas fa-map fa-3x text-muted mb-3"></i>
                                        <h5>Preview Peta</h5>
                                        <p class="text-muted">Total {{ $totalGeojson }} persil memiliki data peta</p>
                                        @if ($totalGeojson > 0)
                                            <a href="{{ route('peta_persil.index') }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-external-link-alt"></i> Buka Peta
                                            </a>
                                        @else
                                            <a href="{{ route('peta_persil.create') }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-plus"></i> Tambah Peta
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TABEL TRANSAKSI / AKTIVITAS TERBARU -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Ringkasan Data</div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Kategori</th>
                                            <th scope="col" class="text-end">Total</th>
                                            <th scope="col" class="text-end">Detail</th>
                                            <th scope="col" class="text-end">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-users text-primary me-3"></i>
                                                    <div>
                                                        <h6 class="mb-0">Warga</h6>
                                                        <small class="text-muted">Total data warga</small>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-end">
                                                <strong>{{ number_format($totalWarga) }}</strong>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-success">{{ $wargaPunyaPersil }} punya
                                                    persil</span>
                                                <span class="badge badge-warning">{{ $wargaTanpaPersil }} tanpa
                                                    persil</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Aktif</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-map text-info me-3"></i>
                                                    <div>
                                                        <h6 class="mb-0">Persil</h6>
                                                        <small class="text-muted">Data bidang tanah</small>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-end">
                                                <strong>{{ number_format($totalPersil) }}</strong>
                                            </td>
                                            <td class="text-end">
                                                @if (count($labelPenggunaan) > 0)
                                                    @foreach ($labelPenggunaan as $key => $label)
                                                        @if ($key < 3)
                                                            {{-- Tampilkan maksimal 3 penggunaan --}}
                                                            <span class="badge badge-light">{{ $label }}</span>
                                                        @endif
                                                    @endforeach
                                                    @if (count($labelPenggunaan) > 3)
                                                        <span
                                                            class="badge badge-secondary">+{{ count($labelPenggunaan) - 3 }}
                                                            lainnya</span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-info">Terkelola</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-file-contract text-success me-3"></i>
                                                    <div>
                                                        <h6 class="mb-0">Dokumen</h6>
                                                        <small class="text-muted">Dokumen persil</small>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-end">
                                                <strong>{{ number_format($totalDokumen) }}</strong>
                                            </td>
                                            <td class="text-end">
                                                @foreach ($dokumenPerJenis as $jenis => $total)
                                                    @if ($loop->iteration <= 3)
                                                        {{-- Tampilkan maksimal 3 jenis --}}
                                                        <span class="badge badge-light">{{ $jenis }}:
                                                            {{ $total }}</span>
                                                    @endif
                                                @endforeach
                                                @if (count($dokumenPerJenis) > 3)
                                                    <span class="badge badge-secondary">+{{ count($dokumenPerJenis) - 3 }}
                                                        lainnya</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-success">Tersimpan</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-balance-scale text-secondary me-3"></i>
                                                    <div>
                                                        <h6 class="mb-0">Sengketa</h6>
                                                        <small class="text-muted">Kasus sengketa tanah</small>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-end">
                                                <strong>{{ number_format($totalSengketa) }}</strong>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-warning">{{ $sedangProses }} proses</span>
                                                <span class="badge badge-success">{{ $selesai }} selesai</span>
                                                <span class="badge badge-danger">{{ $dibatalkan }} batal</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="badge badge-{{ $sedangProses > 0 ? 'warning' : 'success' }}">
                                                    {{ $sedangProses > 0 ? 'Ada Proses' : 'Terselesaikan' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
