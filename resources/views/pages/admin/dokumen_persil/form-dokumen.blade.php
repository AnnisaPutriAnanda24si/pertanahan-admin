@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <form action="{{ route('dokumen_persil.store') }}" method="POST" enctype="multipart/form-data">
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

            {{-- ================= NOMOR DOKUMEN ================= --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nomor Dokumen</label>
                        <input type="text" name="nomor" class="form-control @error('nomor') is-invalid @enderror"
                            value="{{ old('nomor') }}">
                        @error('nomor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- ================= JENIS DOKUMEN ================= --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Jenis Dokumen</label>
                        <select name="jenis_dokumen" class="form-select @error('jenis_dokumen') is-invalid @enderror">
                            <option value="">-- Pilih Jenis --</option>
                            <option value="sertifikat" {{ old('jenis_dokumen') == 'sertifikat' ? 'selected' : '' }}>
                                Sertifikat</option>
                            <option value="akta" {{ old('jenis_dokumen') == 'akta' ? 'selected' : '' }}>Akta</option>
                            <option value="surat" {{ old('jenis_dokumen') == 'surat' ? 'selected' : '' }}>Surat</option>
                            <option value="kepemilikan" {{ old('jenis_dokumen') == 'kepemilikan' ? 'selected' : '' }}>
                                Riwayat Kepemilikan</option>

                        </select>
                        @error('jenis_dokumen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- ================= KETERANGAN ================= --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
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
                            <h5 class="mb-0"><i class="fas fa-paperclip"></i> File Pendukung (Opsional)</h5>
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
                                                style="display:none;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="add-file-btn" class="btn btn-sm btn-secondary">
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
                    <i class="fas fa-save"></i> Simpan Dokumen
                </button>
                <a href="{{ route('dokumen_persil.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    @include('layouts.admin.js-form')
@endsection
