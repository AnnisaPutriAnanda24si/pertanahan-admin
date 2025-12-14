<footer class="footer py-3 border-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Kiri: Info Website -->
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <img src="{{ asset('assets/img/logo-kecil.png') }}" alt="Logo" style="height: 30px;"
                        onerror="this.style.display='none'">
                </div>
                <div>
                    <span class="text-muted">
                        <strong>Sistem Informasi Pertanahan</strong>
                        &copy; {{ date('Y') }} Bina Desa
                    </span>
                </div>
            </div>

            <!-- Tengah: Version Info -->
            <div class="d-flex align-items-center mx-4">
                <small class="text-muted">
                    <i class="fas fa-code-branch me-1"></i> v1.0.0
                    <span class="mx-2">•</span>
                    <i class="fas fa-server me-1"></i>
                    <span class="badge bg-success">
                        <i class="fas fa-circle me-1"></i> Online
                    </span>
                </small>
            </div>

            <!-- Kanan: Icon Links -->
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center gap-4">
                    <a class="text-muted d-flex align-items-center" href="{{ route('about') }}" title="Tentang">
                        <i class="fas fa-info-circle fa-lg"></i>
                    </a>
                    <a class="text-muted d-flex align-items-center" href="{{ route('aboutme') }}"
                        title="Kontak Pengembang">
                        <i class="fas fa-question-circle fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- <div class="copyright">
                        2024, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="http://www.themekita.com">ThemeKita</a>
                    </div> --}}
{{-- <div>
                        Distributed by
                        <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
                    </div> --}}
