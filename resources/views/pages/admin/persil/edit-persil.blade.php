@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <form action="{{ route('persil.update', $persil->persil_id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting untuk update --}}

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kode_persil">Kode Persil</label>
                        <input type="text" id="kode_persil" name="kode_persil"
                            value="{{ old('kode_persil', $persil->kode_persil) }}"
                            class="form-control @error('kode_persil') is-invalid @enderror">
                        @error('kode_persil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="pemilik_warga">Pemilik</label>
                        <input type="text" class="form-control" value="{{ $persil->warga->nama }}" disabled>
                        <input type="hidden" name="pemilik_warga_id" value="{{ $persil->pemilik_warga_id }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="luas_m2">Luas (m²)</label>
                        <input type="number" id="luas_m2" name="luas_m2" value="{{ old('luas_m2', $persil->luas_m2) }}"
                            class="form-control @error('luas_m2') is-invalid @enderror">
                        @error('luas_m2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="penggunaan">Penggunaan</label>
                        <input type="text" id="penggunaan" name="penggunaan"
                            value="{{ old('penggunaan', $persil->penggunaan) }}"
                            class="form-control @error('penggunaan') is-invalid @enderror">
                        @error('penggunaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="alamat_lahan">Alamat Lahan</label>
                        <input type="text" id="alamat_lahan" name="alamat_lahan"
                            value="{{ old('alamat_lahan', $persil->alamat_lahan) }}"
                            class="form-control @error('alamat_lahan') is-invalid @enderror">
                        @error('alamat_lahan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" id="rt" name="rt" value="{{ old('rt', $persil->rt) }}"
                            class="form-control @error('rt') is-invalid @enderror">
                        @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" id="rw" name="rw" value="{{ old('rw', $persil->rw) }}"
                            class="form-control @error('rw') is-invalid @enderror">
                        @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-action d-flex justify-content-end">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('persil.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>
@endsection
