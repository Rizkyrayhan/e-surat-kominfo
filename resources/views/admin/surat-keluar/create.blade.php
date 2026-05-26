@extends('layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-muted text-decoration-none">ADMIN</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">KIRIM SURAT KE OPD</li>
        </ol>
    </nav>
</div>

<form action="{{ route('admin.surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <!-- Form Fields -->
        <div class="col-lg-8">
            <div class="stat-card p-4 p-lg-5 h-100">
                <h4 class="fw-bold text-primary-blue mb-2">Form Kirim Surat</h4>
                <p class="text-muted small mb-4">Silakan isi detail surat yang akan dikirimkan ke OPD tujuan.</p>
                
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label for="nomor_surat" class="form-label fw-medium small">Nomor Surat</label>
                        <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" value="{{ old('nomor_surat') }}" placeholder="000/KOMINFO/2024" required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="tanggal" class="form-label fw-medium small">Tanggal Surat</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="form-label fw-medium small mb-0">Tujuan OPD <span class="text-danger">*</span></label>
                        <span class="badge bg-secondary rounded-pill" id="selected-count" style="font-size: 0.75rem; background-color: #0A256B !important;">0 OPD Terpilih</span>
                    </div>
                    
                    <!-- Search Bar and Select All Controls -->
                    <div class="row g-2 mb-3 align-items-center">
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text bg-white text-muted border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" id="search-opd" class="form-control border-start-0 ps-0" placeholder="Cari nama OPD...">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" id="btn-select-all" class="btn btn-outline-primary btn-sm px-3 fw-semibold text-uppercase" style="font-size: 0.75rem; border-color: #0A256B; color: #0A256B; transition: all 0.2s;">Pilih Semua</button>
                            <button type="button" id="btn-deselect-all" class="btn btn-outline-danger btn-sm px-3 fw-semibold text-uppercase d-none" style="font-size: 0.75rem; transition: all 0.2s;">Batal Semua</button>
                        </div>
                    </div>

                    <!-- Scrollable Checkbox List -->
                    <div class="border rounded p-3 bg-white" style="max-height: 220px; overflow-y: auto; border-color: #dee2e6 !important;">
                        <div class="row g-2" id="opd-list-container">
                            @foreach($opds as $opd)
                                <div class="col-md-6 opd-item">
                                    <div class="form-check p-2 border rounded cursor-pointer d-flex align-items-center gap-2 opd-card" style="transition: all 0.2s; cursor: pointer; border-color: #e9ecef !important; background-color: #f8f9fa;">
                                        <input class="form-check-input ms-0 opd-checkbox" type="checkbox" name="tujuan_opd_ids[]" value="{{ $opd->id }}" id="opd_{{ $opd->id }}" style="cursor: pointer; width: 1.15rem; height: 1.15rem; margin-top: 0;">
                                        <label class="form-check-label small fw-semibold text-dark flex-grow-1 mb-0 cursor-pointer" for="opd_{{ $opd->id }}" style="user-select: none;">
                                            {{ $opd->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    @error('tujuan_opd_ids')
                        <div class="text-danger small mt-2"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror
                </div>

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

                <div class="mb-4">
                    <label for="perihal" class="form-label fw-medium small">Perihal</label>
                    <textarea class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" rows="4" placeholder="Tuliskan perihal surat di sini...">{{ old('perihal') }}</textarea>
                    @error('perihal')
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
                    <input type="file" name="file_pdf" id="file_pdf" class="position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer" accept=".pdf" required style="cursor: pointer;">
                    <div class="icon-box bg-white text-primary-blue rounded-circle shadow-sm mb-3" style="width: 64px; height: 64px; font-size: 2rem;">
                        <i class="bi bi-file-earmark-pdf"></i>
                    </div>
                    <h6 class="fw-bold text-primary-blue mb-1">Pilih File PDF</h6>
                    <p class="text-muted small mb-3 text-center">Klik atau tarik file ke sini.<br>Maksimal ukuran file 10MB.</p>
                    <button type="button" class="btn btn-outline-secondary btn-sm bg-white rounded-pill px-4 fw-medium">Pilih File</button>
                    
                    @error('file_pdf')
                        <div class="text-danger small mt-2 w-100 position-relative z-3 text-center">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 d-flex justify-content-center align-items-center gap-2 fw-semibold" style="background-color: #0A256B;">
                    <i class="bi bi-send"></i> Kirim Surat Ke OPD
                </button>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File PDF selection styling
        const fileInput = document.getElementById('file_pdf');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                if(e.target.files.length > 0) {
                    let fileName = e.target.files[0].name;
                    let container = e.target.parentElement;
                    container.querySelector('h6').textContent = fileName;
                    container.querySelector('p').textContent = "File siap dikirim";
                    container.querySelector('.icon-box').classList.replace('text-primary-blue', 'text-success');
                }
            });
        }

        // Search/filter OPDs
        const searchInput = document.getElementById('search-opd');
        const opdItems = document.querySelectorAll('.opd-item');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase().trim();
                opdItems.forEach(item => {
                    const opdName = item.querySelector('.form-check-label').textContent.toLowerCase();
                    if (opdName.includes(query)) {
                        item.classList.remove('d-none');
                    } else {
                        item.classList.add('d-none');
                    }
                });
            });
        }

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
                selectedCount.textContent = `${count} OPD Terpilih`;
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
</script>
@endsection
