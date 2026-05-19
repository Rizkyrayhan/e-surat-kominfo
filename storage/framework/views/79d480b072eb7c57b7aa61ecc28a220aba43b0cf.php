<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Akun OPD</h4>
        <p class="text-muted small mb-0">Manajemen akses dan akun pengguna OPD</p>
    </div>
    <a href="<?php echo e(route('admin.opd-accounts.create')); ?>" class="btn btn-primary bg-kominfo">
        <i class="bi bi-person-plus me-1"></i> Tambah Akun
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Instansi</th>
                        <th>Admin / PIC</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="ps-4">
                            <span class="fw-medium"><?php echo e($account->nama_instansi ?? '-'); ?></span>
                        </td>
                        <td><?php echo e($account->name); ?></td>
                        <td><?php echo e($account->email); ?></td>
                        <td>
                            <?php if($account->status_akun === 'aktif'): ?>
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Aktif</span>
                            <?php else: ?>
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <!-- Edit -->
                                <a href="<?php echo e(route('admin.opd-accounts.edit', $account)); ?>" class="btn btn-sm btn-light text-primary border" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <!-- Toggle Status -->
                                <form action="<?php echo e(route('admin.opd-accounts.toggle-status', $account)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="btn btn-sm btn-light border <?php echo e($account->status_akun === 'aktif' ? 'text-warning' : 'text-success'); ?>" title="<?php echo e($account->status_akun === 'aktif' ? 'Nonaktifkan' : 'Aktifkan'); ?>">
                                        <i class="bi <?php echo e($account->status_akun === 'aktif' ? 'bi-pause-circle' : 'bi-play-circle'); ?>"></i>
                                    </button>
                                </form>

                                <!-- Delete -->
                                <form action="<?php echo e(route('admin.opd-accounts.destroy', $account)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-light text-danger border" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada akun OPD terdaftar.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\e-surat-kominfo\resources\views/admin/opd_accounts/index.blade.php ENDPATH**/ ?>