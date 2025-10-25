<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin Dashboard</title>

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
                    <h1 class="fw-bold display-6 mb-3">Login Admin</h1>

                    <img src="https://www.henkel-gcc.com/resource/image/32556/1x1/1000/1000/64143212d44e70e6c927885764745c24/30FAE5974EBEDC298CD595B173662700/persil-logo.webp"
                        class="w-50 img-fluid rounded-3 my-4 shadow-sm" alt="Logo Persil"
                        onerror="this.onerror=null; this.src='https://placehold.co/300x200/ffffff/000000?text=LOGO+ERROR';">

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
