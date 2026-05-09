<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Profil Pengguna</h3>
    <p class="text-muted mb-0">Informasi detail akun Anda dalam sistem E-Surat.</p>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="stat-card p-4 text-center mb-4">
            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=EBF4FF&color=1E3A8A&size=128" alt="Profile" class="rounded-circle mb-3 shadow-sm border border-4 border-white">
            <h4 class="fw-bold text-dark mb-1"><?php echo e($user->name); ?></h4>
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill text-uppercase small fw-bold">
                <?php echo e($user->role === 'admin' ? 'Administrator' : 'Admin OPD'); ?>

            </span>
            <hr class="my-4 opacity-50">
            <div class="text-start">
                <p class="text-muted small mb-1">Email Terdaftar</p>
                <p class="fw-medium mb-3"><?php echo e($user->email); ?></p>
                
                <p class="text-muted small mb-1">Bergabung Sejak</p>
                <p class="fw-medium mb-0"><?php echo e($user->created_at->format('d F Y')); ?></p>
            </div>
        </div>
    </div>
    
    <div class="col-lg-8">
        <div class="stat-card p-4 p-lg-5">
            <h5 class="fw-bold text-primary-blue mb-4">Pengaturan Akun</h5>
            <form>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control bg-light border-0" value="<?php echo e($user->name); ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-bold">Alamat Email</label>
                        <input type="email" class="form-control bg-light border-0" value="<?php echo e($user->email); ?>" readonly>
                    </div>
                    <div class="col-12">
                        <label class="form-label text-muted small fw-bold">Role / Peran</label>
                        <input type="text" class="form-control bg-light border-0" value="<?php echo e($user->role === 'admin' ? 'Administrator Sistem' : 'Staff Admin OPD'); ?>" readonly>
                    </div>
                </div>
                
                <div class="mt-5 p-3 bg-warning bg-opacity-10 rounded-3 border border-warning border-opacity-25">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-info-circle-fill text-warning fs-4"></i>
                        <p class="mb-0 small text-dark">Untuk melakukan perubahan data akun atau reset password, silakan hubungi tim IT Kominfo di lantai 2.</p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\e-surat-kominfo\resources\views/profile/show.blade.php ENDPATH**/ ?>