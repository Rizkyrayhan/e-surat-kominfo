

<?php $__env->startSection('content'); ?>
<style>
    /* Reset & Base */
    html, body {
        overflow-y: auto !important;
        overflow-x: hidden !important;
        height: auto !important;
    }
    #wrapper {
        display: block !important;
        height: auto !important;
        overflow-y: visible !important;
    }
    #page-content-wrapper {
        padding: 0 !important;
        background-color: #f8fafc;
        margin-left: 0 !important;
        height: auto !important;
        overflow-y: visible !important;
    }
    .content-area {
        padding: 0 !important;
        max-width: 100% !important;
        margin: 0;
        height: auto !important;
        overflow-y: visible !important;
    }
    
    /* Hide Default Layout Elements */
    #sidebar-wrapper, #menu-toggle, nav.navbar:not(.landing-nav) { display: none !important; }

    /* Custom Variables */
    :root {
        --color-dark-blue: #0A1930;
        --color-primary: #1D4ED8;
        --color-light-blue: #EFF6FF;
        --color-text-main: #1E293B;
        --color-text-muted: #64748B;
        --color-bg-light: #F8FAFC;
    }

    body { font-family: 'Inter', sans-serif; color: var(--color-text-main); }

    /* Utilities */
    .bg-dark-blue { background-color: var(--color-dark-blue); }
    .text-dark-blue { color: var(--color-dark-blue); }
    .bg-light-gray { background-color: var(--color-bg-light); }
    
    .btn-dark-blue {
        background-color: var(--color-dark-blue);
        color: white;
        border: none;
    }
    .btn-dark-blue:hover {
        background-color: #112648;
        color: white;
    }
    
    .btn-outline-gray {
        border: 1px solid #E2E8F0;
        color: var(--color-text-main);
        background-color: white;
    }
    .btn-outline-gray:hover {
        background-color: #F1F5F9;
    }

    /* Patterns */
    .bg-dots {
        background-color: #f8fafc;
        background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
        background-size: 20px 20px;
    }

    /* Navbar */
    .landing-nav {
        background-color: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border-bottom: 1px solid #E2E8F0;
    }
    .nav-link-custom {
        color: var(--color-text-muted);
        font-weight: 500;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        transition: all 0.2s;
    }
    .nav-link-custom:hover { color: var(--color-dark-blue); }
    .nav-link-custom.active {
        color: var(--color-primary);
        position: relative;
    }
    .nav-link-custom.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 1rem;
        right: 1rem;
        height: 2px;
        background-color: var(--color-primary);
    }

    /* Hero */
    .hero-image-wrapper {
        position: relative;
        border-radius: 1rem;
        padding: 8px;
        background: white;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .hero-image {
        width: 100%;
        height: auto;
        border-radius: 0.75rem;
        object-fit: cover;
        aspect-ratio: 1/1;
    }
    .floating-card {
        position: absolute;
        bottom: -20px;
        left: -20px;
        background: white;
        border-radius: 0.75rem;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border: 1px solid #E2E8F0;
        z-index: 2;
    }

    /* Timeline */
    .timeline-container {
        position: relative;
        padding-top: 2rem;
    }
    .timeline-line {
        position: absolute;
        top: 3.5rem;
        left: 0;
        right: 0;
        height: 1px;
        background-image: linear-gradient(to right, #CBD5E1 50%, transparent 50%);
        background-size: 10px 1px;
        z-index: 1;
    }
    .timeline-step {
        position: relative;
        z-index: 2;
    }
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        margin-bottom: 1.5rem;
        background-color: #E2E8F0;
        color: var(--color-text-muted);
    }
    .step-number.active {
        background-color: var(--color-dark-blue);
        color: white;
    }

    /* Cards & Icons */
    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: var(--color-light-blue);
        color: var(--color-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
    }

    /* CTA Section */
    .cta-card {
        background: linear-gradient(135deg, #0f2042 0%, #173875 100%);
    }
    
    @media (max-width: 991.98px) {
        .timeline-line { display: none; }
        .timeline-step { margin-bottom: 2rem; }
        .hero-image-wrapper { margin-top: 3rem; }
        .floating-card { left: 10px; bottom: 10px; }
        
        /* Mobile Navbar - Floating Card Style */
        .navbar-collapse {
            position: absolute;
            top: 100%;
            left: 1rem;
            right: 1rem;
            background-color: white;
            border-radius: 1rem;
            padding: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            margin-top: 0.5rem;
            border: 1px solid #E2E8F0;
        }
        .navbar-nav {
            text-align: left;
            padding: 0;
            display: flex !important;
            flex-direction: column !important;
            width: 100%;
        }
        .nav-item {
            width: 100%;
        }
        .nav-link-custom {
            display: block;
            width: 100%;
            padding: 0.85rem 1rem;
            border-bottom: none;
            color: #475569;
            font-size: 0.95rem;
        }
        .nav-link-custom:hover {
            background-color: #F8FAFC;
            border-radius: 0.5rem;
        }
        .nav-link-custom.active::after {
            display: none;
        }
        .nav-link-custom.active {
            font-weight: 600;
            color: var(--color-dark-blue);
        }
        .navbar-collapse .d-flex {
            margin-top: 1rem !important;
            width: 100%;
            display: flex !important;
            flex-direction: column !important;
        }
        .navbar-collapse .d-flex .btn,
        .navbar-collapse .d-flex a:not(.nav-link-custom) {
            width: 100%;
            padding: 0.8rem !important;
            text-align: center;
            background-color: var(--color-dark-blue);
            color: white !important;
            border-radius: 0.5rem !important;
            display: block;
        }
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light landing-nav fixed-top">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand fw-bold text-dark-blue d-flex align-items-center gap-2" href="/">
            <!-- If the user wants text only as in design, we use text. We can keep a small logo if needed, but design shows text "E-Surat Kominfo" -->
            E-Surat Diskominfo
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#landingNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="landingNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link-custom active text-decoration-none" href="#">Fitur</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom text-decoration-none" href="#cara-kerja">Cara Kerja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom text-decoration-none" href="#">Bantuan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link-custom text-decoration-none" href="#kontak">Kontak</a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center gap-3 mt-3 mt-lg-0">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(Auth::user()->role === 'admin' ? route('admin.dashboard') : route('opd.dashboard')); ?>" class="text-decoration-none text-dark-blue fw-medium px-2" style="font-size: 0.9rem;">
                        Dashboard
                    </a>
                <?php else: ?>

                    <a href="<?php echo e(route('login')); ?>" class="btn btn-dark-blue rounded-3 px-4 fw-medium" style="font-size: 0.9rem;">
                        Masuk
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="bg-dots pt-5 pb-5" style="margin-top: 60px; min-height: 90vh; display: flex; align-items: center;">
    <div class="container-fluid px-4 px-lg-5 py-4">
        <div class="row align-items-center">
            <!-- Left Content -->
            <div class="col-lg-6 pe-lg-5">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill mb-4" style="background-color: #E0E7FF; color: #3730A3; font-size: 0.8rem; font-weight: 600;">
                    <i class="bi bi-shield-check"></i> Resmi Dinas Kominfo Kota Bandar Lampung
                </div>
                
                <h1 class="text-dark-blue fw-bold mb-4" style="font-size: clamp(2.5rem, 4vw, 3.5rem); line-height: 1.15;">
                    Transformasi Digital Tata Kelola Persuratan Kominfo
                </h1>
                
                <p class="mb-5" style="color: #475569; font-size: 1.1rem; line-height: 1.7; max-width: 90%;">
                    Sistem manajemen surat internal yang aman, efisien, dan terintegrasi untuk mendukung birokrasi yang lebih lincah.
                </p>
                
                <div class="d-flex flex-wrap gap-3">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(Auth::user()->role === 'admin' ? route('admin.surat-keluar.create') : route('opd.surat.create')); ?>" class="btn btn-dark-blue rounded-3 px-4 py-2 fw-medium">
                            Kirim Surat
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-dark-blue rounded-3 px-4 py-2 fw-medium">
                            Mulai Sekarang
                        </a>
                    <?php endif; ?>
                    <a href="#informasi" class="btn btn-outline-gray rounded-3 px-4 py-2 fw-medium">
                        Pelajari Selengkapnya
                    </a>
                </div>
            </div>
            
            <!-- Right Content (Image) -->
            <div class="col-lg-6 mt-5 mt-lg-0">
                <div class="hero-image-wrapper">
                    <img src="<?php echo e(asset('images/kominfo-building.jpg')); ?>" alt="Ilustrasi Persuratan" class="hero-image">
                    
                    <div class="floating-card">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-envelope-check"></i>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Features Section -->
<section id="informasi" class="bg-light-gray py-5">
    <div class="container-fluid px-4 px-lg-5 py-5">
        <div class="text-center mb-5 pb-3">
            <h2 class="text-dark-blue fw-bold mb-3">Keunggulan E-Surat</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">
                Kami menghadirkan infrastruktur persuratan digital tercanggih untuk menjamin kelancaran administrasi pemerintahan.
            </p>
        </div>
        
        <div class="row g-5">
            <div class="col-md-4">
                <div class="pe-lg-4">
                    <div class="icon-wrapper">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <h5 class="text-dark-blue fw-bold mb-3">Keamanan Terjamin</h5>
                    <p class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                        Enkripsi data standar militer untuk perlindungan dokumen sensitif dari akses yang tidak sah.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="pe-lg-4">
                    <div class="icon-wrapper">
                        <i class="bi bi-lightning-charge fs-4"></i>
                    </div>
                    <h5 class="text-dark-blue fw-bold mb-3">Efisiensi Tinggi</h5>
                    <p class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                        Percepat proses administrasi dan disposisi surat secara real-time antar unit kerja di seluruh Indonesia.
                    </p>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="pe-lg-4">
                    <div class="icon-wrapper">
                        <i class="bi bi-diagram-3 fs-4"></i>
                    </div>
                    <h5 class="text-dark-blue fw-bold mb-3">Terintegrasi</h5>
                    <p class="text-muted" style="font-size: 0.9rem; line-height: 1.6;">
                        Terhubung langsung dengan Tanda Tangan Elektronik (TTE) Nasional untuk legalitas dokumen hukum.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="cara-kerja" class="bg-white py-5">
    <div class="container-fluid px-4 px-lg-5 py-5">
        <div class="row align-items-center mb-5 pb-4">
            <div class="col-lg-8">
                <h2 class="text-dark-blue fw-bold mb-3">Cara Kerja</h2>
                <p class="text-muted mb-0" style="max-width: 500px;">
                    Alur kerja yang sederhana dan intuitif dirancang khusus untuk meningkatkan produktivitas tim Anda.
                </p>
            </div>
            
        </div>
        
        <div class="timeline-container">
            <div class="timeline-line"></div>
            
            <div class="row g-4 position-relative z-2">
                <div class="col-lg-3 col-md-6 timeline-step">
                    <div class="step-number active">1</div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-box-arrow-in-right text-muted small"></i>
                        <span class="text-muted fw-semibold small" style="letter-spacing: 1px; font-size: 0.75rem;">LOGIN/DAFTAR</span>
                    </div>
                    <h6 class="fw-bold text-dark-blue mb-2">Akses Sistem</h6>
                    <p class="text-muted small lh-lg mb-0">Masuk menggunakan akun SSO Kominfo atau daftar untuk unit baru melalui portal resmi.</p>
                </div>
                
                <div class="col-lg-3 col-md-6 timeline-step">
                    <div class="step-number">2</div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-file-earmark-arrow-up text-muted small"></i>
                        <span class="text-muted fw-semibold small" style="letter-spacing: 1px; font-size: 0.75rem;">UNGGAH DOKUMEN</span>
                    </div>
                    <h6 class="fw-bold text-dark-blue mb-2">Input Surat</h6>
                    <p class="text-muted small lh-lg mb-0">Lampirkan surat digital dalam format PDF yang aman dan terenkripsi secara otomatis.</p>
                </div>
                
                <div class="col-lg-3 col-md-6 timeline-step">
                    <div class="step-number">3</div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-gear-wide-connected text-muted small"></i>
                        <span class="text-muted fw-semibold small" style="letter-spacing: 1px; font-size: 0.75rem;">VERIFIKASI</span>
                    </div>
                    <h6 class="fw-bold text-dark-blue mb-2">Proses Disposisi</h6>
                    <p class="text-muted small lh-lg mb-0">Alur persetujuan dan verifikasi bertingkat yang transparan dan dapat dilacak real-time.</p>
                </div>
                
                <div class="col-lg-3 col-md-6 timeline-step">
                    <div class="step-number">4</div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-check2-circle text-muted small"></i>
                        <span class="text-muted fw-semibold small" style="letter-spacing: 1px; font-size: 0.75rem;">SELESAI</span>
                    </div>
                    <h6 class="fw-bold text-dark-blue mb-2">Penerbitan TTE</h6>
                    <p class="text-muted small lh-lg mb-0">Dokumen resmi diterbitkan dengan Tanda Tangan Elektronik yang sah dan legalitas hukum.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="kontak" class="bg-light-gray py-5">
    <div class="container-fluid px-4 px-lg-5 py-5">
        <div class="text-center mb-5 pb-3">
            <h2 class="text-dark-blue fw-bold mb-3">Kontak Kami</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">
                Tim dukungan kami selalu siap membantu. Silakan hubungi kami jika Anda memiliki pertanyaan atau kendala seputar penggunaan sistem E-Surat.
            </p>
        </div>

        <div class="row g-5 justify-content-center">
            <!-- Contact Info -->
            <div class="col-lg-6 col-md-8">
                <div class="bg-white p-4 p-lg-5 rounded-4 shadow-sm h-100 border border-light-subtle">
                    <h4 class="fw-bold text-dark-blue mb-4">Informasi Kontak</h4>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="icon-wrapper" style="width: 45px; height: 45px; min-width: 45px;">
                            <i class="bi bi-geo-alt fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark-blue mb-1">Alamat Kantor</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">Jl. Dr.Susilo No.2 Bandar Lampung, Kota Bandar Lampung</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start gap-3 mb-4">
                        <div class="icon-wrapper" style="width: 45px; height: 45px; min-width: 45px;">
                            <i class="bi bi-telephone fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark-blue mb-1">Telepon & Fax</h6>
                            <p class="text-muted small mb-0">(0721) 481301</p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start gap-3">
                        <div class="icon-wrapper" style="width: 45px; height: 45px; min-width: 45px;">
                            <i class="bi bi-envelope fs-5"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-dark-blue mb-1">Email Dukungan</h6>
                            <p class="text-muted small mb-0">diskominfo@bandarlampungkota.go.id</p>
                        </div>
                    </div>
                </div>
            </div>
            
           
            
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="py-5" style="background-color: #1a1f2e; color: #94a3b8;">
    <div class="container-fluid px-4 px-lg-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h5 class="text-white fw-bold mb-2">E-Surat Diskominfo kota Bandar Lampung</h5>
                <p class="small mb-0 opacity-75">
                    &copy; <?php echo e(date('Y')); ?> Kementerian Komunikasi dan Informatika RI. Hak Cipta Dilindungi Undang-Undang.
                </p>
            </div>
            <div class="col-md-6">
                <div class="d-flex flex-wrap justify-content-md-end gap-3 gap-md-4">
                    <a href="#" class="text-decoration-none" style="color: #94a3b8; font-size: 0.85rem;">Kebijakan Privasi</a>
                    <a href="#" class="text-decoration-none" style="color: #94a3b8; font-size: 0.85rem;">Syarat & Ketentuan</a>
                    <a href="#" class="text-decoration-none" style="color: #94a3b8; font-size: 0.85rem;">Panduan Pengguna</a>
                    <a href="#" class="text-decoration-none" style="color: #94a3b8; font-size: 0.85rem;">Layanan Pengaduan</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-kominfo\resources\views/landing.blade.php ENDPATH**/ ?>