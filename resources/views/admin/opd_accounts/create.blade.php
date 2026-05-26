@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Tambah Akun OPD</h4>
        <p class="text-muted small mb-0">Buat akun baru untuk Organisasi Perangkat Daerah</p>
    </div>
    <a href="{{ route('admin.opd-accounts.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.opd-accounts.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-medium small">Kategori Instansi</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama_instansi" class="form-label fw-medium small">Nama Instansi</label>
                        <input type="text" class="form-control @error('nama_instansi') is-invalid @enderror" id="nama_instansi" name="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Contoh: Dinas Kesehatan" required>
                        @error('nama_instansi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium small">Nama Admin / PIC</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Santoso" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium small">Email Akses</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="admin@dinkes.go.id" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-medium small">Password Awal</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required minlength="8">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary bg-kominfo px-4">
                            <i class="bi bi-save me-1"></i> Simpan Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
