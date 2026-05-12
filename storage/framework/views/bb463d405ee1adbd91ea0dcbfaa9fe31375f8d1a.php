<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Surat Masuk Kominfo</h3>
        <p class="text-muted mb-0">Daftar surat resmi yang masuk dari Dinas Kominfo.</p>
    </div>
</div>

<div class="table-card mb-5">
    <div class="p-4 border-bottom">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Surat Masuk</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4">NOMOR SURAT</th>
                    <th scope="col">PENGIRIM</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">PERIHAL</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $surats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="ps-4 fw-bold text-primary-blue" style="font-size: 0.9rem;"><?php echo e($surat->nomor_surat); ?></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary bg-opacity-10 text-primary rounded-1 px-2 py-1 small fw-bold me-2">KOMINFO</span>
                            <span class="text-dark fw-medium" style="font-size: 0.9rem;"><?php echo e($surat->pengirim->name); ?></span>
                        </div>
                    </td>
                    <td class="text-muted" style="font-size: 0.9rem;"><?php echo e($surat->tanggal->format('d M Y')); ?></td>
                    <td style="font-size: 0.9rem; max-width: 300px;" class="text-truncate"><?php echo e($surat->perihal); ?></td>
                    <td class="pe-4 text-end">
                        <a href="<?php echo e(route('opd.surat-masuk.show', $surat->id)); ?>" class="btn btn-sm btn-info text-white rounded-pill px-3" style="font-size: 0.8rem;">
                            <i class="bi bi-eye me-1"></i> Detail
                        </a>
                        <a href="<?php echo e(asset('storage/' . $surat->file)); ?>" download class="btn btn-sm btn-light text-muted rounded-circle ms-1" title="Download PDF">
                            <i class="bi bi-download"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada surat masuk dari Kominfo.</td>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\e-surat-kominfo\resources\views/opd/surat-masuk/index.blade.php ENDPATH**/ ?>