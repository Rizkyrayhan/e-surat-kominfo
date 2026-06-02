@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1 text-dark">Dashboard Utama</h3>
        <p class="text-muted mb-0">Selamat datang kembali, berikut ringkasan pengelolaan surat hari ini.</p>
    </div>
    <div>
        <a href="{{ route('opd.surat.create') }}" class="btn btn-info rounded-pill px-4 py-2 fw-semibold shadow-sm d-flex align-items-center justify-content-center gap-2">
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
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center p-4 border-bottom gap-3">
        <h5 class="fw-bold mb-0 text-primary-blue">Daftar Surat Terbaru</h5>
        <div class="d-flex flex-column flex-md-row gap-2">
            <button id="btn-bulk-delete" class="btn btn-outline-danger btn-sm rounded-pill px-3 d-none align-items-center justify-content-center gap-1 btn-responsive">
                <i class="bi bi-trash"></i> Hapus Terpilih (<span id="selected-count">0</span>)
            </button>
            <button class="btn btn-outline-secondary btn-sm rounded-pill px-3 btn-responsive">Filter</button>
            <a href="{{ route('opd.history') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3 btn-responsive">Lihat Semua</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th scope="col" class="ps-4" style="width: 40px;">
                        <input type="checkbox" class="form-check-input" id="check-all">
                    </th>
                    <th scope="col">NOMOR SURAT</th>
                    <th scope="col">TUJUAN / INSTANSI</th>
                    <th scope="col">TANGGAL MASUK</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr id="surat-row-{{ $surat->id }}" onclick="if(event.target.type !== 'checkbox' && !event.target.closest('button') && !event.target.closest('a')) { window.open('{{ Storage::disk('s3')->url($surat->file) }}', '_blank'); }" style="cursor: pointer;" class="hover-shadow-sm transition-all">
                    <td class="ps-4">
                        <input type="checkbox" class="form-check-input surat-checkbox" value="{{ $surat->id }}">
                    </td>
                    <td class="fw-bold text-primary-blue" style="font-size: 0.9rem;">{{ $surat->nomor_surat }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light text-dark border me-2">{{ substr($surat->tujuan, 0, 3) }}</span>
                            <span class="text-dark fw-medium" style="font-size: 0.9rem;">{{ $surat->tujuan }}</span>
                        </div>
                    </td>
                    <td class="text-muted" style="font-size: 0.9rem;">{{ $surat->tanggal->format('d M Y, H:i') }}</td>
                    <td>
                        @if($surat->status === 'pending')
                            <span class="badge-pending">Pending</span>
                        @elseif($surat->status === 'diproses')
                            <span class="badge-diproses">Diproses</span>
                        @elseif($surat->status === 'dikirim')
                            <span class="badge-dikirim">Dikirim</span>
                        @elseif($surat->status === 'selesai')
                            <span class="badge-selesai">Selesai</span>
                        @endif
                    </td>
                    <td class="pe-4 text-end">
                        <a href="{{ Storage::disk('s3')->url($surat->file) }}" target="_blank" class="btn btn-sm btn-light text-muted me-1 rounded-circle">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button class="btn btn-sm btn-light text-muted rounded-circle"><i class="bi bi-three-dots"></i></button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Belum ada surat yang dikirim.</td>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('.surat-checkbox');
    const btnBulkDelete = document.getElementById('btn-bulk-delete');
    const selectedCount = document.getElementById('selected-count');

    function updateBulkDeleteButton() {
        const checkedCount = document.querySelectorAll('.surat-checkbox:checked').length;
        if (checkedCount > 0) {
            btnBulkDelete.classList.remove('d-none');
            btnBulkDelete.classList.add('d-flex');
            selectedCount.textContent = checkedCount;
        } else {
            btnBulkDelete.classList.add('d-none');
            btnBulkDelete.classList.remove('d-flex');
        }
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = checkAll.checked;
            });
            updateBulkDeleteButton();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', function() {
            updateBulkDeleteButton();
            if (!this.checked) {
                checkAll.checked = false;
            } else if (document.querySelectorAll('.surat-checkbox:checked').length === checkboxes.length) {
                checkAll.checked = true;
            }
        });
    });

    if (btnBulkDelete) {
        btnBulkDelete.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus surat yang dipilih secara permanen? Tindakan ini tidak dapat dibatalkan.')) {
                const selectedIds = Array.from(document.querySelectorAll('.surat-checkbox:checked')).map(cb => cb.value);
                
                fetch('{{ route("opd.surat.bulk-delete") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ ids: selectedIds })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); 
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus surat.');
                });
            }
        });
    }
});
</script>
@endpush
@endsection
