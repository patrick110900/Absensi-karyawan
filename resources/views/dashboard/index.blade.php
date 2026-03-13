@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1>Dashboard</h1>
        <p>{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3 no-print" style="background:#fff;border:1px solid #E5E7EB;font-size:.825rem;color:#6B7280;">
        <i class="bi bi-clock"></i> <span id="clock">--:--:--</span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#EFF6FF;color:#2563EB;"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value" style="color:#2563EB;">{{ $stats['total_karyawan'] }}</div>
            <div class="stat-label">Total Karyawan</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ECFDF5;color:#10B981;"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-value" style="color:#10B981;">{{ $stats['hadir'] }}</div>
            <div class="stat-label">Hadir Hari Ini</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FFFBEB;color:#F59E0B;"><i class="bi bi-exclamation-circle-fill"></i></div>
            <div class="stat-value" style="color:#F59E0B;">{{ $stats['izin'] + $stats['sakit'] }}</div>
            <div class="stat-label">Izin / Sakit</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FEF2F2;color:#EF4444;"><i class="bi bi-x-circle-fill"></i></div>
            <div class="stat-value" style="color:#EF4444;">{{ $stats['alpha'] }}</div>
            <div class="stat-label">Alpha</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-table me-2 text-primary"></i>Absensi Hari Ini</span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;">{{ $recentAttendances->count() }} data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Departemen</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentAttendances as $a)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:34px;height:34px;background:#EFF6FF;border-radius:50%;display:grid;place-items:center;font-weight:700;color:#2563EB;flex-shrink:0;font-size:.82rem;">
                                        {{ strtoupper(substr($a->employee->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div style="font-weight:600;font-size:.85rem;">{{ $a->employee->user->name }}</div>
                                        <div style="font-size:.75rem;color:#6B7280;">{{ $a->employee->nip }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $a->employee->departemen }}</td>
                            <td>{{ $a->jam_masuk ?? '-' }}</td>
                            <td>{{ $a->jam_pulang ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $a->status_badge }} bg-opacity-15 text-{{ $a->status_badge }}" style="border-radius:20px;padding:.3rem .75rem;font-size:.74rem;">
                                    {{ ucfirst($a->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data absensi hari ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    setInterval(() => { document.getElementById('clock').textContent = new Date().toLocaleTimeString('id-ID'); }, 1000);
    document.getElementById('clock').textContent = new Date().toLocaleTimeString('id-ID');
</script>
@endpush
