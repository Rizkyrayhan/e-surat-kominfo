<?php $__env->startSection('content'); ?>
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Riwayat Pengiriman Surat</h3>
    <p class="text-muted mb-0">Daftar lengkap seluruh surat yang pernah Anda kirimkan melalui sistem.</p>
</div>

<div class="table-card mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Dokumen</h5>
        <div class="d-flex align-items-center gap-2">
            <button id="btn-bulk-delete" class="btn btn-outline-danger btn-sm rounded-pill px-3 d-none align-items-center justify-content-center gap-1">
                <i class="bi bi-trash"></i> Hapus Terpilih (<span id="selected-count">0</span>)
            </button>
            <form action="<?php echo e(route('opd.history')); ?>" method="GET" class="input-group input-group-sm" style="max-width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nomor surat atau tujuan..." value="<?php echo e(request('search')); ?>">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4" style="width: 40px;">
                        <input type="checkbox" class="form-check-input" id="check-all">
                    </th>
                    <th scope="col">NOMOR SURAT</th>
                    <th scope="col">TUJUAN</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $surats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $surat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="surat-row-<?php echo e($surat->id); ?>">
                    <td class="ps-4">
                        <input type="checkbox" class="form-check-input surat-checkbox" value="<?php echo e($surat->id); ?>">
                    </td>
                    <td class="fw-bold text-primary-blue"><?php echo e($surat->nomor_surat); ?></td>
                    <td><?php echo e($surat->tujuan); ?></td>
                    <td class="text-muted"><?php echo e($surat->tanggal->format('d M Y')); ?></td>
                    <td>
                        <?php if($surat->trashed()): ?>
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 mb-1">Dihapus dari Dashboard</span><br>
                        <?php endif; ?>
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
            if (confirm('Apakah Anda yakin ingin menghapus surat yang dipilih secara permanen? Tindakan ini tidak dapat dibatalkan.')) {
                const selectedIds = Array.from(document.querySelectorAll('.surat-checkbox:checked')).map(cb => cb.value);
                
                fetch('<?php echo e(route("opd.surat.bulk-delete")); ?>', {
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
                    alert('Terjadi kesalahan saat menghapus surat.');
                });
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER\.gemini\antigravity\scratch\e-surat-kominfo\resources\views/opd/history.blade.php ENDPATH**/ ?>