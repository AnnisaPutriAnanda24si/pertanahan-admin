@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    {{-- form --}}
    <div class="card-body">
        <form action="{{ route('persil.store') }}" method="POST">
            @csrf

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Kode Persil -->
                    <div class="form-group">
                        <label for="kode_persil">Kode Persil</label>
                        <input type="text" id="kode_persil" name="kode_persil" value="{{ old('kode_persil') }}"
                            placeholder="Masukkan kode persil"
                            class="form-control @error('kode_persil') is-invalid @enderror">
                        @error('kode_persil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Pemilik Warga (Select) -->
                    <div class="form-group">
                        <label for="pemilik_warga_id">Pemilik Warga</label>
                        <!-- Tampilkan nama pemilik sebagai teks -->
                        <input type="text" class="form-control" value="{{ $nama }}" disabled>
                        <!-- Hidden input untuk menyimpan ID -->
                        <input type="hidden" name="pemilik_warga_id" value="{{ $warga_id }}">
                    </div>

                </div>
            </div> {{-- Akhir Row 1 --}}

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Luas (m²) -->
                    <div class="form-group">
                        <label for="luas_m2">Luas (m²)</label>
                        <input type="number" id="luas_m2" name="luas_m2" value="{{ old('luas_m2') }}"
                            placeholder="Masukkan luas lahan" class="form-control @error('luas_m2') is-invalid @enderror">
                        @error('luas_m2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Penggunaan -->
                    <div class="form-group">
                        <label for="penggunaan">Penggunaan</label>
                        <input type="text" id="penggunaan" name="penggunaan" value="{{ old('penggunaan') }}"
                            placeholder="Masukkan penggunaan lahan"
                            class="form-control @error('penggunaan') is-invalid @enderror">
                        @error('penggunaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div> {{-- Akhir Row 2 --}}

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Alamat Lahan -->
                    <div class="form-group">
                        <label for="alamat_lahan">Alamat Lahan</label>
                        <input type="text" id="alamat_lahan" name="alamat_lahan" value="{{ old('alamat_lahan') }}"
                            placeholder="Masukkan alamat lahan"
                            class="form-control @error('alamat_lahan') is-invalid @enderror">
                        @error('alamat_lahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-3">
                    <!-- RT -->
                    <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" id="rt" name="rt" value="{{ old('rt') }}" placeholder="RT"
                            class="form-control @error('rt') is-invalid @enderror">
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <!-- RW -->
                    <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" id="rw" name="rw" value="{{ old('rw') }}" placeholder="RW"
                            class="form-control @error('rw') is-invalid @enderror">
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div> {{-- Akhir Row 3 --}}

            <!-- Tombol (Simpan dan Batal) - Tetap di Kanan -->
            <div class="card-action d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('persil.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
    {{-- form --}}
    {{-- End Main Content --}}
@endsection
