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

            {{-- ================= FILE MEDIA (opsional, tetap dibiarkan) ================= --}}
            @include('layouts.admin.media-upload') {{-- kalau kamu sebelumnya pisah ke partial --}}
            {{-- atau biarkan blok upload-mu seperti sebelumnya jika tidak dipisah --}}

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
                    var existing = JSON.parse(`{!! $peta->geojson !!}`);
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

    {{-- @include('layouts.admin.js-form') --}}
@endsection
