<?php $__env->startSection('title', 'Laporan Absensi'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div><h1>Laporan Absensi</h1><p>Rekap kehadiran per bulan</p></div>
    <button onclick="window.print()" class="btn no-print" style="background:#F1F5F9;"><i class="bi bi-printer me-1"></i>Cetak</button>
</div>

<div class="card mb-4 no-print">
    <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4"><label class="form-label">Pilih Bulan</label>
                <input type="month" name="month" class="form-control" value="<?php echo e($month); ?>">
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
        Laporan Bulan <?php echo e(\Carbon\Carbon::parse($month . '-01')->isoFormat('MMMM Y')); ?>

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
                    <?php $__empty_1 = true; $__currentLoopData = $summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $pct = $row['total'] > 0 ? round($row['hadir'] / $row['total'] * 100) : 0;
                        $barColor = $pct >= 90 ? '#10B981' : ($pct >= 70 ? '#F59E0B' : '#EF4444');
                    ?>
                    <tr>
                        <td>
                            <div style="font-weight:600;font-size:.875rem;"><?php echo e($row['employee']->user->name); ?></div>
                            <div style="font-size:.775rem;color:#6B7280;"><?php echo e($row['employee']->nip); ?></div>
                        </td>
                        <td style="font-size:.825rem;"><?php echo e($row['employee']->departemen); ?></td>
                        <td class="text-center"><span class="badge" style="background:#ECFDF5;color:#10B981;min-width:32px;"><?php echo e($row['hadir']); ?></span></td>
                        <td class="text-center"><span class="badge" style="background:#FFFBEB;color:#F59E0B;min-width:32px;"><?php echo e($row['izin']); ?></span></td>
                        <td class="text-center"><span class="badge" style="background:#EFF6FF;color:#3B82F6;min-width:32px;"><?php echo e($row['sakit']); ?></span></td>
                        <td class="text-center"><span class="badge" style="background:#FEF2F2;color:#EF4444;min-width:32px;"><?php echo e($row['alpha']); ?></span></td>
                        <td class="text-center" style="font-weight:600;"><?php echo e($row['total']); ?></td>
                        <td style="min-width:120px;">
                            <div style="font-weight:700;color:<?php echo e($barColor); ?>;font-size:.875rem;"><?php echo e($pct); ?>%</div>
                            <div style="background:#F1F5F9;border-radius:10px;height:5px;margin-top:4px;">
                                <div style="background:<?php echo e($barColor); ?>;border-radius:10px;height:5px;width:<?php echo e($pct); ?>%;transition:.3s;"></div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="bi bi-bar-chart fs-2 d-block mb-2"></i>Tidak ada data laporan</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/reports/index.blade.php ENDPATH**/ ?>