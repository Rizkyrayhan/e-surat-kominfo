                @extends('layouts.app')

                @section('content')
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">Kelola Kategori</h4>
                        <p class="text-muted small mb-0">Manajemen kategori instansi Organisasi Perangkat Daerah</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Form Tambah Kategori -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom py-3">
                                <h6 class="mb-0 fw-bold"><i class="bi bi-tag-fill me-2 text-primary-blue"></i>Tambah Kategori Baru</h6>
                            </div>
                            <div class="card-body p-4">
                                <form action="{{ route('admin.categories.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="nama_kategori" class="form-label fw-medium small">Nama Kategori</label>
                                        <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori') }}" placeholder="Contoh: Kecamatan, Kelurahan, Dinas" required>
                                        @error('nama_kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-2 fw-medium">
                                        <i class="bi bi-plus-circle me-1"></i> Simpan Kategori
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Kategori -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white border-bottom py-3">
                                <h6 class="mb-0 fw-bold"><i class="bi bi-list-stars me-2 text-primary-blue"></i>Daftar Kategori</h6>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-4" style="width: 80px;">No</th>
                                                <th>Nama Kategori</th>
                                                <th class="text-center">Jumlah OPD</th>
                                                <th>Tanggal Dibuat</th>
                                                <th class="text-end pe-4">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($categories as $category)
                                            <tr>
                                                <td class="ps-4 fw-medium text-muted">{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="fw-semibold text-dark">{{ $category->nama_kategori }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge px-3 py-1 rounded-pill border fw-semibold" style="font-size: 0.75rem; background-color: #eff6ff; color: #1d4ed8 !important; border: 1px solid #bfdbfe !important;">
                                                        {{ $category->accounts_count }} OPD
                                                    </span>
                                                </td>
                                                <td class="text-muted small">
                                                    {{ $category->created_at ? $category->created_at->format('d M Y, H:i') : '-' }}
                                                </td>
                                                <td class="text-end pe-4">
                                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Instansi yang terhubung dengan kategori ini akan berubah menjadi Tanpa Kategori.');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-circle" title="Hapus Kategori" style="width: 32px; height: 32px; padding: 0;">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-muted">
                                                    <div class="mb-2"><i class="bi bi-tags fs-1 opacity-25"></i></div>
                                                    Belum ada data kategori.
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
