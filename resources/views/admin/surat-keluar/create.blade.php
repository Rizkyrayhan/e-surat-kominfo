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
                    <label for="tujuan_opd_id" class="form-label fw-medium small">Tujuan OPD</label>
                    <select class="form-select @error('tujuan_opd_id') is-invalid @enderror" id="tujuan_opd_id" name="tujuan_opd_id" required>
                        <option value="" selected disabled>Pilih OPD Tujuan</option>
                        @foreach($opds as $opd)
                            <option value="{{ $opd->id }}" {{ old('tujuan_opd_id') == $opd->id ? 'selected' : '' }}>{{ $opd->name }}</option>
                        @endforeach
                    </select>
                    @error('tujuan_opd_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
    document.getElementById('file_pdf').addEventListener('change', function(e) {
        if(e.target.files.length > 0) {
            let fileName = e.target.files[0].name;
            let container = e.target.parentElement;
            container.querySelector('h6').textContent = fileName;
            container.querySelector('p').textContent = "File siap dikirim";
            container.querySelector('.icon-box').classList.replace('text-primary-blue', 'text-success');
        }
    });
</script>
@endsection
