@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    {{-- form --}}
    <div class="card-body">
        <form action="{{ route('jenis_penggunaan.update', $jenis_penggunaan->jenis_id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Penggunaan -->
            <div class="form-group">
                <label for="nama_penggunaan">Nama Penggunaan</label>
                <input type="text" id="nama_penggunaan" name="nama_penggunaan"
                    value="{{ old('nama_penggunaan', $jenis_penggunaan->nama_penggunaan) }}"
                    placeholder="Masukkan nama penggunaan"
                    class="form-control @error('nama_penggunaan') is-invalid @enderror">
                @error('nama_penggunaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan (opsional)"
                    class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan', $jenis_penggunaan->keterangan) }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol (Simpan dan Batal) -->
            <div class="card-action d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('jenis_penggunaan.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
    {{-- form --}
    {{-- End Main Content --}}
@endsection
