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
            <form action="{{ route('sengketa_persil.update', $sengketa->sengketa_id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ================= PILIH / SEARCH PERSIL ================= --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Cari Persil</label>

                            <input type="text" id="search-persil" class="form-control"
                                placeholder="Cari kode persil / nama warga / email / telp"
                                value="{{ $sengketa->persil->kode_persil }} - {{ $sengketa->persil->warga->nama }}">

                            <input type="hidden" name="persil_id" id="persil_id" value="{{ $sengketa->persil_id }}">

                            <small id="search-status" class="text-muted d-block mt-1">
                                Jika ingin mengganti persil, ketik minimal 2 karakter
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
                                value="{{ old('pihak_1', $sengketa->pihak_1) }}">
                            @error('pihak_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Pihak 2</label>
                            <input type="text" name="pihak_2" class="form-control @error('pihak_2') is-invalid @enderror"
                                value="{{ old('pihak_2', $sengketa->pihak_2) }}">
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
                                <option value="proses"
                                    {{ old('status', $sengketa->status) == 'proses' ? 'selected' : '' }}>
                                    Proses
                                </option>
                                <option value="mediasi"
                                    {{ old('status', $sengketa->status) == 'mediasi' ? 'selected' : '' }}>
                                    Mediasi
                                </option>
                                <option value="selesai"
                                    {{ old('status', $sengketa->status) == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
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
                            <textarea name="kronologi" rows="4" class="form-control @error('kronologi') is-invalid @enderror">{{ old('kronologi', $sengketa->kronologi) }}</textarea>
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
                            <textarea name="penyelesaian" rows="3" class="form-control">{{ old('penyelesaian', $sengketa->penyelesaian) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ==================== SECTION UPLOAD FILE (opsional edit) ==================== --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0"><i class="fas fa-paperclip"></i> Tambah File Baru (Opsional)</h5>
                            </div>

                            <div class="card-body">
                                <div id="file-upload-container">
                                    <div class="file-upload-item mb-3">
                                        <div class="row g-2">
                                            <div class="col-md-6">
                                                <input type="file" name="media_files[]"
                                                    class="form-control form-control-sm">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="media_captions[]"
                                                    class="form-control form-control-sm"
                                                    placeholder="Keterangan file (opsional)">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-sm btn-danger remove-file-btn"
                                                    style="display:none">
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
                                    <i class="fas fa-info-circle"></i> Format: JPG, PNG, PDF (Max 2MB)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ================= BUTTON ================= --}}
                <div class="card-action d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save"></i> Update Sengketa
                    </button>

                    <a href="{{ route('sengketa_persil.index') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            {{-- ========== HAPUS FILE YANG SUDAH ADA ========== --}}
            document.querySelectorAll('.delete-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const mediaId = this.getAttribute('data-id');
                    const fileName = this.closest('.file-card').querySelector('.file-name')
                        .textContent;

                    if (confirm(`Hapus file "${fileName}"?`)) {
                        // Kirim request DELETE via AJAX
                        fetch(`/persil/media/${mediaId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hapus card dari tampilan
                                    this.closest('.col-md-4').remove();

                                    // Tampilkan pesan sukses
                                    alert('File berhasil dihapus!');
                                } else {
                                    alert('Gagal menghapus file!');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan!');
                            });
                    }
                });
            });

            {{-- ========== TAMBAH FILE INPUT BARU ========== --}}
            const newFileContainer = document.getElementById('new-file-upload-container');
            const addNewFileBtn = document.getElementById('add-new-file-btn');
            let newFileCount = 1;

            // Tambah file input baru
            addNewFileBtn.addEventListener('click', function() {
                newFileCount++;

                const newItem = document.createElement('div');
                newItem.className = 'new-file-item mb-3';
                newItem.innerHTML = `
                <div class="row g-2">
                    <div class="col-md-6">
                        <input type="file" name="media_files[]"
                               class="form-control form-control-sm">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="media_captions[]"
                               class="form-control form-control-sm"
                               placeholder="Keterangan file (opsional)">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-sm btn-danger remove-new-file-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;

                newFileContainer.appendChild(newItem);

                // Tampilkan semua tombol hapus
                document.querySelectorAll('.remove-new-file-btn').forEach(btn => {
                    btn.style.display = 'block';
                });
            });

            // Hapus file input baru
            newFileContainer.addEventListener('click', function(e) {
                if (e.target.closest('.remove-new-file-btn')) {
                    const item = e.target.closest('.new-file-item');
                    item.remove();
                    newFileCount--;

                    // Sembunyikan tombol hapus jika hanya ada 1
                    if (newFileCount === 1) {
                        document.querySelector('.remove-new-file-btn').style.display = 'none';
                    }
                }
            });
        });
    </script>

    {{-- CSS tambahan --}}
    <style>
        .file-card {
            transition: all 0.3s;
            border-left: 4px solid #007bff;
        }

        .file-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .file-name {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .delete-file-btn:hover {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .new-file-item {
            border-left: 3px solid #28a745;
            padding-left: 10px;
        }
    </style>
    @include('layouts.admin.js-form')
@endsection
