@extends('layouts.app')
@section('title', 'Tambah Karyawan')
@section('content')

<div class="page-header d-flex align-items-center gap-3">
    <a href="{{ route('employees.index') }}" class="btn btn-sm" style="background:#F1F5F9;border-radius:8px;"><i class="bi bi-arrow-left"></i></a>
    <div><h1>Tambah Karyawan</h1><p>Isi data karyawan baru</p></div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><i class="bi bi-person-plus me-2 text-primary"></i>Form Data Karyawan</div>
            <div class="card-body p-4">
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf

                    <p class="fw-bold mb-3" style="color:#2563EB;font-size:.8rem;text-transform:uppercase;letter-spacing:.5px;">
                        <i class="bi bi-person me-1"></i> Data Akun
                    </p>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama lengkap">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="email@perusahaan.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 karakter">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <hr>
                    <p class="fw-bold mb-3 mt-3" style="color:#2563EB;font-size:.8rem;text-transform:uppercase;letter-spacing:.5px;">
                        <i class="bi bi-briefcase me-1"></i> Data Kepegawaian
                    </p>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIP <span class="text-danger">*</span></label>
                            <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" placeholder="Nomor Induk Pegawai">
                            @error('nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" placeholder="Posisi/Jabatan">
                            @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Departemen <span class="text-danger">*</span></label>
                            <select name="departemen" class="form-select @error('departemen') is-invalid @enderror">
                                <option value="">Pilih Departemen</option>
                                @foreach(['IT','Human Resource','Finance','Marketing','Operations','Legal'] as $d)
                                    <option value="{{ $d }}" {{ old('departemen') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                            @error('departemen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk') }}">
                            @error('tanggal_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-check-lg me-1"></i> Simpan</button>
                        <a href="{{ route('employees.index') }}" class="btn" style="background:#F1F5F9;">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
