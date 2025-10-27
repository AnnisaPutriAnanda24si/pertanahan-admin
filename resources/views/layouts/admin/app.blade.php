<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pertanahan Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Start css -->
    @include('layouts.admin.css')
    {{-- End css --}}

</head>

<body>
    <div class="wrapper">
        <!-- Start sidebar -->
        @include('layouts.admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">

            {{-- Start Header --}}
            @include('layouts.admin.header')
            {{-- End Header --}}

            {{-- Start Main Content --}}
            <div class="container">
                <div class="page-inner">

                    {{-- Start Page Header --}}
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Pertanahan Admin</h3>
                        {{-- <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Data</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">#</a>
                            </li>
                        </ul> --}}
                    </div>
                    {{-- End page header --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                    {{-- Judul tabel --}}
                    <h4 class="card-title mb-0">Tabel</h4>

                    {{-- Tombol Kembali --}}
                    <a href="{{ url()->previous() }}" class="btn btn-primary btn-border btn-round">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </a>
                </div>
                                </div>
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>>
            {{-- End Main Content --}}

            {{-- Start Footer --}}
            @include('layouts.admin.footer')
            {{-- End Footer --}}

        </div>
    </div>

        {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/+6285267960839?
    text=Halo%20Admin,%20saya%20ingin%20bertanya."
       target="_blank"
       class="btn btn-success btn-lg rounded-circle shadow position-fixed bottom-0 end-0 m-4 d-flex align-items-center justify-content-center"
       title="Hubungi kami via WhatsApp"
       style="width: 55px; height: 55px;">
        <i class="fab fa-whatsapp fs-3"></i>
    </a>
    {{-- Start JS --}}
    @include('layouts.admin.js')
    {{-- End JS --}}
</body>

</html>
