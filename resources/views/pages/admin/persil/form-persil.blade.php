@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        {{-- TAMBAHKAN enctype="multipart/form-data" untuk upload file --}}
        <form action="{{ route('persil.store') }}" method="POST" enctype="multipart/form-data">
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

            <!-- Tombol (Simpan dan Batal) -->
            <div class="card-action d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Simpan Data & File
                </button>
                <a href="{{ route('persil.index') }}" class="btn btn-danger">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </form>
    </div>

    {{-- JavaScript untuk dynamic file upload --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('file-upload-container');
            const addBtn = document.getElementById('add-file-btn');
            let fileCount = 1; // Hitung jumlah file input

            // Fungsi untuk tambah file input baru
            addBtn.addEventListener('click', function() {
                fileCount++;

                const newItem = document.createElement('div');
                newItem.className = 'file-upload-item mb-3';
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
                        <button type="button" class="btn btn-sm btn-danger remove-file-btn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            `;

                container.appendChild(newItem);

                // Tampilkan semua tombol hapus
                document.querySelectorAll('.remove-file-btn').forEach(btn => {
                    btn.style.display = 'block';
                });
            });

            // Fungsi untuk hapus file input
            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-file-btn')) {
                    const item = e.target.closest('.file-upload-item');
                    item.remove();
                    fileCount--;

                    // Sembunyikan tombol hapus jika hanya ada 1 file input
                    if (fileCount === 1) {
                        document.querySelector('.remove-file-btn').style.display = 'none';
                    }
                }
            });
        });
    </script>

    {{-- CSS tambahan --}}
    <style>
        .file-upload-item {
            border-left: 3px solid #007bff;
            padding-left: 10px;
        }

        .remove-file-btn {
            transition: all 0.3s;
        }

        .remove-file-btn:hover {
            transform: scale(1.1);
        }
    </style>
@endsection
