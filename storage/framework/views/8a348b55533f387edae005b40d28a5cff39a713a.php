

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Riwayat Pengiriman Surat</h3>
    <p class="text-muted mb-0">Daftar lengkap seluruh surat yang pernah Anda kirimkan melalui sistem.</p>
</div>

<div class="table-card mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Dokumen</h5>
        <div class="input-group input-group-sm" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Cari nomor surat atau tujuan...">
            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4">NOMOR SURAT</th>
                    <th scope="col">TUJUAN</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $surats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-4 fw-bold text-primary-blue"><?php echo e($surat->nomor_surat); ?></td>
                    <td><?php echo e($surat->tujuan); ?></td>
                    <td class="text-muted"><?php echo e($surat->tanggal->format('d M Y')); ?></td>
                    <td>
                        <?php if($surat->status === 'pending'): ?>
                            <span class="badge bg-warning text-dark opacity-75">Pending</span>
                        <?php elseif($surat->status === 'diproses'): ?>
                            <span class="badge bg-primary opacity-75">Diproses</span>
                        <?php elseif($surat->status === 'selesai'): ?>
                            <span class="badge bg-success opacity-75">Selesai</span>
                        <?php else: ?>
                            <span class="badge bg-secondary opacity-75"><?php echo e($surat->status); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="pe-4 text-end">
                        <a href="<?php echo e(asset('storage/' . $surat->file)); ?>" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat surat.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($surats->hasPages()): ?>
    <div class="p-4 border-top">
        <?php echo e($surats->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-kominfo\resources\views/opd/history.blade.php ENDPATH**/ ?>