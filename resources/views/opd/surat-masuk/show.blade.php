@extends('layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="{{ route('opd.surat-masuk.index') }}" class="text-muted text-decoration-none">SURAT MASUK</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">DETAIL SURAT</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="stat-card p-4 p-lg-5 h-100">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h4 class="fw-bold text-primary-blue mb-1">Detail Surat Dari Kominfo</h4>
                    <p class="text-muted small mb-0">Informasi lengkap dokumen surat masuk.</p>
                </div>
                <a href="{{ asset('storage/' . $surat->file) }}" download class="btn btn-primary rounded-pill px-4 shadow-sm" style="background-color: #0A256B;">
                    <i class="bi bi-download me-2"></i> Download PDF
                </a>
            </div>

            <hr class="my-4 opacity-10">

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Nomor Surat</label>
                    <p class="fw-bold text-dark fs-5">{{ $surat->nomor_surat }}</p>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Tanggal Surat</label>
                    <p class="fw-bold text-dark fs-5">{{ $surat->tanggal->format('d F Y') }}</p>
                </div>
                <div class="col-md-12">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Perihal / Keterangan</label>
                    <div class="bg-light p-4 rounded-3 text-dark">
                        {{ $surat->perihal }}
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Pengirim (Admin Kominfo)</label>
                    <div class="d-flex align-items-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($surat->pengirim->name) }}&background=EBF4FF&color=1E3A8A" alt="Admin" class="rounded-circle me-2" width="32" height="32">
                        <span class="text-dark fw-bold">{{ $surat->pengirim->name }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="text-muted small text-uppercase fw-bold mb-1">Diterima Pada</label>
                    <p class="text-dark">{{ $surat->created_at->format('d M Y, H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="stat-card p-4 h-100">
            <h5 class="fw-bold text-primary-blue mb-4">Preview Dokumen</h5>
            <div class="ratio ratio-1x1 bg-light rounded-3 overflow-hidden border">
                <iframe src="{{ asset('storage/' . $surat->file) }}#toolbar=0" class="w-100 h-100" style="border: none;">
                    <div class="d-flex flex-column justify-content-center align-items-center text-muted h-100">
                        <i class="bi bi-file-earmark-pdf fs-1 mb-3"></i>
                        <p class="small text-center px-4">Browser Anda tidak mendukung preview PDF.<br>Silakan unduh untuk melihat isi lengkap.</p>
                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                            <i class="bi bi-eye me-2"></i> Buka di Tab Baru
                        </a>
                    </div>
                </iframe>
            </div>
            
            <div class="mt-4 bg-info bg-opacity-10 rounded-3 p-3">
                <div class="d-flex gap-3">
                    <i class="bi bi-info-circle text-info fs-5"></i>
                    <p class="small text-info mb-0">Pastikan Anda mendownload dan mencetak surat ini jika diperlukan untuk arsip fisik OPD.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
