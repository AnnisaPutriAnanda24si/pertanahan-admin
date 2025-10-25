<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Datatables - Kaiadmin Bootstrap 5 Admin Dashboard</title>
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
                        <h3 class="fw-bold mb-3">Data Jenis Penggunaan</h3>
                        <ul class="breadcrumbs mb-3">
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
                                <a href="#">Jenis Penggunaan</a>
                            </li>
                        </ul>
                    </div>
                    {{-- End page header --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- Judul tabel --}}
                                    <h4 class="card-title">Tabel Jenis Penggunaan</h4>
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
    {{-- Start JS --}}
    @include('layouts.admin.js')
    {{-- End JS --}}
</body>

</html>
