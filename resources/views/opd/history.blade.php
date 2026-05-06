@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Riwayat Pengiriman Surat</h3>
    <p class="text-muted mb-0">Daftar lengkap seluruh surat yang pernah Anda kirimkan melalui sistem.</p>
</div>

<div class="table-card mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Dokumen</h5>
        <div class="input-group input-group-sm" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Cari nomor surat atau tujuan...">
            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4">NOMOR SURAT</th>
                    <th scope="col">TUJUAN</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr>
                    <td class="ps-4 fw-bold text-primary-blue">{{ $surat->nomor_surat }}</td>
                    <td>{{ $surat->tujuan }}</td>
                    <td class="text-muted">{{ $surat->tanggal->format('d M Y') }}</td>
                    <td>
                        @if($surat->status === 'pending')
                            <span class="badge bg-warning text-dark opacity-75">Pending</span>
                        @elseif($surat->status === 'diproses')
                            <span class="badge bg-primary opacity-75">Diproses</span>
                        @elseif($surat->status === 'selesai')
                            <span class="badge bg-success opacity-75">Selesai</span>
                        @else
                            <span class="badge bg-secondary opacity-75">{{ $surat->status }}</span>
                        @endif
                    </td>
                    <td class="pe-4 text-end">
                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                            <i class="bi bi-eye me-1"></i> Lihat
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat surat.</td>
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
