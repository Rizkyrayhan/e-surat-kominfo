@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Daftar Surat Keluar</h3>
        <p class="text-muted mb-0">Riwayat surat yang dikirim oleh Kominfo ke OPD.</p>
    </div>
    <div>
        <a href="{{ route('admin.surat-keluar.create') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #0A256B;">
            <i class="bi bi-plus-lg"></i> Kirim Surat Baru
        </a>
    </div>
</div>

<div class="table-card mb-5">
    <div class="p-4 border-bottom">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Surat Keluar</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4">NOMOR SURAT</th>
                    <th scope="col">TUJUAN OPD</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">PERIHAL</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr>
                    <td class="ps-4 fw-bold text-primary-blue" style="font-size: 0.9rem;">{{ $surat->nomor_surat }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($surat->tujuanOpd->name) }}&background=EBF4FF&color=1E3A8A" alt="OPD" class="rounded-circle me-2" width="24" height="24">
                            <span class="text-dark fw-medium" style="font-size: 0.9rem;">{{ $surat->tujuanOpd->name }}</span>
                        </div>
                    </td>
                    <td class="text-muted" style="font-size: 0.9rem;">{{ $surat->tanggal->format('d M Y') }}</td>
                    <td style="font-size: 0.9rem; max-width: 300px;" class="text-truncate">{{ $surat->perihal }}</td>
                    <td class="pe-4 text-end">
                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-sm btn-light text-muted me-1 rounded-circle" title="Lihat PDF">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ asset('storage/' . $surat->file) }}" download class="btn btn-sm btn-light text-muted rounded-circle" title="Download PDF">
                            <i class="bi bi-download"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada surat yang dikirim ke OPD.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($surats->hasPages())
    <div class="p-4 border-top">
        {{ $surats->links() }}
    </div>
    @endif
</div>
@endsection
