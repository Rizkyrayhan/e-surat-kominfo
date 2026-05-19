<?php $__env->startSection('content'); ?>
<div class="container-fluid min-vh-100 p-0">
    <div class="row g-0 min-vh-100">
        <!-- Left Side - Illustration/Info -->
        <div class="col-lg-5 d-none d-lg-flex auth-split-bg align-items-center justify-content-center p-5 text-white position-fixed h-100">
            <div class="max-w-md w-100 position-relative z-1 text-center">
                <div class="mb-4 d-flex align-items-center justify-content-center">
                    <div class="border border-white border-2 rounded p-3 d-inline-flex mb-3">
                        <i class="bi bi-envelope fs-1"></i>
                    </div>
                </div>
                
                <h3 class="mb-3 fw-bold">E-Surat Kominfo</h3>
                <p class="opacity-75 mb-5 px-4">Platform digital terpadu untuk pengelolaan administrasi persuratan internal yang aman, efisien, dan transparan.</p>
                
                <div class="d-flex gap-3 justify-content-center mt-5 text-start">
                    <div class="feature-card flex-fill">
                        <i class="bi bi-shield-check mb-2 fs-4"></i>
                        <h6 class="fw-bold mb-1">Keamanan Data</h6>
                        <small class="opacity-75" style="font-size: 0.7rem;">Enkripsi standar militer untuk setiap dokumen.</small>
                    </div>
                    <div class="feature-card flex-fill">
                        <i class="bi bi-lightning-charge mb-2 fs-4"></i>
                        <h6 class="fw-bold mb-1">Alur Cepat</h6>
                        <small class="opacity-75" style="font-size: 0.7rem;">Distribusi surat seketika antar unit kerja.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Register Form -->
        <div class="col-lg-7 offset-lg-5 d-flex align-items-center justify-content-center p-4 p-md-5 bg-white min-vh-100">
            <div class="w-100 py-4" style="max-width: 500px;">
                <div class="mb-4">
                    <h4 class="fw-bold mb-2">Buat Akun Baru</h4>
                    <p class="text-muted small">Lengkapi formulir di bawah untuk mendaftarkan diri ke sistem administrasi.</p>
                </div>

                <div class="alert alert-warning text-center p-4 rounded-3 border-warning shadow-sm">
                    <i class="bi bi-exclamation-triangle-fill fs-1 text-warning mb-3 d-block"></i>
                    <h5 class="fw-bold mb-3">Pendaftaran Publik Dinonaktifkan</h5>
                    <p class="mb-0">Akun OPD hanya dapat dibuat dan dikelola oleh Admin Kominfo.</p>
                    <hr>
                    <p class="small mb-0">Jika Anda adalah OPD dan belum memiliki akun, silakan hubungi Admin Kominfo. Jika sudah memiliki akun, silakan <a href="<?php echo e(route('login')); ?>" class="fw-bold text-decoration-none">Masuk di sini</a>.</p>
                </div>
                
                <div class="mt-5 pt-4 border-top d-flex justify-content-between text-muted" style="font-size: 0.7rem;">
                    <div>VER 2.4.0</div>
                    <div>&copy; 2024 KOMINFO</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\e-surat-kominfo\resources\views/auth/register.blade.php ENDPATH**/ ?>