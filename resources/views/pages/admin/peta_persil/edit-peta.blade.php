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

            <form action="{{ route('peta_persil.update', $peta->peta_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ================= INFORMASI PERSIL ================= --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Persil</label>

                            <input type="text" class="form-control"
                                value="{{ $peta->persil->kode_persil }} - {{ $peta->persil->warga->nama ?? '-' }}" disabled>

                            <input type="hidden" name="persil_id" id="persil_id" value="{{ $peta->persil_id }}">
                        </div>
                    </div>
                </div>

                {{-- ================= GEOJSON ================= --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>GeoJSON</label>

                            {{-- hidden untuk simpan geojson text --}}
                            <input type="hidden" name="geojson" id="geojson" value="{{ $peta->geojson }}">

                            <div id="map"></div>

                            @error('geojson')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ================= DIMENSI ================= --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Panjang (meter)</label>
                            <input type="number" step="0.01" name="panjang_m"
                                value="{{ old('panjang_m', $peta->panjang_m) }}"
                                class="form-control @error('panjang_m') is-invalid @enderror">
                            @error('panjang_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lebar (meter)</label>
                            <input type="number" step="0.01" name="lebar_m" value="{{ old('lebar_m', $peta->lebar_m) }}"
                                class="form-control @error('lebar_m') is-invalid @enderror">
                            @error('lebar_m')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ================= FILE MEDIA ================= --}}
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
                        <i class="fas fa-save"></i> Update Peta Persil
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

            var map = L.map('map').setView([-6.2, 106.8], 13);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            var drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: drawnItems
                },
                draw: {
                    polygon: true,
                    polyline: true,
                    rectangle: true,
                    marker: true,
                    circle: false,
                    circlemarker: false
                }
            });
            map.addControl(drawControl);

            // === LOAD GEOJSON EXISTING ===
            @if ($peta->geojson)
                try {
                    // var existing = JSON.parse(`{!! $peta->geojson !!}`);
                    var existing = @json($peta->geojson);
                    var layer = L.geoJSON(existing).addTo(drawnItems);
                    map.fitBounds(layer.getBounds());
                } catch (e) {
                    console.log("GeoJSON invalid");
                }
            @endif

            map.on(L.Draw.Event.CREATED, function(event) {
                drawnItems.clearLayers();
                drawnItems.addLayer(event.layer);
                saveGeoJSON();
            });

            map.on(L.Draw.Event.EDITED, saveGeoJSON);

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
