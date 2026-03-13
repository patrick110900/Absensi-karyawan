@extends('layouts.app')
@section('title', 'Laporan Absensi')
@section('content')

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div><h1>Laporan Absensi</h1><p>Rekap kehadiran per bulan</p></div>
    <button onclick="window.print()" class="btn no-print" style="background:#F1F5F9;"><i class="bi bi-printer me-1"></i>Cetak</button>
</div>

<div class="card mb-4 no-print">
    <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4"><label class="form-label">Pilih Bulan</label>
                <input type="month" name="month" class="form-control" value="{{ $month }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Tampilkan</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-bar-chart-line me-2 text-primary"></i>
        Laporan Bulan {{ \Carbon\Carbon::parse($month . '-01')->isoFormat('MMMM Y') }}
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Karyawan</th>
                        <th>Dept.</th>
                        <th class="text-center" style="color:#10B981;">Hadir</th>
                        <th class="text-center" style="color:#F59E0B;">Izin</th>
                        <th class="text-center" style="color:#3B82F6;">Sakit</th>
                        <th class="text-center" style="color:#EF4444;">Alpha</th>
                        <th class="text-center">Total</th>
                        <th>% Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($summary as $row)
                    @php
                        $pct = $row['total'] > 0 ? round($row['hadir'] / $row['total'] * 100) : 0;
                        $barColor = $pct >= 90 ? '#10B981' : ($pct >= 70 ? '#F59E0B' : '#EF4444');
                    @endphp
                    <tr>
                        <td>
                            <div style="font-weight:600;font-size:.875rem;">{{ $row['employee']->user->name }}</div>
                            <div style="font-size:.775rem;color:#6B7280;">{{ $row['employee']->nip }}</div>
                        </td>
                        <td style="font-size:.825rem;">{{ $row['employee']->departemen }}</td>
                        <td class="text-center"><span class="badge" style="background:#ECFDF5;color:#10B981;min-width:32px;">{{ $row['hadir'] }}</span></td>
                        <td class="text-center"><span class="badge" style="background:#FFFBEB;color:#F59E0B;min-width:32px;">{{ $row['izin'] }}</span></td>
                        <td class="text-center"><span class="badge" style="background:#EFF6FF;color:#3B82F6;min-width:32px;">{{ $row['sakit'] }}</span></td>
                        <td class="text-center"><span class="badge" style="background:#FEF2F2;color:#EF4444;min-width:32px;">{{ $row['alpha'] }}</span></td>
                        <td class="text-center" style="font-weight:600;">{{ $row['total'] }}</td>
                        <td style="min-width:120px;">
                            <div style="font-weight:700;color:{{ $barColor }};font-size:.875rem;">{{ $pct }}%</div>
                            <div style="background:#F1F5F9;border-radius:10px;height:5px;margin-top:4px;">
                                <div style="background:{{ $barColor }};border-radius:10px;height:5px;width:{{ $pct }}%;transition:.3s;"></div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="bi bi-bar-chart fs-2 d-block mb-2"></i>Tidak ada data laporan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
