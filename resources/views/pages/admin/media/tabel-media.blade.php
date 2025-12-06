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
                        <h4 class="mb-0">Semua File Media</h4>
                        <a href="{{ route('persil.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- Tabel --}}
                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File</th>
                                <th>Sumber</th>
                                <th>Tipe</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th style="width: 12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($media as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
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
                                        <div class="user-info">
                                            <div class="username">
                                                <span class="badge bg-primary">{{ $item->ref_table }}</span>
                                            </div>
                                            <div class="status">
                                                ID: {{ $item->ref_id }}
                                            </div>
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
                                                title="Lihat File" class="btn btn-link btn-info btn-lg">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                                data-bs-toggle="tooltip" title="Download"
                                                class="btn btn-link btn-success btn-lg">
                                                <i class="fa fa-download"></i>
                                            </a>

                                            <button type="button" data-bs-toggle="tooltip" title="Hapus File"
                                                class="btn btn-link btn-danger delete-media-btn"
                                                data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-database fa-2x mb-2"></i><br>
                                        Belum ada file media
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if ($media->hasPages())
                        <div class="mt-3">
                            {{ $media->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hapus media langsung dengan konfirmasi
            document.querySelectorAll('.delete-media-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const mediaId = this.getAttribute('data-id');
                    const fileName = this.getAttribute('data-name');

                    if (confirm(`Hapus file "${fileName}"?`)) {
                        fetch(`/media/${mediaId}`, {
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
                                    const tableContainer = document.querySelector(
                                        '.table-responsive');
                                    tableContainer.insertBefore(alert, tableContainer
                                        .querySelector('table'));

                                    // Auto remove alert setelah 3 detik
                                    setTimeout(() => {
                                        alert.remove();
                                    }, 3000);

                                    // Jika tidak ada file lagi
                                    if (document.querySelectorAll('tbody tr').length === 0) {
                                        document.querySelector('tbody').innerHTML = `
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            <i class="fas fa-database fa-2x mb-2"></i><br>
                                            Belum ada file media
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

    <style>
        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        .form-button-action .btn {
            padding: 0.25rem;
            margin: 0 2px;
        }
    </style>
@endsection
