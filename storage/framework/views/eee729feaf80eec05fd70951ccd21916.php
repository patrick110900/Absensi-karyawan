<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div>
        <h1>Dashboard</h1>
        <p><?php echo e(now()->isoFormat('dddd, D MMMM Y')); ?></p>
    </div>
    <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3 no-print" style="background:#fff;border:1px solid #E5E7EB;font-size:.825rem;color:#6B7280;">
        <i class="bi bi-clock"></i> <span id="clock">--:--:--</span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#EFF6FF;color:#2563EB;"><i class="bi bi-people-fill"></i></div>
            <div class="stat-value" style="color:#2563EB;"><?php echo e($stats['total_karyawan']); ?></div>
            <div class="stat-label">Total Karyawan</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ECFDF5;color:#10B981;"><i class="bi bi-check-circle-fill"></i></div>
            <div class="stat-value" style="color:#10B981;"><?php echo e($stats['hadir']); ?></div>
            <div class="stat-label">Hadir Hari Ini</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FFFBEB;color:#F59E0B;"><i class="bi bi-exclamation-circle-fill"></i></div>
            <div class="stat-value" style="color:#F59E0B;"><?php echo e($stats['izin'] + $stats['sakit']); ?></div>
            <div class="stat-label">Izin / Sakit</div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#FEF2F2;color:#EF4444;"><i class="bi bi-x-circle-fill"></i></div>
            <div class="stat-value" style="color:#EF4444;"><?php echo e($stats['alpha']); ?></div>
            <div class="stat-label">Alpha</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-table me-2 text-primary"></i>Absensi Hari Ini</span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;"><?php echo e($recentAttendances->count()); ?> data</span>
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
                    <?php $__empty_1 = true; $__currentLoopData = $recentAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:34px;height:34px;background:#EFF6FF;border-radius:50%;display:grid;place-items:center;font-weight:700;color:#2563EB;flex-shrink:0;font-size:.82rem;">
                                        <?php echo e(strtoupper(substr($a->employee->user->name, 0, 1))); ?>

                                    </div>
                                    <div>
                                        <div style="font-weight:600;font-size:.85rem;"><?php echo e($a->employee->user->name); ?></div>
                                        <div style="font-size:.75rem;color:#6B7280;"><?php echo e($a->employee->nip); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?php echo e($a->employee->departemen); ?></td>
                            <td><?php echo e($a->jam_masuk ?? '-'); ?></td>
                            <td><?php echo e($a->jam_pulang ?? '-'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($a->status_badge); ?> bg-opacity-15 text-<?php echo e($a->status_badge); ?>" style="border-radius:20px;padding:.3rem .75rem;font-size:.74rem;">
                                    <?php echo e(ucfirst($a->status)); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                Belum ada data absensi hari ini
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    setInterval(() => { document.getElementById('clock').textContent = new Date().toLocaleTimeString('id-ID'); }, 1000);
    document.getElementById('clock').textContent = new Date().toLocaleTimeString('id-ID');
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/dashboard/index.blade.php ENDPATH**/ ?>