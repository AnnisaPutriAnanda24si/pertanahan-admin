@extends('layouts.admin.app')

@section('content')
    {{-- Start Main Content --}}
    {{-- form --}}
    <div class="card-body">
        {{-- Form action tetap sama --}}
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            {{-- Name --}}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                    class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Role --}}
            <div class="form-group">
                <select name="role" id="role" class="form-select" value="{{ old('role') }}">
                    <option value="" disabled>Any</option>
                    <option value="Client">Client</option>
                    <option value="Admin">Admin</option>
                    <option value="Super Admin">Super Admin</option>
                </select>
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}"
                    placeholder="Masukkan password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password C --}}
            <div class="form-group">
                <label for="password_confirmation">Password Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" placeholder="Masukkan password konfirmasi"
                    class="form-control @error('password_confirmation') is-invalid @enderror">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Tombol dipindahkan ke KANAN menggunakan class d-flex justify-content-end --}}
            <div class="card-action d-flex justify-content-end">
                {{-- Tombol Batal --}}
                <a href="{{ route('user.index') }}" class="btn btn-danger me-2">
                    <i class="fas fa-times"></i> Batal
                </a>
                {{-- Tombol SImpan --}}
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
    {{-- form --}}
    {{-- End Main Content --}}
@endsection
