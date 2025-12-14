@extends('layouts.admin.app')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Tentang Pengembang</h3>
                <h6 class="op-7 mb-2">Profil dan Informasi Developer</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card card-round">
                    <div class="card-body">
                        <!-- Profile Header -->
                        <div class="text-center mb-5">
                            <div class="d-flex justify-content-center mb-4">
                                <div>
                                    <img src="{{ Storage::url('profile_pictures/saya.jpeg') }}" alt="Foto Pengembang"
                                        class="img-fluid rounded border border-4 border-white shadow"
                                        style="width: 150px; height: 150px; object-fit: cover;"
                                        onerror="this.src='{{ asset('assets/img/profile.jpg') }}'">
                                </div>
                            </div>
                            <h2 class="fw-bold mb-2">Annisa Putri Ananda</h2>
                            <p class="text-muted mb-0">Mahasiswa</p>
                        </div>

                        <!-- Information Grid -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-id-card fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">NIM</small>
                                        <h5 class="fw-bold mb-0 text-dark">2457301014</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-graduation-cap fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Program Studi</small>
                                        <h5 class="fw-bold mb-0 text-dark">Sistem Informasi</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-university fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Kampus</small>
                                        <h5 class="fw-bold mb-0 text-dark">Politeknik Caltex Riau</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-envelope fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Email</small>
                                        <h5 class="fw-bold mb-0 text-dark"
                                            style="word-break: break-all; font-size: 0.9rem;">annisa24si@mahasiswa.pcr.ac.id
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="mb-5">
                            <h5 class="fw-bold mb-3 text-center">Kontak & Media Sosial</h5>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="https://www.instagram.com/annisa_putri9906/" target="_blank"
                                    class="btn btn-outline-danger btn-round">
                                    <i class="fab fa-instagram me-2"></i> Instagram
                                </a>
                                <a href="https://github.com/AnnisaPutriAnanda24si" target="_blank"
                                    class="btn btn-outline-dark btn-round">
                                    <i class="fab fa-github me-2"></i> GitHub
                                </a>
                                <a href="https://www.linkedin.com/in/annisa-putri-ananda-aa3733393/" target="_blank"
                                    class="btn btn-outline-primary btn-round">
                                    <i class="fab fa-linkedin me-2"></i> LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
