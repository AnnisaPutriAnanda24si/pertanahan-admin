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

    <style>
        body {
            background-image: url('{{ Storage::url('placeholders/sawah.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg overflow-hidden" style="max-width: 900px;">
        <div class="row g-0">
            <!-- Kolom Kiri: Logo & Slideshow -->
            <div
                class="col-lg-5 d-none d-lg-flex flex-column justify-content-center align-items-center p-5 bg-dark text-white">
                <div class="text-center w-100">
                    <!-- Logo Bina Desa -->
                    <div class="mb-4">
                        <div class="d-flex flex-column align-items-center">
                            <img src="{{ asset('assets/img/land.png') }}" alt="Logo" class="mb-3" height="80">
                            <h2 class="fw-bold mb-1">Manajemen Persil</h2>
                            <small class="text-white-50">Sistem Informasi Pertanahan</small>
                        </div>
                    </div>

                    {{-- Bootstrap Carousel --}}
                    <div id="loginCarousel" class="carousel slide mb-3" data-bs-ride="carousel"
                        style="width: 300px; margin: 0 auto;">
                        <div class="carousel-inner rounded-3">
                            <!-- Slide 1 -->
                            <div class="carousel-item active">
                                <img src="{{ Storage::url('placeholders/BPNPekanbaru.jpg') }}" class="d-block w-100"
                                    alt="Gambar 1" style="height: 200px; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='https://placehold.co/300x200/ffffff/000000?text=Gambar+1'">
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item">
                                <img src="{{ Storage::url('placeholders/sawah.jpg') }}" class="d-block w-100"
                                    alt="Gambar 2" style="height: 200px; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='https://placehold.co/300x200/ffffff/000000?text=Gambar+2'">
                            </div>
                            <!-- Slide 3 -->
                            <div class="carousel-item">
                                <img src="{{ Storage::url('placeholders/orang.jpg') }}" class="d-block w-100"
                                    alt="Gambar 3" style="height: 200px; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='https://placehold.co/300x200/ffffff/000000?text=Gambar+3'">
                            </div>
                            <!-- Slide 4 -->
                            <div class="carousel-item">
                                <img src="{{ Storage::url('placeholders/bendera.jpg') }}" class="d-block w-100"
                                    alt="Gambar 4" style="height: 200px; object-fit: cover;"
                                    onerror="this.onerror=null; this.src='https://placehold.co/300x200/ffffff/000000?text=Gambar+4'">
                            </div>
                        </div>
                        <!-- Optional controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#loginCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#loginCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    {{-- Deskripsi --}}
                    <p class="mt-3 mb-0 fs-6">
                        Kelola data Warga dan Tanah dengan antarmuka yang modern, cepat, dan responsif
                    </p>
                </div>
            </div>
            <!-- End Kolom Kiri -->

            <!-- Kolom Kanan: Form Login -->
            @yield('content')
            <!-- End Kolom Kanan -->
        </div>
    </div>

    {{-- Start JS --}}
    @include('layouts.admin.js')
    {{-- End JS --}}
</body>

</html>
