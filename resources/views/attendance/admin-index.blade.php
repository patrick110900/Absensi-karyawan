@extends('layouts.app')
@section('title', 'Data Absensi')
@section('content')

<div class="page-header"><h1>Data Absensi</h1><p>Kelola seluruh data absensi karyawan</p></div>

<div class="card mb-4 no-print">
    <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4"><label class="form-label">Filter Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ request('date', today()->toDateString()) }}">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-filter me-1"></i>Filter</button>
                <a href="{{ route('attendance.admin') }}" class="btn" style="background:#F1F5F9;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-calendar-check me-2 text-primary"></i>
            Absensi — {{ request('date') ? \Carbon\Carbon::parse(request('date'))->isoFormat('D MMMM Y') : 'Semua' }}
        </span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;">{{ $attendances->count() }} data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Foto</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th class="text-center no-print">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $a)
                    <tr>
                        <td>
                            <div style="font-weight:600;font-size:.85rem;">{{ $a->employee->user->name }}</div>
                            <div style="font-size:.75rem;color:#6B7280;">{{ $a->employee->departemen }}</div>
                        </td>
                        <td style="font-size:.825rem;">{{ $a->tanggal->format('d M Y') }}</td>
                        <td>
                            @if($a->jam_masuk)<span class="badge" style="background:#ECFDF5;color:#10B981;border-radius:20px;">{{ $a->jam_masuk }}</span>
                            @else<span class="text-muted">-</span>@endif
                        </td>
                        <td>
                            @if($a->jam_pulang)<span class="badge" style="background:#FEF2F2;color:#EF4444;border-radius:20px;">{{ $a->jam_pulang }}</span>
                            @else<span class="text-muted">-</span>@endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                @if($a->selfie_masuk)
                                    <img src="{{ asset('storage/' . $a->selfie_masuk) }}" style="width:36px;height:36px;border-radius:6px;object-fit:cover;border:2px solid #10B981;cursor:pointer;" onclick="showPhoto('{{ asset('storage/' . $a->selfie_masuk) }}','Masuk')">
                                @endif
                                @if($a->selfie_pulang)
                                    <img src="{{ asset('storage/' . $a->selfie_pulang) }}" style="width:36px;height:36px;border-radius:6px;object-fit:cover;border:2px solid #EF4444;cursor:pointer;" onclick="showPhoto('{{ asset('storage/' . $a->selfie_pulang) }}','Pulang')">
                                @endif
                                @if(!$a->selfie_masuk && !$a->selfie_pulang)<span class="text-muted">-</span>@endif
                            </div>
                        </td>
                        <td style="font-size:.775rem;color:#6B7280;max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $a->lokasi_masuk ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $a->status_badge }} bg-opacity-15 text-{{ $a->status_badge }}" style="border-radius:20px;padding:.3rem .75rem;font-size:.74rem;">{{ ucfirst($a->status) }}</span>
                        </td>
                        <td class="text-center no-print">
                            <button class="btn btn-sm" style="background:#FEF2F2;color:#EF4444;"
                                    onclick="if(confirm('Hapus data absensi ini?')) document.getElementById('del-{{ $a->id }}').submit()">
                                <i class="bi bi-trash"></i>
                            </button>
                            <form id="del-{{ $a->id }}" action="{{ route('attendance.destroy', $a) }}" method="POST" class="d-none">
                                @csrf @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada data absensi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="photoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;overflow:hidden;">
            <div class="modal-header border-0"><h5 class="modal-title fw-bold">Foto Selfie — <span id="photo-type"></span></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body p-0 text-center"><img id="modal-photo" style="width:100%;max-height:500px;object-fit:contain;"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    function showPhoto(url, type) {
        document.getElementById('modal-photo').src = url;
        document.getElementById('photo-type').textContent = type;
        new bootstrap.Modal(document.getElementById('photoModal')).show();
    }
</script>
@endpush
