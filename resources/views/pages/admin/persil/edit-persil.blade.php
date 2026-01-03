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
            {{-- TAMBAHKAN enctype="multipart/form-data" --}}
            <form action="{{ route('persil.update', $persil->persil_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

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
                            <input type="number" id="luas_m2" name="luas_m2"
                                value="{{ old('luas_m2', $persil->luas_m2) }}"
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

                {{-- ==================== FILE YANG SUDAH ADA ==================== --}}
                @if ($media && $media->count() > 0)
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">
                                        <i class="fas fa-paperclip"></i> File Terupload
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($media as $file)
                                            <div class="col-md-4 mb-3">
                                                <div class="card file-card" data-media-id="{{ $file->media_id }}">
                                                    <div class="card-body p-3">
                                                        {{-- Icon berdasarkan tipe file --}}
                                                        <div class="d-flex align-items-center mb-2">
                                                            @if (str_contains($file->mime_type, 'image'))
                                                                <i class="fas fa-file-image text-success me-2"></i>
                                                            @elseif(str_contains($file->mime_type, 'pdf'))
                                                                <i class="fas fa-file-pdf text-danger me-2"></i>
                                                            @else
                                                                <i class="fas fa-file text-secondary me-2"></i>
                                                            @endif

                                                            <span class="file-name text-truncate" style="max-width: 150px;">
                                                                {{ $file->file_name }}
                                                            </span>
                                                        </div>

                                                        {{-- Keterangan --}}
                                                        @if ($file->caption)
                                                            <p class="small text-muted mb-2">{{ $file->caption }}</p>
                                                        @endif

                                                        {{-- Tombol Action --}}
                                                        <div class="d-flex justify-content-between">
                                                            <a href="{{ $file->url }}" target="_blank"
                                                                class="btn btn-sm btn-info" title="Lihat">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            <a href="{{ $file->url }}" download
                                                                class="btn btn-sm btn-success" title="Download">
                                                                <i class="fas fa-download"></i>
                                                            </a>

                                                            <button type="button"
                                                                class="btn btn-sm btn-danger delete-file-btn"
                                                                data-id="{{ $file->media_id }}" title="Hapus">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                {{-- ==================== AKHIR FILE YANG SUDAH ADA ==================== --}}

                {{-- ==================== UPLOAD FILE BARU ==================== --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-plus-circle"></i> Tambah File Baru (Opsional)
                                </h5>
                            </div>
                            <div class="card-body">
                                <div id="new-file-upload-container">
                                    {{-- File input pertama untuk file baru --}}
                                    <div class="new-file-item mb-3">
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
                                                <button type="button" class="btn btn-sm btn-danger remove-new-file-btn"
                                                    style="display: none;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" id="add-new-file-btn" class="btn btn-sm btn-secondary w-100">
                                    <i class="fas fa-plus"></i> Tambah File Lagi
                                </button>

                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-info-circle"></i> Format: JPG, PNG, PDF (Max: 2MB per file)
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- ==================== AKHIR UPLOAD FILE BARU ==================== --}}

                <div class="card-action d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fas fa-save"></i> Update Data
                    </button>
                    <a href="{{ route('persil.index') }}" class="btn btn-danger">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>


    {{-- JavaScript untuk hapus file dan dynamic form --}}
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
@endsection
