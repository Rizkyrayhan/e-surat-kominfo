@extends('layouts.app')

@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
    <div>
        <h4 class="fw-bold mb-1">Kelola Akun OPD</h4>
        <p class="text-muted small mb-0">Manajemen akses dan akun pengguna OPD</p>
    </div>
    <a href="{{ route('admin.opd-accounts.create') }}" class="btn btn-primary bg-kominfo">
        <i class="bi bi-person-plus me-1"></i> Tambah Akun
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Instansi</th>
                        <th>Admin / PIC</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($accounts as $account)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-medium d-block">{{ $account->nama_instansi ?? '-' }}</span>
                            <small class="text-muted">{{ $account->category?->nama_kategori ?? 'Tanpa Kategori' }}</small>
                        </td>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->email }}</td>
                        <td>
                            @if($account->status_akun === 'aktif')
                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Aktif</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <div class="d-inline-flex justify-content-end gap-1 align-items-center">
                                <!-- Edit -->
                                <a href="{{ route('admin.opd-accounts.edit', $account) }}" class="btn btn-sm btn-light text-primary border d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                
                                <!-- Toggle Status -->
                                <form action="{{ route('admin.opd-accounts.toggle-status', $account) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-light border {{ $account->status_akun === 'aktif' ? 'text-warning' : 'text-success' }} d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="{{ $account->status_akun === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="bi {{ $account->status_akun === 'aktif' ? 'bi-pause-circle' : 'bi-play-circle' }}"></i>
                                    </button>
                                </form>
 
                                <!-- Delete -->
                                <form action="{{ route('admin.opd-accounts.destroy', $account) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light text-danger border d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada akun OPD terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
