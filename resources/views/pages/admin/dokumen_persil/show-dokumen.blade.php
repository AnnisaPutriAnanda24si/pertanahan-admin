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

            {{-- ALERT --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="mb-0">Dokumen Persil</h4>
                    <small class="text-muted">
                        Nomor: <strong>{{ $dokumen->nomor }}</strong> |
                        Jenis: <strong>{{ $dokumen->jenis_dokumen }}</strong>
                    </small><br>
                    <small class="text-muted">
                        Persil: <strong>{{ $dokumen->persil->kode_persil }}</strong> |
                        Pemilik: <strong>{{ $dokumen->persil->warga->nama }}</strong>
                    </small>
                </div>

                <div>
                    <a href="{{ route('media.create', [
                        'ref_table' => 'dokumen_persil',
                        'ref_id' => $dokumen->dokumen_id,
                    ]) }}"
                        class="btn btn-primary">
                        <i class="fa fa-plus"></i> Upload File
                    </a>
                </div>
            </div>


            {{-- INFORMASI DOKUMEN --}}
            <table class="table table-bordered mb-4">
                <tr>
                    <th width="200">Nomor Dokumen</th>
                    <td>{{ $dokumen->nomor }}</td>
                </tr>
                <tr>
                    <th>Jenis Dokumen</th>
                    <td>{{ $dokumen->jenis_dokumen }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $dokumen->keterangan ?: '-' }}</td>
                </tr>
            </table>


            {{-- Filter --}}
            {{-- <form method="GET" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <select name="mime_type" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="image" {{ request('mime_type') == 'image' ? 'selected' : '' }}>Gambar</option>
                            <option value="pdf" {{ request('mime_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                            <option value="word" {{ request('mime_type') == 'word' ? 'selected' : '' }}>Word</option>
                            <option value="excel" {{ request('mime_type') == 'excel' ? 'selected' : '' }}>Excel</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                placeholder="Cari file...">

                            <button class="input-group-text">
                                <i class="fa fa-search"></i>
                            </button>

                            @if (request('search'))
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}"
                                    class="btn btn-outline-secondary ms-2">
                                    Clear
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form> --}}


            {{-- TABEL MEDIA --}}
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Tipe</th>
                        <th>Keterangan</th>
                        <th>Tanggal Upload</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($media as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->file_name }}</strong><br>
                                <span class="text-muted small">{{ $item->mime_type }}</span>
                            </td>

                            <td>
                                @if (str_contains($item->mime_type, 'image'))
                                    <span class="badge bg-success">Gambar</span>
                                @elseif(str_contains($item->mime_type, 'pdf'))
                                    <span class="badge bg-danger">PDF</span>
                                @elseif(str_contains($item->mime_type, 'word'))
                                    <span class="badge bg-primary">Word</span>
                                @elseif(str_contains($item->mime_type, 'excel'))
                                    <span class="badge bg-success">Excel</span>
                                @else
                                    <span class="badge bg-secondary">File</span>
                                @endif
                            </td>

                            <td>{{ $item->caption ?: '-' }}</td>

                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>

                            <td>
                                <a href="{{ $item->url }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="{{ $item->url }}" download="{{ $item->file_name }}"
                                    class="btn btn-sm btn-success">
                                    <i class="fa fa-download"></i>
                                </a>

                                <button class="btn btn-sm btn-danger delete-file-btn" data-id="{{ $item->media_id }}"
                                    data-name="{{ $item->file_name }}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                Belum ada file media untuk dokumen ini
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            <div class="text-muted small">
                Menampilkan {{ $media->count() }} file
            </div>

        </div>
    </div>


    @include('layouts.admin.js-show')
@endsection
