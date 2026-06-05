@extends('layouts.app')

@section('content')
<style>
    html, body {
        overflow-y: auto !important;
        overflow-x: hidden !important;
        height: auto !important;
    }
</style>

    <div class="container-fluid min-vh-100 p-0">
        <div class="row g-0 min-vh-100 flex-column flex-lg-row">
            <!-- Left Side - Illustration/Info -->
            <div class="col-12 col-lg-6 auth-split-bg d-flex align-items-center justify-content-center p-4 p-lg-5 text-white">
                <div class="max-w-md w-100 position-relative z-1">
                    <div class="mb-5 d-flex align-items-center">
                        <div class="bg-white rounded-circle p-2 me-3 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                            <img src="{{ asset('images/logo-kominfo.svg') }}" alt="Logo Kominfo" style="width: 34px; height: auto;">
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold">E-Surat</h4>
                            <small class="opacity-75">Kominfo Bandar Lampung</small>
                        </div>
                    </div>

                    <h1 class="display-6 display-lg-5 fw-bold mb-2 mb-lg-4 text-white">Sistem Tata Kelola<br>Persuratan Digital</h1>
                    <p class="fs-6 fs-lg-5 text-white opacity-75 mb-4 mb-lg-5 d-none d-md-block">Optimalkan alur kerja administrasi Anda dengan platform aman dan efisien untuk pengelolaan dokumen resmi.</p>

                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex bg-white bg-opacity-10 rounded-pill p-1">
                            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center ms-n2 border border-primary border-2 shadow-sm"
                                style="width: 32px; height: 32px;">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                        </div>
                        <span class="opacity-75 small text-white">Terintegrasi dengan databse </span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="col-12 col-lg-6 auth-form-container d-flex align-items-center justify-content-center p-4 p-md-5 bg-white flex-grow-1">
                <div class="w-100" style="max-width: 450px;">
                    <div class="mb-4 text-center d-lg-none mt-2">
                        <img src="{{ asset('images/logo-kominfo.svg') }}" alt="Logo Kominfo" class="mb-2" style="width: 40px; height: auto;">
                        <h4 class="fw-bold text-primary mb-0">E-Surat Kominfo</h4>
                    </div>

                    <h3 class="fw-bold mb-2">Selamat Datang Kembali</h3>
                    <p class="text-muted mb-4">Silakan masuk menggunakan akun kedinasan Anda untuk melanjutkan akses sistem.
                    </p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium small">Alamat Email Pegawai</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i
                                        class="bi bi-envelope"></i></span>
                                <input type="email"
                                    class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="nama.pegawai@kominfo.go.id"
                                    required autofocus>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label fw-medium small mb-0">Kata Sandi</label>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-lock"></i></span>
                                <input type="password"
                                    class="form-control border-start-0 border-end-0 ps-0 @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="••••••••••••" required>
                                <span class="input-group-text bg-transparent text-muted" style="cursor: pointer;" id="togglePassword"><i
                                        class="bi bi-eye" id="toggleIcon"></i></span>
                            </div>
                            @error('password')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label small text-muted" for="remember">Ingat saya di perangkat
                                ini</label>
                        </div>

                        <button type="submit"
                            class="btn btn-primary w-100 py-2 mb-4 d-flex justify-content-center align-items-center gap-2">
                            Masuk ke Dashboard <i class="bi bi-box-arrow-in-right"></i>
                        </button>

                        <div class="text-center mt-4 p-3 bg-light rounded-3 border border-light-subtle">
                            <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1 text-primary"></i> Lupa kata sandi? Silakan hubungi <strong>Admin Kominfo</strong> untuk bantuan.</p>
                        </div>                    </form>

                    <div class="mt-5 pt-4 border-top d-flex justify-content-between text-muted" style="font-size: 0.75rem;">
                        <div class="d-flex gap-3">
                            <a href="#" class="text-muted text-decoration-none">Panduan Pengguna</a>
                            <a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a>
                        </div>
                        <div>&copy; {{ date('Y') }} Kementerian Komunikasi dan Informatika RI</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    
                    if (type === 'password') {
                        toggleIcon.classList.remove('bi-eye-slash');
                        toggleIcon.classList.add('bi-eye');
                    } else {
                        toggleIcon.classList.remove('bi-eye');
                        toggleIcon.classList.add('bi-eye-slash');
                    }
                });
            }
        });
    </script>
    @endpush
@endsection