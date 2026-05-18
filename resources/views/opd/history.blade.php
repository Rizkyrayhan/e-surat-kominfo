@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold mb-1 text-dark">Riwayat Pengiriman Surat</h3>
    <p class="text-muted mb-0">Daftar lengkap seluruh surat yang pernah Anda kirimkan melalui sistem.</p>
</div>

<div class="table-card mb-4">
    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary-blue">Semua Dokumen</h5>
        <div class="d-flex align-items-center gap-2">
            <button id="btn-bulk-delete" class="btn btn-outline-danger btn-sm rounded-pill px-3 d-none align-items-center justify-content-center gap-1">
                <i class="bi bi-trash"></i> Hapus Terpilih (<span id="selected-count">0</span>)
            </button>
            <form action="{{ route('opd.history') }}" method="GET" class="input-group input-group-sm" style="max-width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Cari nomor surat atau tujuan..." value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
            </form>
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
                    <th scope="col">TUJUAN</th>
                    <th scope="col">TANGGAL</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="pe-4 text-end">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr id="surat-row-{{ $surat->id }}">
                    <td class="ps-4">
                        <input type="checkbox" class="form-check-input surat-checkbox" value="{{ $surat->id }}">
                    </td>
                    <td class="fw-bold text-primary-blue">{{ $surat->nomor_surat }}</td>
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
                        <a href="{{ route('download.file', ['path' => $surat->file]) }}" class="btn btn-sm btn-outline-info rounded-pill">
                            <i class="bi bi-download me-1"></i> Unduh
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
            if (confirm('Apakah Anda yakin ingin menghapus surat yang dipilih secara permanen? Data yang dihapus tidak dapat dikembalikan.')) {
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
