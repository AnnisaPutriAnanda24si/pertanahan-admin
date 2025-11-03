@extends('layouts.guest.app')

@section('content')
    <!-- Kolom Kanan: Form Register -->
    <div class="col-lg-7 p-5">
        <h3 class="text-center mb-4 text-danger fw-bold">Buat Akun Baru Anda</h3>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('regis.regis') }}">
            @csrf

            {{-- Field Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Field Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email aktif">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Field Password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Buat password (minimal 8 karakter)">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Field Confirm Password --}}
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Ketik ulang password Anda">
            </div>

            <!-- Tombol diubah menjadi Daftar Sekarang (btn-danger) -->
            <button type="submit" class="btn btn-danger w-100 mb-3">Daftar Sekarang</button>

            <p class="text-center small mt-3">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Login
                    di sini</a>
            </p>
        </form>
    </div>
    <!-- End Kolom Kanan: Form Register -->
@endsection
