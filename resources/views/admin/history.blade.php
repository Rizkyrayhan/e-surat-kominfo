@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Riwayat Surat Masuk</h3>
    <p class="text-muted mb-0">Daftar seluruh surat yang masuk dari berbagai OPD.</p>
</div>

<div class="table-card mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Surat Masuk</h5>
        <div class="input-group input-group-sm" style="max-width: 300px;">
            <input type="text" class="form-control" placeholder="Cari nomor surat atau OPD...">
            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4">NOMOR SURAT</th>
                    <th scope="col">PENGIRIM (OPD)</th>
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
                    <td>
                        <div class="fw-medium text-dark">{{ $surat->user->name }}</div>
                        <small class="text-muted">ID: #{{ $surat->user_id }}</small>
                    </td>
                    <td>{{ $surat->tujuan }}</td>
                    <td class="text-muted">{{ $surat->tanggal->format('d M Y') }}</td>
                    <td>
                        @if($surat->trashed())
                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 mb-1">Dihapus dari Dashboard</span><br>
                        @endif
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
                        <div class="btn-group">
                            <a href="{{ route('admin.surat.show', $surat) }}" class="btn btn-sm btn-outline-primary rounded-pill me-2">
                                <i class="bi bi-eye me-1"></i> Detail
                            </a>
                            <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-sm btn-outline-info rounded-pill">
                                <i class="bi bi-file-earmark-pdf me-1"></i> File
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">Belum ada surat yang masuk.</td>
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
