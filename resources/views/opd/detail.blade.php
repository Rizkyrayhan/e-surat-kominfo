@extends('layouts.app')

@section('content')
<div class="mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb text-uppercase small fw-semibold">
            <li class="breadcrumb-item"><a href="{{ route('opd.dashboard') }}" class="text-muted text-decoration-none">DASHBOARD</a></li>
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
                    <p class="text-muted small mb-0">Nomor Surat: {{ $surat->nomor_surat }}</p>
                </div>
                <div>
                    @if($surat->status === 'pending')
                        <span class="badge-pending">Pending Verifikasi</span>
                    @elseif($surat->status === 'diproses')
                        <span class="badge-diproses">Diproses</span>
                    @elseif($surat->status === 'dikirim')
                        <span class="badge-dikirim">Dikirim</span>
                    @elseif($surat->status === 'selesai')
                        <span class="badge-selesai">Selesai</span>
                    @endif
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Nomor Surat</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->nomor_surat }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tujuan</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->tujuan }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tanggal Surat</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->tanggal->format('d F Y') }}</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-muted small mb-1 fw-medium">Tanggal Dikirim</p>
                    <p class="fw-semibold text-dark mb-0">{{ $surat->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div class="col-12">
                    <p class="text-muted small mb-1 fw-medium">Perihal / Keterangan</p>
                    <div class="p-3 bg-light rounded border">
                        {{ $surat->keterangan ?? 'Tidak ada keterangan' }}
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
        {{-- Status Info Card --}}
        <div class="stat-card p-4 mb-4">
            <h5 class="fw-bold text-primary-blue mb-3">Status Surat</h5>
            <div class="d-flex align-items-center gap-3 p-3 rounded-3 {{ $surat->status === 'selesai' ? 'bg-success bg-opacity-10' : ($surat->status === 'pending' ? 'bg-warning bg-opacity-10' : 'bg-primary bg-opacity-10') }}">
                <div class="icon-box {{ $surat->status === 'selesai' ? 'icon-box-success' : ($surat->status === 'pending' ? 'icon-box-warning' : 'icon-box-info') }} rounded-circle">
                    @if($surat->status === 'pending')
                        <i class="bi bi-clock"></i>
                    @elseif($surat->status === 'diproses')
                        <i class="bi bi-arrow-repeat"></i>
                    @elseif($surat->status === 'dikirim')
                        <i class="bi bi-send"></i>
                    @else
                        <i class="bi bi-check-circle"></i>
                    @endif
                </div>
                <div>
                    <div class="fw-bold text-dark">
                        @if($surat->status === 'pending') Menunggu Verifikasi
                        @elseif($surat->status === 'diproses') Sedang Diproses
                        @elseif($surat->status === 'dikirim') Sudah Diteruskan
                        @else Surat Selesai
                        @endif
                    </div>
                    <div class="text-muted small">Diperbarui: {{ $surat->updated_at->format('d M Y, H:i') }}</div>
                </div>
            </div>
            <div class="mt-3 pt-3 border-top">
                <a href="{{ route('opd.history') }}" class="btn btn-outline-secondary w-100 rounded-pill">
                    <i class="bi bi-arrow-left me-2"></i> Kembali ke Riwayat
                </a>
            </div>
        </div>

        {{-- Timeline Card --}}
        <div class="stat-card p-4">
            <h5 class="fw-bold text-primary-blue mb-4">Riwayat Perjalanan Surat</h5>
            <div class="position-relative ms-3 border-start border-2 border-primary border-opacity-25 pb-2">
                {{-- Timeline Item 1 --}}
                <div class="position-relative mb-4 pb-2">
                    <div class="position-absolute bg-primary rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6">Surat Dikirim</h6>
                        <p class="text-muted small mb-1">Oleh Anda</p>
                        <span class="text-primary small fw-medium">{{ $surat->created_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>

                {{-- Timeline Item 2 --}}
                <div class="position-relative mb-4 pb-2">
                    <div class="position-absolute {{ in_array($surat->status, ['diproses', 'dikirim', 'selesai']) ? 'bg-primary' : 'bg-light border border-2' }} rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 {{ in_array($surat->status, ['diproses', 'dikirim', 'selesai']) ? '' : 'text-muted' }}">Sedang Diproses</h6>
                        <p class="text-muted small mb-1">Verifikasi dokumen oleh Admin</p>
                    </div>
                </div>

                {{-- Timeline Item 3 --}}
                <div class="position-relative mb-4 pb-2">
                    <div class="position-absolute {{ in_array($surat->status, ['dikirim', 'selesai']) ? 'bg-primary' : 'bg-light border border-2' }} rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 {{ in_array($surat->status, ['dikirim', 'selesai']) ? '' : 'text-muted' }}">Diteruskan</h6>
                        <p class="text-muted small mb-1">Disposisi ke instansi terkait</p>
                    </div>
                </div>

                {{-- Timeline Item 4 --}}
                <div class="position-relative">
                    <div class="position-absolute {{ $surat->status == 'selesai' ? 'bg-success' : 'bg-light border border-2' }} rounded-circle" style="width: 14px; height: 14px; left: -9px; top: 0;"></div>
                    <div class="ps-3">
                        <h6 class="fw-bold mb-1 fs-6 {{ $surat->status == 'selesai' ? 'text-success' : 'text-muted' }}">Selesai</h6>
                        <p class="text-muted small mb-0">Tersimpan di Arsip Digital</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
