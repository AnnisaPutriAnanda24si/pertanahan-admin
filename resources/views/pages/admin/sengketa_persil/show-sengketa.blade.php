@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">

                {{-- Alert sukses --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="mb-0">Detail Sengketa Persil</h4>
                        <small class="text-muted">
                            Kode: <strong>{{ $sengketa->persil->kode_persil ?? '-' }}</strong> |
                            Pemilik: <strong>{{ $sengketa->persil->warga->nama ?? '-' }}</strong>
                        </small>
                    </div>

                    <div>
                        <a href="{{ route('sengketa_persil.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('sengketa_persil.edit', $sengketa->sengketa_id) }}" class="btn btn-primary">
                            <i class="fa fa-edit"></i> Edit Data
                        </a>
                    </div>
                </div>

                {{-- Detail Sengketa --}}
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Pihak 1</label>
                                <h6>{{ $sengketa->pihak_1 ?? '-' }}</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted">Pihak 2</label>
                                <h6>{{ $sengketa->pihak_2 ?? '-' }}</h6>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted">Kronologi</label>
                            <div class="border rounded p-3" style="white-space: pre-line">
                                {{ $sengketa->kronologi ?? '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="text-muted">Status</label><br>

                                @php
                                    $status = $sengketa->status;
                                    $badge = 'secondary';

                                    if ($status == 'proses') {
                                        $badge = 'warning';
                                    } elseif ($status == 'selesai') {
                                        $badge = 'success';
                                    } elseif ($status == 'dibatalkan') {
                                        $badge = 'danger';
                                    }
                                @endphp

                                <span class="badge bg-{{ $badge }}" style="font-size: 14px;">
                                    {{ strtoupper($status ?? '-') }}
                                </span>
                            </div>

                            <div class="col-md-6">
                                <label class="text-muted">Penyelesaian</label>
                                <div class="border rounded p-3" style="white-space: pre-line">
                                    {{ $sengketa->penyelesaian ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <div class="text-muted small mt-2">
                            <i class="fas fa-info-circle"></i>
                            Dibuat: {{ $sengketa->created_at?->format('d-m-Y H:i') ?? '-' }} |
                            Diperbarui: {{ $sengketa->updated_at?->format('d-m-Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- Media Sengketa --}}
                <div class="table-responsive">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-0">File Media Sengketa</h4>
                            <small class="text-muted">
                                Total file: <strong>{{ $media->count() }}</strong>
                            </small>
                        </div>

                        <div>
                            <a href="{{ route('sengketa_persil.edit', $sengketa->sengketa_id) }}" class="btn btn-primary">
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
                                    <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>
                                        Dokumen
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari file...">
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

                    {{-- Tabel Media --}}
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

                                            <button type="button" class="btn btn-link btn-danger delete-file-btn"
                                                data-id="{{ $item->media_id }}" data-name="{{ $item->file_name }}"
                                                data-bs-toggle="tooltip" title="Hapus File">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                        Belum ada file untuk sengketa ini
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="text-muted small mt-2">
                        <i class="fas fa-info-circle"></i>
                        Menampilkan {{ $media->count() }} file
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Delete --}}
    @include('layouts.admin.js-show')
@endsection
