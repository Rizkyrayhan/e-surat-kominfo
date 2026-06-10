@extends('layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="{{ route('opd.dashboard') }}" class="text-muted text-decoration-none">SURAT</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">UPLOAD SURAT BARU</li>
        </ol>
    </nav>
</div>

<form id="surat-form" action="{{ route('opd.surat.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <!-- Form Fields -->
        <div class="col-lg-8">
            <div class="stat-card p-4 p-lg-5 h-100">
                <h4 class="fw-bold text-primary-blue mb-2">Detail Surat Keluar</h4>
                <p class="text-muted small mb-4">Lengkapi informasi surat dengan benar sebelum melakukan proses upload.</p>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="nomor_surat" class="form-label fw-medium small">Nomor Surat</label>
                        <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="000/DISKOMINFO/2024" required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label fw-medium small">Tanggal Surat</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-medium small mb-0">Tujuan Surat <span class="text-danger">*</span></label>
                        <span class="badge bg-secondary rounded-pill" id="selected-count" style="font-size: 0.75rem; background-color: #0A256B !important;">0 Tujuan Terpilih</span>
                    </div>

                    <!-- Search Bar and Select All Controls -->
                    <div class="row g-2 mb-3 align-items-center">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" id="search-opd" class="form-control border-start-0 ps-0" placeholder="Cari nama OPD lain...">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" id="btn-select-all" class="btn btn-outline-primary btn-sm px-3 fw-semibold text-uppercase" style="font-size: 0.75rem; border-color: #0A256B; color: #0A256B; transition: all 0.2s;">Pilih Semua OPD</button>
                            <button type="button" id="btn-deselect-all" class="btn btn-outline-danger btn-sm px-3 fw-semibold text-uppercase d-none" style="font-size: 0.75rem; transition: all 0.2s;">Batal Semua OPD</button>
                        </div>
                    </div>

                    <!-- Scrollable Checkbox List -->
                    <div class="border rounded p-3 bg-white" style="max-height: 250px; overflow-y: auto; border-color: #dee2e6 !important;" id="opd-list-container">
                        @foreach($categories as $category)
                            @if($category->accounts->count() > 0 || strcasecmp($category->nama_kategori, 'Dinas') === 0)
                            <div class="category-group mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom category-header" data-bs-toggle="collapse" data-bs-target="#collapseCategory{{ $category->id }}" aria-expanded="false" style="cursor: pointer;">
                                    <h6 class="fw-bold text-primary-blue mb-0 d-flex align-items-center">
                                        <i class="bi bi-chevron-right me-2 transition-transform toggle-icon" style="font-size: 0.8rem; transition: transform 0.3s ease;"></i>
                                        <i class="bi bi-building me-2"></i>{{ $category->nama_kategori }}
                                    </h6>
                                    <div class="d-flex align-items-center gap-2" onclick="event.stopPropagation();">
                                        <span class="badge bg-light text-dark border">{{ $category->accounts->count() + (strcasecmp($category->nama_kategori, 'Dinas') === 0 ? 1 : 0) }} Akun</span>
                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-select-category" style="font-size: 0.72rem; padding: 2px 6px !important; white-space: nowrap !important; transition: all 0.2s;">Pilih Semua</button>
                                    </div>
                                </div>
                                <div class="collapse category-items" id="collapseCategory{{ $category->id }}">
                                    <div class="row g-2 pt-2">
                                        @if(strcasecmp($category->nama_kategori, 'Dinas') === 0)
                                            <div class="col-md-6 opd-item">
                                                <div class="form-check p-2 border rounded cursor-pointer d-flex align-items-center gap-2 opd-card" style="transition: all 0.2s; cursor: pointer; border-color: #e9ecef !important; background-color: #f8f9fa;">
                                                    <input class="form-check-input ms-0 opd-checkbox" type="checkbox" name="kirim_admin" id="kirim_admin" style="cursor: pointer; width: 1.15rem; height: 1.15rem; margin-top: 0;">
                                                    <label class="form-check-label small fw-semibold text-dark flex-grow-1 mb-0 cursor-pointer" for="kirim_admin" style="user-select: none;">
                                                        Dinas Komunikasi dan Informatika Bandar Lampung
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                        @foreach($category->accounts as $opd)
                                            <div class="col-md-6 opd-item">
                                                <div class="form-check p-2 border rounded cursor-pointer d-flex align-items-center gap-2 opd-card" style="transition: all 0.2s; cursor: pointer; border-color: #e9ecef !important; background-color: #f8f9fa;">
                                                    <input class="form-check-input ms-0 opd-checkbox" type="checkbox" name="tujuan_opd_ids[]" value="{{ $opd->id }}" id="opd_{{ $opd->id }}" style="cursor: pointer; width: 1.15rem; height: 1.15rem; margin-top: 0;">
                                                    <label class="form-check-label small fw-semibold text-dark flex-grow-1 mb-0 cursor-pointer" for="opd_{{ $opd->id }}" style="user-select: none;">
                                                        {{ $opd->nama_instansi ?: $opd->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    
                    @error('tujuan_opd_ids')
                        <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror

                    <style>
                        .opd-card:hover {
                            background-color: #e9ecef !important;
                            border-color: #ced4da !important;
                            transform: translateY(-1px);
                            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                        }
                        .opd-card.selected {
                            background-color: #e6f0fa !important;
                            border-color: #0A256B !important;
                            box-shadow: 0 0 0 1px #0A256B;
                        }
                        .opd-card.selected label {
                            color: #0A256B !important;
                        }
                    </style>
                </div>

                <div class="mb-4">
                    <label for="keterangan" class="form-label fw-medium small">Keterangan / Perihal</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="4" placeholder="Tuliskan ringkasan isi surat di sini...">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
                    
                    @error('file')
                        <div class="text-danger small mt-2 w-100 position-relative z-3">{{ $message }}</div>
                    @enderror
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
            @forelse($recentSurats as $surat)
            <div class="col-md-6">
                <div class="stat-card p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        @if($surat->status == 'selesai')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-1 px-2 py-1 small fw-bold">SELESAI</span>
                        @elseif($surat->status == 'diproses' || $surat->status == 'dikirim')
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-1 px-2 py-1 small fw-bold" style="color: #D97706 !important;">PROSES</span>
                        @else
                            <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-1 px-2 py-1 small fw-bold">PENDING</span>
                        @endif
                        <span class="text-muted small">{{ $surat->created_at->diffForHumans() }}</span>
                    </div>
                    <h6 class="fw-bold text-primary-blue mb-2">{{ $surat->nomor_surat }}</h6>
                    <p class="text-muted small text-truncate mb-3">{{ $surat->keterangan ?? 'Tidak ada keterangan' }}</p>
                    <div class="d-flex align-items-center text-muted small border-top pt-3">
                        <i class="bi bi-person me-2"></i> Oleh: {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="stat-card p-4 text-center text-muted">
                    Belum ada riwayat surat.
                </div>
            </div>
            @endforelse
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

    document.addEventListener('DOMContentLoaded', function() {
        // Handle collapse icon rotation
        const collapses = document.querySelectorAll('.category-items.collapse');
        collapses.forEach(collapse => {
            collapse.addEventListener('show.bs.collapse', function () {
                const icon = this.closest('.category-group').querySelector('.toggle-icon');
                if (icon) icon.style.transform = 'rotate(90deg)';
            });
            collapse.addEventListener('hide.bs.collapse', function () {
                const icon = this.closest('.category-group').querySelector('.toggle-icon');
                if (icon) icon.style.transform = 'rotate(0deg)';
            });
        });

        // Search/filter OPDs
        const searchInput = document.getElementById('search-opd');
        const categoryGroups = document.querySelectorAll('.category-group');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase().trim();
                
                categoryGroups.forEach(group => {
                    const items = group.querySelectorAll('.opd-item');
                    let hasVisibleItem = false;
                    
                    items.forEach(item => {
                        const opdName = item.querySelector('.form-check-label').textContent.toLowerCase();
                        if (opdName.includes(query)) {
                            item.classList.remove('d-none');
                            hasVisibleItem = true;
                        } else {
                            item.classList.add('d-none');
                        }
                    });
                    
                    if (hasVisibleItem) {
                        group.classList.remove('d-none');
                        if (query !== '') {
                            const collapseEl = group.querySelector('.collapse');
                            if (collapseEl && !collapseEl.classList.contains('show')) {
                                if (typeof bootstrap !== 'undefined') {
                                    bootstrap.Collapse.getOrCreateInstance(collapseEl).show();
                                }
                            }
                        }
                    } else {
                        group.classList.add('d-none');
                    }
                });
            });
        }

        // Category Select All buttons
        const btnSelectCategories = document.querySelectorAll('.btn-select-category');
        btnSelectCategories.forEach(btn => {
            btn.addEventListener('click', function() {
                const group = this.closest('.category-group');
                const checkboxes = group.querySelectorAll('.opd-checkbox');
                let allChecked = true;
                
                checkboxes.forEach(cb => {
                    const item = cb.closest('.opd-item');
                    if (!item.classList.contains('d-none') && !cb.checked) {
                        allChecked = false;
                    }
                });

                checkboxes.forEach(cb => {
                    const item = cb.closest('.opd-item');
                    if (!item.classList.contains('d-none')) {
                        cb.checked = !allChecked;
                        const card = cb.closest('.opd-card');
                        if (!allChecked) {
                            card.classList.add('selected');
                        } else {
                            card.classList.remove('selected');
                        }
                    }
                });
                
                this.textContent = allChecked ? 'Pilih Semua' : 'Batal Pilih';
                if (allChecked) {
                    this.classList.remove('btn-primary', 'text-white');
                    this.classList.add('btn-outline-secondary');
                } else {
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-primary', 'text-white');
                }
                
                updateSelectedCount();
            });
        });

        // Checkbox status styling and selected count
        const checkboxes = document.querySelectorAll('.opd-checkbox');
        const selectedCount = document.getElementById('selected-count');
        const btnSelectAll = document.getElementById('btn-select-all');
        const btnDeselectAll = document.getElementById('btn-deselect-all');

        function updateSelectedCount() {
            let count = 0;
            checkboxes.forEach(cb => {
                const card = cb.closest('.opd-card');
                if (cb.checked) {
                    count++;
                    card.classList.add('selected');
                } else {
                    card.classList.remove('selected');
                }
            });

            if (selectedCount) {
                selectedCount.textContent = `${count} Tujuan Terpilih`;
            }

            if (count > 0) {
                btnSelectAll.classList.add('d-none');
                btnDeselectAll.classList.remove('d-none');
            } else {
                btnSelectAll.classList.remove('d-none');
                btnDeselectAll.classList.add('d-none');
            }
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateSelectedCount);
            
            // Allow clicking the card container itself to toggle the checkbox
            const card = cb.closest('.opd-card');
            card.addEventListener('click', function(e) {
                if (e.target !== cb && e.target.tagName !== 'LABEL') {
                    cb.checked = !cb.checked;
                    updateSelectedCount();
                }
            });
        });

        // Select All button
        if (btnSelectAll) {
            btnSelectAll.addEventListener('click', function() {
                checkboxes.forEach(cb => {
                    // Only check visible ones (not hidden by search)
                    const item = cb.closest('.opd-item');
                    if (!item.classList.contains('d-none')) {
                        cb.checked = true;
                    }
                });
                updateSelectedCount();
            });
        }

        // Deselect All button
        if (btnDeselectAll) {
            btnDeselectAll.addEventListener('click', function() {
                checkboxes.forEach(cb => {
                    cb.checked = false;
                });
                updateSelectedCount();
            });
        }

        // Initial update
        updateSelectedCount();
    });

    // Form Submit Loading Overlay
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('surat-form');
        const loadingOverlay = document.getElementById('loading-overlay');
        if (form && loadingOverlay) {
            form.addEventListener('submit', function() {
                if (form.checkValidity()) {
                    loadingOverlay.classList.remove('d-none');
                    loadingOverlay.classList.add('d-flex');
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...';
                    }
                }
            });
        }
    });
</script>

<!-- Loading Overlay -->
<div id="loading-overlay" class="d-none position-fixed top-0 start-0 w-100 h-100 flex-column justify-content-center align-items-center" style="background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); z-index: 9999; transition: all 0.3s ease;">
    <div class="d-flex flex-column align-items-center">
        <div class="spinner-border mb-3" role="status" style="width: 3.5rem; height: 3.5rem; border-width: 0.25em; color: #0A256B !important;">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h5 class="fw-bold text-primary-blue mb-1" style="color: #0A256B;">Mengirim Surat</h5>
        <p class="text-muted small mb-0 px-4 text-center">Mohon tunggu, dokumen sedang diunggah ke penyimpanan cloud...</p>
    </div>
</div>
@endsection
