

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Dashboard Utama</h3>
    <p class="text-muted mb-0">Selamat datang di Sistem Informasi Pengelolaan Surat Kominfo.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Total Surat Masuk</h6>
                    <h2 class="fw-bold mb-0 text-dark"><?php echo e(number_format($stats['total'])); ?></h2>
                </div>
                <div class="icon-box icon-box-primary">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-2 py-1 small fw-medium">
                    <i class="bi bi-graph-up-arrow"></i> 12% dari bulan lalu
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card border-warning p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Menunggu Verifikasi</h6>
                    <h2 class="fw-bold mb-0" style="color: #D97706;"><?php echo e(number_format($stats['pending'])); ?></h2>
                </div>
                <div class="icon-box icon-box-warning">
                    <i class="bi bi-clipboard-check"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-2 py-1 small fw-medium" style="color: #D97706 !important;">
                    <i class="bi bi-clock"></i> Perlu segera diproses
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card border-primary p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Sudah Terverifikasi</h6>
                    <h2 class="fw-bold mb-0 text-primary"><?php echo e(number_format($stats['selesai'])); ?></h2>
                </div>
                <div class="icon-box icon-box-info bg-opacity-10 text-primary">
                    <i class="bi bi-check2-all"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-2 py-1 small fw-medium">
                    <i class="bi bi-check-circle"></i> 98% efisiensi sistem
                </span>
            </div>
        </div>
    </div>
</div>

<div class="table-card mb-4">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center p-4 border-bottom gap-3">
        <div>
            <h5 class="fw-bold mb-1 text-primary-blue">Daftar Surat Masuk Terkini</h5>
            <p class="text-muted small mb-0">Menampilkan 10 surat masuk terbaru yang membutuhkan perhatian.</p>
        </div>
        <div class="d-flex flex-column flex-md-row gap-2">

            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 d-flex align-items-center justify-content-center gap-1 btn-responsive"><i class="bi bi-filter"></i> Filter</button>
            <button class="btn btn-primary btn-sm rounded-pill px-3 d-flex align-items-center justify-content-center gap-1 btn-responsive" style="background-color: #0A256B;"><i class="bi bi-plus-lg"></i> Input Surat Baru</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>

                    <th scope="col">NO. AGENDA</th>
                    <th scope="col">PERIHAL & PENGIRIM</th>
                    <th scope="col">TANGGAL DITERIMA</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $surats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="surat-row-<?php echo e($surat->id); ?>">

                    <td class="fw-bold text-primary-blue" style="font-size: 0.9rem;">SK - <?php echo e(date('Y')); ?> - <?php echo e(str_pad($surat->id, 3, '0', STR_PAD_LEFT)); ?></td>
                    <td>
                        <div class="fw-bold text-dark" style="font-size: 0.95rem;"><?php echo e($surat->keterangan ?? 'Perihal tidak diisi'); ?></div>
                        <div class="text-muted small"><?php echo e($surat->user->name); ?></div>
                    </td>
                    <td class="text-muted" style="font-size: 0.9rem;"><?php echo e($surat->created_at->format('d M Y, H:i')); ?></td>
                    <td>
                        <?php if($surat->status === 'pending'): ?>
                            <span class="badge-pending">Pending</span>
                        <?php elseif($surat->status === 'diproses'): ?>
                            <span class="badge-diproses">Verified</span>
                        <?php elseif($surat->status === 'dikirim'): ?>
                            <span class="badge-dikirim">Diteruskan</span>
                        <?php elseif($surat->status === 'selesai'): ?>
                            <span class="badge-selesai">Selesai</span>
                        <?php endif; ?>
                    </td>
                    <td class="pe-4 text-end">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo e(route('admin.surat.show', $surat->id)); ?>" class="btn btn-sm btn-light text-muted rounded-circle" title="Verifikasi"><i class="bi bi-shield-check"></i></a>
                            <a href="#" class="btn btn-sm btn-light text-muted rounded-circle" title="Print"><i class="bi bi-printer"></i></a>
                            <a href="#" class="btn btn-sm btn-light text-muted rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada surat masuk.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($surats->hasPages()): ?>
    <div class="p-3 border-top d-flex justify-content-between align-items-center bg-light bg-opacity-50">
        <div class="text-muted small">Menampilkan <?php echo e($surats->firstItem()); ?>-<?php echo e($surats->lastItem()); ?> dari <?php echo e($surats->total()); ?> surat</div>
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?php echo e($surats->onFirstPage() ? 'disabled' : ''); ?>">
                    <a class="page-link text-muted" href="<?php echo e($surats->previousPageUrl()); ?>"><i class="bi bi-chevron-left"></i></a>
                </li>
                <!-- Pagination elements would go here, simplified for display -->
                <li class="page-item active"><a class="page-link bg-primary-blue border-primary-blue" href="#">1</a></li>
                <li class="page-item"><a class="page-link text-muted" href="#">2</a></li>
                <li class="page-item"><a class="page-link text-muted" href="#">3</a></li>
                <li class="page-item disabled"><a class="page-link text-muted border-0 bg-transparent" href="#">...</a></li>
                <li class="page-item <?php echo e(!$surats->hasMorePages() ? 'disabled' : ''); ?>">
                    <a class="page-link text-muted" href="<?php echo e($surats->nextPageUrl()); ?>"><i class="bi bi-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-between align-items-center pt-2">
    <div class="d-flex align-items-center gap-2">
        <div class="d-flex">
            <?php $__currentLoopData = $verifikators->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($v->name)); ?>&background=random" 
                 class="rounded-circle border border-2 border-white <?php echo e($key > 0 ? 'ms-n2' : ''); ?>" 
                 width="32" height="32" style="z-index: <?php echo e(3 - $key); ?>;" title="<?php echo e($v->name); ?>">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if($verifikators->count() > 3): ?>
            <div class="rounded-circle border border-2 border-white ms-n2 bg-light d-flex align-items-center justify-content-center text-muted small" 
                 style="width: 32px; height: 32px; z-index: 0;">+<?php echo e($verifikators->count() - 3); ?></div>
            <?php endif; ?>
        </div>
        <span class="text-muted small ms-2"><?php echo e($verifikators->count()); ?> Tim Verifikator sedang aktif hari ini</span>
    </div>
    <div class="text-muted small text-uppercase" style="letter-spacing: 0.05em; font-size: 0.7rem;">
        Kementerian Komunikasi dan Informatika &copy; <?php echo e(date('Y')); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-kominfo\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>