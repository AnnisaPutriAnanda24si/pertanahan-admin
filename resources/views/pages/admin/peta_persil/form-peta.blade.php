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
                <h4 class="card-title mb-0">Data Tabel
                </h4>
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('peta_persil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ================= PILIH / SEARCH PERSIL ================= --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cari Persil</label>
                            <input type="text" id="search-persil" class="form-control"
                                placeholder="Cari kode persil / nama warga / email / telp">

                            <input type="hidden" name="persil_id" id="persil_id">

                            <small id="search-status" class="text-muted d-block mt-1">
                                Ketik minimal 2 karakter
                            </small>

                            <div id="persil-result" class="list-group mt-1"></div>

                            @error('persil_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ================= GEOJSON ================= --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>GeoJSON</label>

                            <input type="hidden" name="geojson" id="geojson">

                            <div id="map"></div>
                            {{-- <textarea name="geojson" rows="5" class="form-control @error('geojson') is-invalid @enderror">{{ old('geojson') }}</textarea> --}}
                            @error('geojson')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ================= DIMENSI LAHAN ================= --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Panjang (meter)</label>
                            <input type="number" step="0.01" name="panjang_m"
                                class="form-control @error('panjang_m') is-invalid @enderror"
                                value="{{ old('panjang_m') }}">
                            @error('panjang_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lebar (meter)</label>
                            <input type="number" step="0.01" name="lebar_m"
                                class="form-control @error('lebar_m') is-invalid @enderror" value="{{ old('lebar_m') }}">
                            @error('lebar_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ==================== SECTION UPLOAD FILE ==================== --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-paperclip"></i> File Pendukung (Opsional)
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="file-upload-container">
                                    <div class="file-upload-item mb-3">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="file" name="media_files[]"
                                                    class="form-control form-control-sm @error('media_files.*') is-invalid @enderror">
                                                @error('media_files.*')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="media_captions[]"
                                                    class="form-control form-control-sm"
                                                    placeholder="Keterangan file (opsional)">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-sm btn-danger remove-file-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="add-file-btn" class="btn btn-sm btn-secondary w-100">
                                    <i class="fas fa-plus"></i> Tambah File
                                </button>

                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle"></i> Format: JPG, PNG, PDF (Max: 2MB per file)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= BUTTON ================= --}}
                <div class="card-action d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save"></i> Simpan Peta Persil
                    </button>
                    <a href="{{ route('peta_persil.index') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Inisialisasi Map
            var map = L.map('map').setView([-6.2, 106.8], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            // Layer tempat gambar disimpan
            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            // Control Draw
            var drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: drawnItems
                },
                draw: {
                    polygon: true,
                    polyline: true,
                    rectangle: true,
                    circle: false,
                    marker: true,
                    circlemarker: false
                }
            });

            map.addControl(drawControl);

            // Saat digambar
            map.on(L.Draw.Event.CREATED, function(event) {
                var layer = event.layer;

                // jika hanya ingin 1 bentuk, hapus dulu yang lama
                drawnItems.clearLayers();

                drawnItems.addLayer(layer);

                saveGeoJSON();
            });

            // Saat diedit
            map.on(L.Draw.Event.EDITED, function() {
                saveGeoJSON();
            });

            // Saat dihapus
            map.on(L.Draw.Event.DELETED, function() {
                document.getElementById('geojson').value = "";
            });

            function saveGeoJSON() {
                var data = drawnItems.toGeoJSON();
                document.getElementById('geojson').value = JSON.stringify(data);
            }

        });
    </script>
    @include('layouts.admin.js-form')
@endsection
