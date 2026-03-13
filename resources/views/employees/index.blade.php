@extends('layouts.app')
@section('title', 'Data Karyawan')
@section('content')

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div><h1>Data Karyawan</h1><p>Kelola seluruh data karyawan</p></div>
    <a href="{{ route('employees.create') }}" class="btn btn-primary no-print">
        <i class="bi bi-plus-lg me-1"></i> Tambah Karyawan
    </a>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people me-2 text-primary"></i>Daftar Karyawan</span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;">{{ $employees->count() }}</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Departemen</th>
                        <th>Tgl Masuk</th>
                        <th class="text-center no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $emp)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:38px;height:38px;background:#EFF6FF;border-radius:50%;display:grid;place-items:center;font-weight:700;color:#2563EB;flex-shrink:0;">
                                    {{ strtoupper(substr($emp->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:.875rem;">{{ $emp->user->name }}</div>
                                    <div style="font-size:.775rem;color:#6B7280;">{{ $emp->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td><code style="background:#F1F5F9;padding:.2rem .5rem;border-radius:5px;font-size:.8rem;">{{ $emp->nip }}</code></td>
                        <td style="font-size:.85rem;">{{ $emp->jabatan }}</td>
                        <td><span style="background:#F1F5F9;color:#374151;padding:.2rem .6rem;border-radius:20px;font-size:.775rem;">{{ $emp->departemen }}</span></td>
                        <td style="font-size:.825rem;">{{ $emp->tanggal_masuk->format('d M Y') }}</td>
                        <td class="text-center no-print">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('employees.edit', $emp) }}" class="btn btn-sm" style="background:#EFF6FF;color:#2563EB;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-sm" style="background:#FEF2F2;color:#EF4444;"
                                        onclick="if(confirm('Hapus karyawan {{ addslashes($emp->user->name) }}?')) document.getElementById('del-{{ $emp->id }}').submit()">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <form id="del-{{ $emp->id }}" action="{{ route('employees.destroy', $emp) }}" method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-people fs-2 d-block mb-2"></i>Belum ada data karyawan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
