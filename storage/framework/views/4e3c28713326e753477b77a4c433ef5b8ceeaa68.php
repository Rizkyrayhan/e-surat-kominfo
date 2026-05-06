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

                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium small">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-person"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name')); ?>" placeholder="Contoh: Budi Santoso" required autofocus>
                        </div>
                        <?php $__errorArgs = ['name'];
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

                    <div class="mb-3">
                        <label for="role" class="form-label fw-medium small">Peran User (Role)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-building"></i></span>
                            <select class="form-select border-start-0 ps-0 <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="role" name="role" required>
                                <option value="opd" <?php echo e(old('role') == 'opd' ? 'selected' : ''); ?>>OPD (Organisasi Perangkat Daerah)</option>
                                <option value="admin" <?php echo e(old('role') == 'admin' ? 'selected' : ''); ?>>Admin Kominfo</option>
                            </select>
                        </div>
                        <?php $__errorArgs = ['role'];
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

                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium small">Email Kerja</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent text-muted"><i class="bi bi-at"></i></span>
                            <input type="email" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="nama@instansi.go.id" required>
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

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="password" class="form-label fw-medium small">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control border-start-0 ps-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" placeholder="••••••••" required>
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
                        
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label fw-medium small">Konfirmasi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-transparent text-muted"><i class="bi bi-arrow-clockwise"></i></span>
                                <input type="password" class="form-control border-start-0 ps-0" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label small text-muted" for="terms" style="font-size: 0.75rem;">
                            Saya menyetujui <a href="#" class="text-primary text-decoration-none fw-semibold">Syarat & Ketentuan</a> serta kebijakan privasi penggunaan sistem E-Surat Kominfo.
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-4 d-flex justify-content-center align-items-center gap-2" style="background-color: #0A256B;">
                        Daftar Akun <i class="bi bi-arrow-right"></i>
                    </button>

                    <div class="text-center mt-3">
                        <p class="text-muted small mb-0">Sudah memiliki akun? <a href="<?php echo e(route('login')); ?>" class="text-primary text-decoration-none fw-bold" style="color: #0A256B !important;">Masuk Sekarang</a></p>
                    </div>
                </form>
                
                <div class="mt-5 pt-4 border-top d-flex justify-content-between text-muted" style="font-size: 0.7rem;">
                    <div>VER 2.4.0</div>
                    <div>&copy; 2024 KOMINFO</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\.gemini\antigravity\scratch\e-surat-kominfo\resources\views/auth/register.blade.php ENDPATH**/ ?>