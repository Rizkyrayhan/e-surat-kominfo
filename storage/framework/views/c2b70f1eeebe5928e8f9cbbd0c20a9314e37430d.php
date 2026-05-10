

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>" class="text-muted text-decoration-none">DASHBOARD</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">DETAIL SURAT</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="stat-card p-4 p-lg-5 mb-4">
            <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
                <div>
                    <h4 class="fw-bold text-primary-blue mb-1">Informasi Detail Surat</h4>
                    <p class="text-muted small mb-0">Nomor Agenda: SK - <?php echo e(date('Y')); ?> - <?php echo e(str_pad($surat->id, 3, '0', STR_PAD_LEFT)); ?></p>
                </div>
                <div>
                    <?php if($surat->status === 'pending'): ?>
                        <span class="badge-pending">Pending Verifikasi</span>
                    <?php elseif($surat->status === 'diproses'): ?>
                        <span class="badge-diproses">Diproses</span>
                    <?php elseif($surat->status === 'dikirim'): ?>
                        <span class="badge-dikirim">Dikirim</span>
                    <?php elseif($surat->status === 'selesai'): ?>
                        <span class="badge-selesai">Selesai</span>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="row g-4 mb-4">
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Pengirim (OPD)</p>
                    <p class="fw-semibold text-dark mb-0"><?php echo e($surat->user->name); ?></p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Nomor Surat Asli</p>
                    <p class="fw-semibold text-dark mb-0"><?php echo e($surat->nomor_surat); ?></p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tujuan</p>
                    <p class="fw-semibold text-dark mb-0"><?php echo e($surat->tujuan); ?></p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tanggal Surat</p>
                    <p class="fw-semibold text-dark mb-0"><?php echo e($surat->tanggal->format('d F Y')); ?></p>
                </div>
                <div class="col-12">
                    <p class="text-muted small mb-1 fw-medium">Perihal / Keterangan</p>
                    <div class="p-3 bg-light rounded border">
                        <?php echo e($surat->keterangan ?? 'Tidak ada keterangan'); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card p-0 overflow-hidden">
            <div class="bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-primary-blue"><i class="bi bi-file-earmark-pdf me-2"></i>Pratinjau Dokumen</h6>
                <a href="<?php echo e(asset('storage/' . $surat->file)); ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-download me-1"></i> Unduh File</a>
            </div>
            <div class="p-4 d-flex justify-content-center bg-dark bg-opacity-10">
                <div class="bg-white border shadow-sm p-5 text-center" style="width: 100%; max-width: 600px; min-height: 500px;">
                    <!-- Placeholder for PDF Viewer -->
                    <i class="bi bi-filetype-pdf text-danger" style="font-size: 5rem;"></i>
                    <h5 class="mt-4 mb-2">Dokumen Surat.pdf</h5>
                    <p class="text-muted mb-4">Pratinjau dokumen tersedia untuk file PDF</p>
                    <embed src="<?php echo e(asset('storage/' . $surat->file)); ?>" type="application/pdf" width="100%" height="400px" />
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Update Status Card -->
        <div class="stat-card p-4 mb-4 border-primary">
            <h5 class="fw-bold text-primary-blue mb-3">Tindakan Admin</h5>
            <form action="<?php echo e(route('admin.surat.update-status', $surat->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                <div class="mb-3">
                    <label class="form-label small fw-medium text-muted">Ubah Status Dokumen</label>
                    <select name="status" class="form-select border-primary">
                        <option value="pending" <?php echo e($surat->status == 'pending' ? 'selected' : ''); ?>>Pending (Menunggu)</option>
                        <option value="diproses" <?php echo e($surat->status == 'diproses' ? 'selected' : ''); ?>>Diproses (Verifikasi)</option>
                        <option value="dikirim" <?php echo e($surat->status == 'dikirim' ? 'selected' : ''); ?>>Dikirim (Diteruskan)</option>
                        <option value="selesai" <?php echo e($surat->status == 'selesai' ? 'selected' : ''); ?>>Selesai (Arsip)</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 rounded-pill"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
            </form>
            <div class="mt-3 pt-3 border-top text-center">
                <a href="<?php echo e(route('admin.surat.print', $surat->id)); ?>" target="_blank" class="btn btn-outline-secondary w-100 rounded-pill"><i class="bi bi-printer me-2"></i> Cetak Lembar Disposisi</a>
            </div>
        </div>

        <!-- Timeline Card -->
        <div class="stat-card p-4">
            <h5 class="fw-bold text-primary-blue mb-4">Riwayat Perjalanan Surat</h5>
            <div class="position-relative ms-3 border-start border-2 border-primary border-opacity-25 pb-2">
                <!-- Timeline Item 1 -->
                <div class="position-relative mb-4 pb-2">
                    <div class="position-absolute bg-primary rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6">Surat Dikirim</h6>
                        <p class="text-muted small mb-1">Oleh <?php echo e($surat->user->name); ?></p>
                        <span class="text-primary small fw-medium"><?php echo e($surat->created_at->format('d M Y, H:i')); ?></span>
                    </div>
                </div>

                <!-- Timeline Item 2 -->
                <div class="position-relative mb-4 pb-2">
                    <div class="position-absolute <?php echo e(in_array($surat->status, ['diproses', 'dikirim', 'selesai']) ? 'bg-primary' : 'bg-light border border-2'); ?> rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 <?php echo e(in_array($surat->status, ['diproses', 'dikirim', 'selesai']) ? '' : 'text-muted'); ?>">Sedang Diproses</h6>
                        <p class="text-muted small mb-1">Verifikasi dokumen oleh Admin</p>
                    </div>
                </div>

                <!-- Timeline Item 3 -->
                <div class="position-relative mb-4 pb-2">
                    <div class="position-absolute <?php echo e(in_array($surat->status, ['dikirim', 'selesai']) ? 'bg-primary' : 'bg-light border border-2'); ?> rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 <?php echo e(in_array($surat->status, ['dikirim', 'selesai']) ? '' : 'text-muted'); ?>">Diteruskan</h6>
                        <p class="text-muted small mb-1">Disposisi ke instansi terkait</p>
                    </div>
                </div>

                <!-- Timeline Item 4 -->
                <div class="position-relative">
                    <div class="position-absolute <?php echo e($surat->status == 'selesai' ? 'bg-success' : 'bg-light border border-2'); ?> rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 <?php echo e($surat->status == 'selesai' ? 'text-success' : 'text-muted'); ?>">Selesai</h6>
                        <p class="text-muted small mb-0">Tersimpan di Arsip Digital</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\e-surat-kominfo\resources\views/admin/detail.blade.php ENDPATH**/ ?>