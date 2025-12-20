{{-- resources/views/pages/about-system.blade.php --}}
@extends('layouts.admin.app')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Tentang Sistem</h3>
                <h6 class="op-7 mb-2">Informasi Detail Sistem Informasi Pertanahan</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- Informasi Umum Sistem -->
                <div class="card card-round mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Informasi Sistem</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-info-circle fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Nama Sistem</small>
                                        <h5 class="fw-bold mb-0 text-dark">Sistem Informasi Pertanahan</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-code-branch fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Versi Sistem</small>
                                        <h5 class="fw-bold mb-0 text-dark">v1.0.0</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-server fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Status</small>
                                        <h5 class="fw-bold mb-0">
                                            <span class="badge bg-success">
                                                <i class="fas fa-circle me-1"></i> Online
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-center p-3 border border-dark rounded">
                                    <div class="me-3">
                                        <i class="fas fa-calendar-alt fa-2x text-dark"></i>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">Tahun Pembuatan</small>
                                        <h5 class="fw-bold mb-0 text-dark">{{ date('Y') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi Sistem -->
                <div class="card card-round mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Deskripsi Sistem</h4>
                        <div class="p-3 border rounded">
                            <div class="p-3 border rounded">
                                <p class="mb-3">
                                    <strong>Sistem Informasi Pertanahan</strong> adalah sebuah platform digital yang
                                    dikembangkan sebagai proyek akhir mata kuliah <strong>Pemrograman Framework</strong>
                                    yang ditempuh oleh pengembang.
                                </p>
                                <p class="mb-3">
                                    Sistem ini dirancang khusus untuk mengelola data pertanahan di tingkat desa, dengan
                                    tujuan membantu pemerintah desa dalam melakukan
                                    pencatatan, monitoring, dan pelaporan data pertanahan perdesaan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fitur Utama -->
                {{-- <div class="card card-round mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Fitur Utama</h4>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card card-primary card-round h-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-database fa-3x text-primary"></i>
                                        </div>
                                        <h5 class="fw-bold">Data Master</h5>
                                        <p class="text-muted small">Pengelolaan data dasar pertanahan seperti data warga,
                                            jenis penggunaan tanah, dan informasi lain yang mendukung.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-success card-round h-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-edit fa-3x text-success"></i>
                                        </div>
                                        <h5 class="fw-bold">Form Data</h5>
                                        <p class="text-muted small">Form input data pertanahan yang lengkap dan terstruktur
                                            untuk memudahkan pengisian dan validasi data.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-info card-round h-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-table fa-3x text-info"></i>
                                        </div>
                                        <h5 class="fw-bold">Tabel Data</h5>
                                        <p class="text-muted small">Tampilan data dalam bentuk tabel dengan fitur pencarian,
                                            filter, dan pengurutan untuk analisis yang lebih mudah.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card card-warning card-round h-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-users-cog fa-3x text-warning"></i>
                                        </div>
                                        <h5 class="fw-bold">Manajemen User</h5>
                                        <p class="text-muted small">Sistem pengguna dengan level akses yang berbeda (Admin,
                                            Super Admin, Client) untuk keamanan data.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-danger card-round h-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-chart-bar fa-3x text-danger"></i>
                                        </div>
                                        <h5 class="fw-bold">Dashboard</h5>
                                        <p class="text-muted small">Tampilan dashboard dengan statistik dan grafik untuk
                                            monitoring data pertanahan secara real-time.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card card-secondary card-round h-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="fas fa-images fa-3x text-secondary"></i>
                                        </div>
                                        <h5 class="fw-bold">Media & Dokumen</h5>
                                        <p class="text-muted small">Pengelolaan media dan dokumen pendukung seperti foto
                                            tanah, sertifikat, dan dokumen legal lainnya.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Teknologi yang Digunakan -->
                <div class="card card-round mb-4">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Teknologi yang Digunakan</h4>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <i class="fab fa-laravel fa-3x text-danger mb-3"></i>
                                    <h6 class="fw-bold">Laravel 12</h6>
                                    <small class="text-muted">PHP Framework</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <i class="fab fa-bootstrap fa-3x text-primary mb-3"></i>
                                    <h6 class="fw-bold">Bootstrap</h6>
                                    <small class="text-muted">CSS Framework</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <i class="fas fa-database fa-3x text-warning mb-3"></i>
                                    <h6 class="fw-bold">MySQL</h6>
                                    <small class="text-muted">Database</small>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="text-center p-3 border rounded">
                                    <i class="fab fa-php fa-3x text-info mb-3"></i>
                                    <h6 class="fw-bold">PHP 8.4.12</h6>
                                    <small class="text-muted">Backend Language</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kontak & Dukungan -->
                {{-- <div class="card card-round">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4">Kontak & Dukungan</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <h5 class="fw-bold mb-3">Bantuan Pengguna</h5>
                                    <p class="mb-3">Untuk bantuan penggunaan sistem, panduan teknis, atau pertanyaan
                                        terkait fitur:</p>
                                    <div class="mb-2">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        <span class="text-muted">Email:</span>
                                        <strong>support@binadesa.id</strong>
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-phone me-2 text-success"></i>
                                        <span class="text-muted">Telepon:</span>
                                        <strong>(0761) 123456</strong>
                                    </div>
                                    <div>
                                        <i class="fas fa-clock me-2 text-warning"></i>
                                        <span class="text-muted">Jam Operasional:</span>
                                        <strong>Senin - Jumat, 08:00 - 17:00 WIB</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 border rounded h-100">
                                    <h5 class="fw-bold mb-3">Pengembang Sistem</h5>
                                    <p class="mb-3">Untuk laporan bug, saran pengembangan, atau kerjasama teknis:</p>
                                    <div class="mb-2">
                                        <i class="fas fa-user me-2 text-info"></i>
                                        <span class="text-muted">Nama:</span>
                                        <strong>Annisa Putri Ananda</strong>
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        <span class="text-muted">Email:</span>
                                        <strong>annisa24si@mahasiswa.pcr.ac.id</strong>
                                    </div>
                                    <div>
                                        <i class="fas fa-university me-2 text-success"></i>
                                        <span class="text-muted">Institusi:</span>
                                        <strong>Politeknik Caltex Riau</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
