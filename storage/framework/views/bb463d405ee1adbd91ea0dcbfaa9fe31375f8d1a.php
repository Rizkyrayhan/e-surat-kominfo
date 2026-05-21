

<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Surat Masuk Kominfo</h3>
        <p class="text-muted mb-0">Daftar surat resmi yang masuk dari Dinas Kominfo.</p>
    </div>
</div>

<div class="table-card mb-5">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Surat Masuk</h5>
        <button id="btn-bulk-delete" class="btn btn-outline-danger btn-sm rounded-pill px-3 d-none align-items-center justify-content-center gap-1">
            <i class="bi bi-trash"></i> Hapus Terpilih (<span id="selected-count">0</span>)
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4" style="width: 40px;">
                        <input type="checkbox" class="form-check-input" id="check-all">
                    </th>
                    <th scope="col">NOMOR SURAT</th>
                    <th scope="col">PENGIRIM</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">PERIHAL</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $surats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="surat-row-<?php echo e($surat->id); ?>">
                    <td class="ps-4">
                        <input type="checkbox" class="form-check-input surat-checkbox" value="<?php echo e($surat->id); ?>">
                    </td>
                    <td class="fw-bold text-primary-blue" style="font-size: 0.9rem;">
                        <?php echo e($surat->nomor_surat); ?>

                        <?php if(!$surat->is_read): ?>
                            <span class="badge bg-danger rounded-pill ms-1" style="font-size: 0.65rem; padding: 0.25em 0.5em;">BARU</span>
                        <?php endif; ?>
                    </td>
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
                        <a href="<?php echo e(route('download.file', ['path' => $surat->file])); ?>" class="btn btn-sm btn-light text-muted rounded-circle ms-1" title="Download PDF">
                            <i class="bi bi-download"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada surat masuk dari Kominfo.</td>
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

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.surat-checkbox');
    const btnBulkDelete = document.getElementById('btn-bulk-delete');
    const selectedCount = document.getElementById('selected-count');

    function updateBulkDeleteButton() {
        const checkedCount = document.querySelectorAll('.surat-checkbox:checked').length;
        if (checkedCount > 0) {
            btnBulkDelete.classList.remove('d-none');
            btnBulkDelete.classList.add('d-flex');
            selectedCount.textContent = checkedCount;
        } else {
            btnBulkDelete.classList.add('d-none');
            btnBulkDelete.classList.remove('d-flex');
        }
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = checkAll.checked;
            });
            updateBulkDeleteButton();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            updateBulkDeleteButton();
            if (!this.checked) {
                checkAll.checked = false;
            } else if (document.querySelectorAll('.surat-checkbox:checked').length === checkboxes.length) {
                checkAll.checked = true;
            }
        });
    });

    if (btnBulkDelete) {
        btnBulkDelete.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus surat masuk yang dipilih?')) {
                const selectedIds = Array.from(document.querySelectorAll('.surat-checkbox:checked')).map(cb => cb.value);
                
                fetch('<?php echo e(route("opd.surat-masuk.bulk-delete")); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); 
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus surat masuk.');
                });
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\e-surat-kominfo\resources\views/opd/surat-masuk/index.blade.php ENDPATH**/ ?>