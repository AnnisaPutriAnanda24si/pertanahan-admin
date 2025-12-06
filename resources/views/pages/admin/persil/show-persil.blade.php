@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="table-responsive">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">File Media Persil</h4>
                            <small class="text-muted">
                                Kode: <strong>{{ $persil->kode_persil }}</strong> |
                                Pemilik: <strong>{{ $persil->warga->nama }}</strong>
                            </small>
                        </div>
                        <div>
                            <a href="{{ route('persil.edit', $persil->persil_id) }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Upload File Baru
                            </a>
                        </div>
                    </div>

                    {{-- Statistik --}}
                    <div class="d-flex row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $media->count() }}</h3>
                                    <small class="text-muted">Total File</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $images->count() }}</h3>
                                    <small class="text-muted">Gambar</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $documents->count() }}</h3>
                                    <small class="text-muted">Dokumen</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <h3 class="mb-0">{{ $others->count() }}</h3>
                                    <small class="text-muted">Lainnya</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Filter --}}
                    <form method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <select name="type" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Tipe</option>
                                    <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Gambar
                                    </option>
                                    <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                    <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Dokumen
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari file..." aria-label="Search">
                                    <button type="submit" class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if (request('search'))
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                            class="btn btn-outline-secondary ml-3">
                                            Clear
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>

                    {{-- Tabel --}}
                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Tipe</th>
                                <th>Keterangan</th>
                                <th>Tanggal Upload</th>
                                <th style="width: 15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($media as $item)
                                <tr>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">
                                                <i
                                                    class="fas fa-file me-2
                                                    @if (str_contains($item->mime_type, 'image')) text-success
                                                    @elseif(str_contains($item->mime_type, 'pdf')) text-danger
                                                    @elseif(str_contains($item->mime_type, 'word')) text-primary
                                                    @elseif(str_contains($item->mime_type, 'excel')) text-success
                                                    @else text-secondary @endif">
                                                </i>
                                                {{ $item->file_name }}
                                            </div>
                                            <div class="status">{{ $item->mime_type }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (str_contains($item->mime_type, 'image'))
                                            <div class="badge bg-success">Gambar</div>
                                        @elseif(str_contains($item->mime_type, 'pdf'))
                                            <div class="badge bg-danger">PDF</div>
                                        @elseif(str_contains($item->mime_type, 'word'))
                                            <div class="badge bg-primary">Word</div>
                                        @elseif(str_contains($item->mime_type, 'excel'))
                                            <div class="badge bg-success">Excel</div>
                                        @else
                                            <div class="badge bg-secondary">File</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->caption ?: '-' }}</td>
                                    <td>
                                        <div class="user-info">
                                            <div class="username">{{ $item->created_at->format('d-m-Y') }}</div>
                                            <div class="status">{{ $item->created_at->format('H:i') }}</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ $item->url }}" target="_blank" data-bs-toggle="tooltip"
                                                title="Lihat File" class="btn btn-link btn-primary btn-lg">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                                data-bs-toggle="tooltip" title="Download"
                                                class="btn btn-link btn-success btn-lg">
                                                <i class="fa fa-download"></i>
                                            </a>

                                            <button type="button" data-bs-toggle="tooltip" title="Hapus File"
                                                class="btn btn-link btn-danger delete-file-btn"
                                                data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                        Belum ada file untuk persil ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}

                    {{-- <div class="mt-3">
                        {{ $media->links('pagination::bootstrap-5') }}
                    </div> --}}


                    {{-- Info jumlah --}}
                    <div class="text-muted small mt-2">
                        <i class="fas fa-info-circle"></i>
                        Menampilkan {{ $media->count() }} file
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hapus file dengan konfirmasi
            document.querySelectorAll('.delete-file-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fileId = this.getAttribute('data-id');
                    const fileName = this.getAttribute('data-name');

                    if (confirm(`Hapus file "${fileName}"?`)) {
                        fetch(`/persil/media/${fileId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Hapus baris dari tabel
                                    this.closest('tr').remove();

                                    // Tampilkan alert
                                    const alert = document.createElement('div');
                                    alert.className =
                                        'alert alert-success alert-dismissible fade show';
                                    alert.innerHTML = `
                                <i class="fas fa-check-circle me-2"></i>
                                File berhasil dihapus
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            `;

                                    // Insert alert di atas tabel
                                    document.querySelector('.table-responsive').insertBefore(
                                        alert, document.querySelector('table'));

                                    // Auto remove alert setelah 3 detik
                                    setTimeout(() => {
                                        alert.remove();
                                    }, 3000);

                                    // Jika tidak ada file lagi
                                    if (document.querySelectorAll('tbody tr').length === 0) {
                                        document.querySelector('tbody').innerHTML = `
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                            Belum ada file untuk persil ini
                                        </td>
                                    </tr>
                                `;
                                    }
                                } else {
                                    alert('Gagal menghapus file');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan');
                            });
                    }
                });
            });
        });
    </script>
@endsection
