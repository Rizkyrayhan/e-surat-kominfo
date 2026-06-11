@extends('layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="{{ route('admin.surat-keluar.index') }}" class="text-muted text-decoration-none">SURAT KELUAR</a></li>
            <li class="breadcrumb-item active text-primary-blue" aria-current="page">DETAIL SURAT KELUAR</li>
        </ol>
    </nav>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="stat-card p-4 p-lg-5 mb-4">
            <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4">
                <div>
                    <h4 class="fw-bold text-primary-blue mb-1">Detail Surat Keluar</h4>
                    <p class="text-muted small mb-0">Nomor: {{ $surat->nomor_surat }}</p>
                </div>
                <span class="badge bg-success bg-opacity-10 text-success fw-semibold px-3 py-2 rounded-pill">
                    <i class="bi bi-send-check me-1"></i> Terkirim
                </span>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Nomor Surat</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->nomor_surat }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tujuan OPD</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->tujuanOpd->nama_instansi ?: ($surat->tujuanOpd->name ?? '-') }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tanggal Surat</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->tanggal->format('d F Y') }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tanggal Dikirim</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Status Dibaca</p>
                    <p class="fw-semibold mb-0">
                        @if($surat->is_read)
                            <span class="text-success"><i class="bi bi-check-circle-fill me-1"></i> Sudah Dibaca</span>
                        @else
                            <span class="text-warning"><i class="bi bi-clock-fill me-1"></i> Belum Dibaca</span>
                        @endif
                    </p>
                </div>
                <div class="col-12">
                    <p class="text-muted small mb-1 fw-medium">Perihal</p>
                    <div class="p-3 bg-light rounded border">
                        {{ $surat->perihal ?? 'Tidak ada perihal' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="stat-card p-0 overflow-hidden">
            <div class="bg-light p-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-primary-blue"><i class="bi bi-file-earmark-pdf me-2"></i>Dokumen Surat</h6>
                <div class="d-flex gap-2">
                    <a href="{{ Storage::disk('s3')->url($surat->file) }}" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="bi bi-eye me-1"></i> Buka PDF
                    </a>
                    <a href="{{ route('download.file', ['path' => $surat->file]) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                        <i class="bi bi-download me-1"></i> Unduh File
                    </a>
                </div>
            </div>
            <div class="p-4 d-flex justify-content-center bg-dark bg-opacity-10">
                <div class="bg-white border shadow-sm text-center" style="width: 100%;">
                    <iframe src="{{ Storage::disk('s3')->url($surat->file) }}" width="100%" height="600px" style="border: none;">
                        Browser Anda tidak mendukung pratinjau. Silakan unduh file.
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        {{-- Tujuan OPD Card --}}
        <div class="stat-card p-4 mb-4">
            <h5 class="fw-bold text-primary-blue mb-3">Info Penerima</h5>
            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($surat->tujuanOpd->nama_instansi ?: ($surat->tujuanOpd->name ?? 'OPD')) }}&background=EBF4FF&color=1E3A8A"
                     alt="OPD" class="rounded-circle" width="48" height="48">
                <div>
                    <div class="fw-bold text-dark">{{ $surat->tujuanOpd->nama_instansi ?: ($surat->tujuanOpd->name ?? '-') }}</div>
                    <div class="text-muted small">{{ $surat->tujuanOpd->email ?? '' }}</div>
                </div>
            </div>

            <div class="mt-4 d-flex flex-column gap-2">
                <a href="{{ route('admin.surat-keluar.index') }}" class="btn btn-outline-secondary w-100 rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                </a>
                <form action="{{ route('admin.surat-keluar.destroy', $surat->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-pill"
                        onclick="return confirm('Hapus surat ini secara permanen?')">
                        <i class="bi bi-trash me-2"></i> Hapus Surat
                    </button>
                </form>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="stat-card p-4">
            <h5 class="fw-bold text-primary-blue mb-4">Riwayat</h5>
            <div class="position-relative ms-3 border-start border-2 border-success border-opacity-25 pb-2">
                <div class="position-relative mb-4">
                    <div class="position-absolute bg-success rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6">Surat Dibuat</h6>
                        <p class="text-muted small mb-0">{{ $surat->created_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <div class="position-relative mb-4">
                    <div class="position-absolute bg-success rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6">Terkirim ke {{ $surat->tujuanOpd->nama_instansi ?: ($surat->tujuanOpd->name ?? 'OPD') }}</h6>
                        <p class="text-muted small mb-0">Otomatis saat surat dibuat</p>
                    </div>
                </div>
                <div class="position-relative">
                    <div class="position-absolute {{ $surat->is_read ? 'bg-success' : 'bg-light border border-2' }} rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 {{ $surat->is_read ? '' : 'text-muted' }}">Sudah Dibaca OPD</h6>
                        <p class="text-muted small mb-0">
                            @if($surat->is_read) Telah dibaca oleh penerima @else Belum dibaca @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
