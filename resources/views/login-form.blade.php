@extends('layouts.guest.app')

@section('content')
    <!-- Kolom Kanan: Form Login -->
    <div class="col-lg-7 p-5">
        <h3 class="text-center mb-4 text-danger fw-bold">Login ke Akun Anda</h3>
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
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    <li>{{ session('success') }}</li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0 ps-3">
                    <li>{{ session('error') }}</li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login.auth') }}">
            @csrf

            {{-- Field Email --}}
            <div class="mb-3">
                <label for="username" class="form-label">Email</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda">
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
                    name="password" value="{{ old('password') }}" placeholder="Masukkan password Anda">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            {{-- Remember Me & Forgot Password --}}
            <div class="d-flex justify-content-between mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">
                        Ingat Saya
                    </label>
                </div>
                <a href="{{ route('regis') }}" class="text-decoration-none small">Belum punya akun?</a>
            </div>

            <!-- Diubah dari btn-primary menjadi btn-danger (merah gelap) -->
            <button type="submit" class="btn btn-danger w-100">Login</button>
        </form>
    </div>
    <!-- End Kolom Kanan: Form Login -->
@endsection
