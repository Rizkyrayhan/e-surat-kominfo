@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Dashboard Utama</h3>
        <p class="text-muted mb-0">Selamat datang kembali, berikut ringkasan pengelolaan surat hari ini.</p>
    </div>
    <div>
        <a href="{{ route('opd.surat.create') }}" class="btn btn-info rounded-pill px-4 py-2 fw-semibold shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-plus-lg"></i> Kirim Surat Baru
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Total Surat</h6>
                    <h2 class="fw-bold mb-0 text-dark">{{ number_format($stats['total']) }}</h2>
                </div>
                <div class="icon-box icon-box-primary">
                    <i class="bi bi-envelope"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="text-success small fw-medium d-flex align-items-center gap-1">
                    <i class="bi bi-graph-up-arrow"></i> +12% Bulan ini
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-3">
        <div class="stat-card border-warning p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Pending Approval</h6>
                    <h2 class="fw-bold mb-0" style="color: #D97706;">{{ number_format($stats['pending']) }}</h2>
                </div>
                <div class="icon-box icon-box-warning">
                    <i class="bi bi-chat-dots"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="small fw-medium d-flex align-items-center gap-1" style="color: #D97706;">
                    <i class="bi bi-clock"></i> Butuh Tindakan Segera
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Sedang Diproses</h6>
                    <h2 class="fw-bold mb-0 text-primary">{{ number_format($stats['diproses']) }}</h2>
                </div>
                <div class="icon-box icon-box-info bg-opacity-10 text-primary">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="text-primary small fw-medium d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-repeat"></i> Dalam Antrean
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="stat-card border-success p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h6 class="text-muted fw-normal mb-1">Surat Selesai</h6>
                    <h2 class="fw-bold mb-0 text-success">{{ number_format($stats['selesai']) }}</h2>
                </div>
                <div class="icon-box icon-box-success bg-opacity-10">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
            <div class="d-flex align-items-center mt-3">
                <span class="text-success small fw-medium d-flex align-items-center gap-1">
                    <i class="bi bi-check-circle"></i> Tersimpan di Arsip
                </span>
            </div>
        </div>
    </div>
</div>

<div class="table-card mb-5">
    <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
        <h5 class="fw-bold mb-0 text-primary-blue">Daftar Surat Terbaru</h5>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3">Filter</button>
            <a href="{{ route('opd.history') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Lihat Semua</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4">NOMOR SURAT</th>
                    <th scope="col">TUJUAN / INSTANSI</th>
                    <th scope="col">TANGGAL MASUK</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr>
                    <td class="ps-4 fw-bold text-primary-blue" style="font-size: 0.9rem;">{{ $surat->nomor_surat }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light text-dark border me-2">{{ substr($surat->tujuan, 0, 3) }}</span>
                            <span class="text-dark fw-medium" style="font-size: 0.9rem;">{{ $surat->tujuan }}</span>
                        </div>
                    </td>
                    <td class="text-muted" style="font-size: 0.9rem;">{{ $surat->tanggal->format('d M Y, H:i') }}</td>
                    <td>
                        @if($surat->status === 'pending')
                            <span class="badge-pending"><span class="badge bg-warning rounded-circle p-1 me-1 d-inline-block"></span>Pending</span>
                        @elseif($surat->status === 'diproses')
                            <span class="badge-diproses"><span class="badge bg-primary rounded-circle p-1 me-1 d-inline-block"></span>Diproses</span>
                        @elseif($surat->status === 'dikirim')
                            <span class="badge-dikirim"><span class="badge rounded-circle p-1 me-1 d-inline-block" style="background-color: #7E22CE;"></span>Dikirim</span>
                        @elseif($surat->status === 'selesai')
                            <span class="badge-selesai"><span class="badge bg-success rounded-circle p-1 me-1 d-inline-block"></span>Selesai</span>
                        @endif
                    </td>
                    <td class="pe-4 text-end">
                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-sm btn-light text-muted me-1 rounded-circle">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button class="btn btn-sm btn-light text-muted rounded-circle"><i class="bi bi-three-dots"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada surat yang dikirim.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="bg-primary-blue text-white rounded-4 p-4 p-lg-5 h-100 position-relative overflow-hidden">
            <div class="position-relative z-1">
                <h4 class="fw-bold mb-3">Panduan Keamanan Dokumen</h4>
                <p class="opacity-75 mb-4 pe-lg-5">Pastikan setiap surat keluar telah ditandatangani secara digital menggunakan TTE yang sah untuk menjamin otentisitas.</p>
                <button class="btn btn-light rounded-pill px-4 py-2 fw-semibold text-primary-blue">Pelajari Selengkapnya</button>
            </div>
            <i class="bi bi-shield-check position-absolute opacity-10" style="font-size: 15rem; right: -2rem; bottom: -3rem;"></i>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="stat-card p-4 p-lg-5 h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold text-primary-blue mb-0">Penyimpanan Cloud</h5>
                <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle">
                    <i class="bi bi-cloud-arrow-up"></i>
                </div>
            </div>
            <div class="progress mb-3" style="height: 10px;">
                <div class="progress-bar bg-info rounded-pill" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between text-muted small">
                <span>650GB digunakan dari 1TB</span>
                <span class="fw-bold text-dark">65%</span>
            </div>
        </div>
    </div>
</div>
@endsection
