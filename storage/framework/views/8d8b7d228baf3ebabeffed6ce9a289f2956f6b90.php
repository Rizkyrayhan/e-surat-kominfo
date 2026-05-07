

<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="<?php echo e(route('opd.dashboard')); ?>" class="text-muted text-decoration-none">SURAT</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">UPLOAD SURAT BARU</li>
        </ol>
    </nav>
</div>

<form action="<?php echo e(route('opd.surat.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <div class="row g-4">
        <!-- Form Fields -->
        <div class="col-lg-8">
            <div class="stat-card p-4 p-lg-5 h-100">
                <h4 class="fw-bold text-primary-blue mb-2">Detail Surat Keluar</h4>
                <p class="text-muted small mb-4">Lengkapi informasi surat dengan benar sebelum melakukan proses upload.</p>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="nomor_surat" class="form-label fw-medium small">Nomor Surat</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['nomor_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nomor_surat" name="nomor_surat" value="<?php echo e(old('nomor_surat')); ?>" placeholder="000/DISKOMINFO/2024" required>
                        <?php $__errorArgs = ['nomor_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label fw-medium small">Tanggal Surat</label>
                        <input type="date" class="form-control <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tanggal" name="tanggal" value="<?php echo e(old('tanggal')); ?>" required>
                        <?php $__errorArgs = ['tanggal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="tujuan" class="form-label fw-medium small">Tujuan</label>
                    <select class="form-select <?php $__errorArgs = ['tujuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tujuan" name="tujuan" required>
                        <option value="" selected disabled>Pilih Instansi Tujuan</option>
                        <option value="Kementerian Kominfo" <?php echo e(old('tujuan') == 'Kementerian Kominfo' ? 'selected' : ''); ?>>Kementerian Kominfo</option>
                        <option value="Sekretariat Daerah" <?php echo e(old('tujuan') == 'Sekretariat Daerah' ? 'selected' : ''); ?>>Sekretariat Daerah</option>
                        <option value="Badan Kepegawaian Daerah" <?php echo e(old('tujuan') == 'Badan Kepegawaian Daerah' ? 'selected' : ''); ?>>Badan Kepegawaian Daerah</option>
                    </select>
                    <?php $__errorArgs = ['tujuan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-medium small">Keterangan / Perihal</label>
                    <textarea class="form-control <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="keterangan" name="keterangan" rows="4" placeholder="Tuliskan ringkasan isi surat di sini..."><?php echo e(old('keterangan')); ?></textarea>
                    <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- File Upload -->
        <div class="col-lg-4">
            <div class="stat-card p-4 h-100 d-flex flex-column">
                <h5 class="fw-bold text-primary-blue mb-4">Lampiran Dokumen</h5>
                
                <div class="upload-area flex-grow-1 d-flex flex-column justify-content-center align-items-center mb-4 position-relative">
                    <input type="file" name="file" id="file" class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" accept=".pdf" required style="cursor: pointer;">
                    <div class="icon-box bg-white text-primary-blue rounded-circle shadow-sm mb-3" style="width: 64px; height: 64px; font-size: 2rem;">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <h6 class="fw-bold text-primary-blue mb-1">Seret File PDF ke Sini</h6>
                    <p class="text-muted small mb-3">Maksimal ukuran file 10MB.<br>Format wajib .PDF</p>
                    <button type="button" class="btn btn-outline-secondary btn-sm bg-white rounded-pill px-4 fw-medium">Pilih File</button>
                    
                    <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-danger small mt-2 w-100 position-relative z-3"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 d-flex justify-content-center align-items-center gap-2 fw-semibold" style="background-color: #0A256B;">
                    <i class="bi bi-send"></i> Upload Surat
                </button>
            </div>
        </div>
    </div>
</form>

<div class="row mt-5 g-4">
    <div class="col-lg-8">
        <h5 class="fw-bold text-primary-blue mb-4">Riwayat Terakhir</h5>
        <div class="row g-3">
            <!-- Sample History Cards based on UI -->
            <div class="col-md-6">
                <div class="stat-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-success bg-opacity-10 text-success rounded-1 px-2 py-1 small fw-bold">BERHASIL</span>
                        <span class="text-muted small">Hari ini, 09:20</span>
                    </div>
                    <h6 class="fw-bold text-primary-blue mb-2">021/UND/KOMINFO/2024</h6>
                    <p class="text-muted small text-truncate mb-3">Undangan Rapat Koordinasi...</p>
                    <div class="d-flex align-items-center text-muted small border-top pt-3">
                        <i class="bi bi-person me-2"></i> Oleh: Budiman
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="badge bg-warning bg-opacity-10 text-warning rounded-1 px-2 py-1 small fw-bold" style="color: #D97706 !important;">PROSES</span>
                        <span class="text-muted small">Kemarin, 14:15</span>
                    </div>
                    <h6 class="fw-bold text-primary-blue mb-2">019/SP/KOMINFO/2024</h6>
                    <p class="text-muted small text-truncate mb-3">Surat Perintah Perjalanan Dinas...</p>
                    <div class="d-flex align-items-center text-muted small border-top pt-3">
                        <i class="bi bi-person me-2"></i> Oleh: Siti Aminah
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="bg-success bg-opacity-10 border border-success border-opacity-25 rounded-3 p-3 mb-3 d-flex align-items-start gap-3">
            <i class="bi bi-shield-check text-success fs-4"></i>
            <div>
                <h6 class="fw-bold text-success mb-1">Transmisi Aman</h6>
                <p class="text-success text-opacity-75 small mb-0">Dokumen akan dienkripsi secara otomatis sebelum disimpan ke database pusat.</p>
            </div>
        </div>
        
        <div class="bg-primary-blue text-white rounded-3 p-4 position-relative overflow-hidden">
            <h5 class="fw-bold mb-3">Status Server Aktif</h5>
            <p class="opacity-75 small mb-4">Node penyimpanan cloud sinkron dan aman digunakan untuk upload masal.</p>
            <div class="d-flex gap-2">
                <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 text-white small"><span class="badge bg-success rounded-circle p-1 me-2 d-inline-block"></span>CLOUD-01</span>
                <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 text-white small"><span class="badge bg-success rounded-circle p-1 me-2 d-inline-block"></span>DB-MASTER</span>
            </div>
            <!-- Abstract server illustration -->
            <i class="bi bi-server position-absolute opacity-25" style="font-size: 8rem; right: -1rem; bottom: -2rem;"></i>
        </div>
    </div>
</div>

<script>
    // Simple script to update file name on selection
    document.getElementById('file').addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            let fileName = e.target.files[0].name;
            e.target.parentElement.querySelector('h6').textContent = fileName;
            e.target.parentElement.querySelector('p').textContent = "File siap diupload";
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\e-surat-kominfo\resources\views/opd/upload.blade.php ENDPATH**/ ?>