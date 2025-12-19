@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <form action="{{ route('sengketa_persil.store') }}" method="POST" enctype="multipart/form-data">
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

            {{-- ================= PIHAK SENGKETA ================= --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pihak 1</label>
                        <input type="text" name="pihak_1" class="form-control @error('pihak_1') is-invalid @enderror"
                            value="{{ old('pihak_1') }}">
                        @error('pihak_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Pihak 2</label>
                        <input type="text" name="pihak_2" class="form-control @error('pihak_2') is-invalid @enderror"
                            value="{{ old('pihak_2') }}">
                        @error('pihak_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= STATUS ================= --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Status Sengketa</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            <option value="proses">Proses</option>
                            <option value="mediasi">Mediasi</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= KRONOLOGI ================= --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Kronologi</label>
                        <textarea name="kronologi" rows="4" class="form-control @error('kronologi') is-invalid @enderror">{{ old('kronologi') }}</textarea>
                        @error('kronologi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= PENYELESAIAN ================= --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Penyelesaian (Opsional)</label>
                        <textarea name="penyelesaian" rows="3" class="form-control">{{ old('penyelesaian') }}</textarea>
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
                            {{-- Container untuk file upload --}}
                            <div id="file-upload-container">
                                {{-- File input pertama --}}
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

                            {{-- Tombol tambah file --}}
                            <button type="button" id="add-file-btn" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus"></i> Tambah File
                            </button>

                            {{-- Informasi file --}}
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i> Format: JPG, PNG, PDF (Max: 2MB per file)
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ==================== AKHIR SECTION UPLOAD FILE ==================== --}}


            {{-- ================= BUTTON ================= --}}
            <div class="card-action d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Simpan Sengketa
                </button>
                <a href="{{ route('sengketa_persil.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    {{-- ================= AJAX SEARCH PERSIL ================= --}}
    @include('layouts.admin.js-form')
@endsection
