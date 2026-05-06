<?php $__env->startSection('content'); ?>
<div class="container-fluid min-vh-100 p-0">
    <div class="row g-0 min-vh-100">
        <!-- Left Side - Illustration/Info -->
        <div class="col-lg-6 d-none d-lg-flex auth-split-bg align-items-center justify-content-center p-5 text-white">
            <div class="max-w-md w-100 position-relative z-1">
                <div class="mb-5 d-flex align-items-center">
                    <div class="bg-white text-primary rounded p-2 me-3 d-inline-flex">
                        <i class="bi bi-file-earmark-text fs-4"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">E-Surat</h4>
                        <small class="opacity-75">KOMINFO RI</small>
                    </div>
                </div>

                <h1 class="display-5 fw-bold mb-4">Sistem Tata Kelola<br>Persuratan Digital Terpadu</h1>
                <p class="fs-5 opacity-75 mb-5">Optimalkan alur kerja administrasi Anda dengan platform aman dan efisien untuk pengelolaan dokumen resmi kementerian.</p>

                <!-- Abstract Illustration placeholder, matching design -->
                <div class="bg-dark bg-opacity-25 rounded-4 p-4 mb-5 border border-white border-opacity-10 position-relative overflow-hidden" style="min-height: 250px;">
                    <div class="position-absolute top-50 start-50 translate-middle text-center w-100">
                        <i class="bi bi-shield-check display-1 opacity-50"></i>
                        <h5 class="mt-3 opacity-75">Keamanan Data Terjamin</h5>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex bg-white bg-opacity-10 rounded-pill p-1">
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center ms-n2 border border-primary border-2" style="width: 32px; height: 32px;">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                    </div>
                    <span class="opacity-75 small">Terintegrasi dengan TTE Nasional</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-md-5 bg-white">
            <div class="w-100" style="max-width: 450px;">
                <div class="mb-5 text-center d-lg-none">
                    <div class="bg-primary text-white rounded p-2 d-inline-flex mb-3">
                        <i class="bi bi-file-earmark-text fs-4"></i>
                    </div>
                    <h4 class="fw-bold text-primary">E-Surat Kominfo</h4>
                </div>

                <h3 class="fw-bold mb-2">Selamat Datang Kembali</h3>
                <p class="text-muted mb-4">Silakan masuk menggunakan akun kedinasan Anda untuk melanjutkan akses sistem.</p>

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-medium small">Alamat Email Pegawai</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="nama.pegawai@kominfo.go.id" required autofocus>
                        </div>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label fw-medium small mb-0">Kata Sandi</label>
                            <a href="#" class="text-decoration-none small">Lupa kata sandi?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-lock"></i></span>
                            <input type="password" class="form-control border-start-0 border-end-0 ps-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder="••••••••••••" required>
                            <span class="input-group-text bg-transparent text-muted" style="cursor: pointer;"><i class="bi bi-eye"></i></span>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="text-danger small mt-1"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat saya di perangkat ini</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-4 d-flex justify-content-center align-items-center gap-2">
                        Masuk ke Dashboard <i class="bi bi-box-arrow-in-right"></i>
                    </button>

                    <div class="text-center mt-4">
                        <p class="text-muted small mb-2">Belum memiliki akses atau akun pegawai?</p>
                        <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-primary rounded-pill px-4 py-2 text-decoration-none small d-inline-flex align-items-center gap-2">
                            <i class="bi bi-person-plus"></i> Ajukan Pendaftaran Akun Baru
                        </a>
                    </div>
                </form>
                
                <div class="mt-5 pt-4 border-top d-flex justify-content-between text-muted" style="font-size: 0.75rem;">
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted text-decoration-none">Panduan Pengguna</a>
                        <a href="#" class="text-muted text-decoration-none">Kebijakan Privasi</a>
                    </div>
                    <div>&copy; <?php echo e(date('Y')); ?> Kementerian Komunikasi dan Informatika RI</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\.gemini\antigravity\scratch\e-surat-kominfo\resources\views/auth/login.blade.php ENDPATH**/ ?>