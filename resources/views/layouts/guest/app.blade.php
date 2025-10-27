<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertanahan Admin</title>

    <!-- Start Css -->
    @include('layouts.admin.css')
    {{-- End Css --}}

</head>

<body class="d-flex align-items-center justify-content-center min-vh-100 bg-light">

    <div class="card shadow-lg overflow-hidden" style="max-width: 900px;">
        <div class="row g-0">

            <!-- Kolom Kiri: Logo -->
<div
    class="col-lg-5 d-none d-lg-flex flex-column justify-content-center align-items-center p-5 bg-dark text-white">
    <div class="text-center">
        <h1 class="fw-bold display-6 mb-3">Masuk Sistem</h1>

        <img src="https://sulsel.atrbpn.go.id/assets/d5b3e3aa-02f5-4b89-b4e7-85678faf6b78"
            class="img-fluid rounded-3 my-4 shadow-sm" alt="Logo Persil"
            onerror="this.onerror=null; this.src='https://placehold.co/300x200/ffffff/000000?text=LOGO+ERROR';">

        {{-- Deskripsi kecil di bawah gambar --}}
        <small class="text-white-50 d-block mb-4 fst-italic">
            Kantor ATR/BPN Sulawesi Selatan
        </small>

        <p class="mt-4 mb-0 fs-6">
            Kelola data Warga dan tanah dengan antarmuka yang modern, cepat, dan responsif.
        </p>
    </div>
</div>

            <!-- End Kolom Kiri: Logo -->

            <!-- Kolom Kanan: Form Login -->
            @yield('content')
            <!-- End Kolom Kanan: Form Login -->

        </div>
    </div>

    {{-- Start JS --}}
    @include('layouts.admin.js')
    {{-- End JS --}}
</body>

</html>
