@extends('layouts.admin.app')

@section('content')
    <div class="card-body">
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">

                    <form method="GET" action="{{ route('media.index') }}" class="mb-3">
                        <div class="row">

                            {{-- FILTER REF_TABLE --}}
                            <div class="col-md-3">
                                <select name="ref_table" class="form-select" onchange="this.form.submit()">
                                    <option value="">Semua Sumber</option>
                                    @foreach ($filter as $item)
                                        <option value="{{ $item->ref_table }}"
                                            {{ request('ref_table') == $item->ref_table ? 'selected' : '' }}>
                                            {{ strtoupper($item->ref_table) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- SEARCH --}}
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        value="{{ request('search') }}" placeholder="Cari filename / caption / mime type">

                                    <button type="submit" class="input-group-text">
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
                    </form>


                    <table class="display table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="80">Media</th>
                                <th>File Name</th>
                                <th>Ref Table</th>
                                <th>Ref ID</th>
                                <th>Caption</th>
                                <th>Mime Type</th>
                                <th width="12%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($media as $item)
                                <tr>
                                    <td class="text-center">
                                        @if (Str::startsWith($item->mime_type, 'image'))
                                            <img src="{{ $item->url }}" width="70" height="60"
                                                style="object-fit:cover; border-radius:6px;">
                                        @else
                                            <span class="badge bg-info">File</span>
                                        @endif
                                    </td>

                                    <td>{{ $item->file_name }}</td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $item->ref_table }}
                                        </span>
                                    </td>

                                    <td>{{ $item->ref_id }}</td>

                                    <td>{{ $item->caption ?? '-' }}</td>

                                    <td>{{ $item->mime_type }}</td>

                                    <td>
                                        <div class="form-button-action">

                                            <a href="{{ $item->url }}" target="_blank"
                                                class="btn btn-link btn-secondary btn-lg" title="Lihat File">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <a href="{{ route('media.edit', $item->media_id) }}"
                                                class="btn btn-link btn-primary btn-lg" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('media.destroy', $item->media_id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus media ini?');" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-link btn-danger" title="Hapus">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Tidak ada data media
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $media->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
