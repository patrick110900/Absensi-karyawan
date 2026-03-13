<?php $__env->startSection('title', 'Riwayat Absensi'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-header"><h1>Riwayat Absensi</h1><p>Rekap kehadiran saya</p></div>

<div class="card mb-4 no-print">
    <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4"><label class="form-label">Dari Tanggal</label>
                <input type="date" name="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
            </div>
            <div class="col-md-4"><label class="form-label">Sampai Tanggal</label>
                <input type="date" name="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Filter</button>
                <a href="<?php echo e(route('attendance.history')); ?>" class="btn" style="background:#F1F5F9;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat</span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;"><?php echo e($history->count()); ?> data</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-modern mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Foto Masuk</th>
                        <th>Foto Pulang</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div style="font-weight:600;font-size:.85rem;"><?php echo e($a->tanggal->format('d M Y')); ?></div>
                            <div style="font-size:.75rem;color:#6B7280;"><?php echo e($a->tanggal->isoFormat('dddd')); ?></div>
                        </td>
                        <td>
                            <?php if($a->jam_masuk): ?>
                                <span class="badge" style="background:#ECFDF5;color:#10B981;border-radius:20px;"><?php echo e($a->jam_masuk); ?></span>
                            <?php else: ?> <span class="text-muted">-</span> <?php endif; ?>
                        </td>
                        <td>
                            <?php if($a->jam_pulang): ?>
                                <span class="badge" style="background:#FEF2F2;color:#EF4444;border-radius:20px;"><?php echo e($a->jam_pulang); ?></span>
                            <?php else: ?> <span class="text-muted">-</span> <?php endif; ?>
                        </td>
                        <td>
                            <?php if($a->selfie_masuk): ?>
                                <img src="<?php echo e(asset('storage/' . $a->selfie_masuk)); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:8px;border:2px solid #10B981;cursor:pointer;" onclick="showPhoto('<?php echo e(asset('storage/' . $a->selfie_masuk)); ?>')">
                            <?php else: ?> <span class="text-muted">-</span> <?php endif; ?>
                        </td>
                        <td>
                            <?php if($a->selfie_pulang): ?>
                                <img src="<?php echo e(asset('storage/' . $a->selfie_pulang)); ?>" style="width:40px;height:40px;object-fit:cover;border-radius:8px;border:2px solid #EF4444;cursor:pointer;" onclick="showPhoto('<?php echo e(asset('storage/' . $a->selfie_pulang)); ?>')">
                            <?php else: ?> <span class="text-muted">-</span> <?php endif; ?>
                        </td>
                        <td style="font-size:.775rem;color:#6B7280;max-width:110px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo e($a->lokasi_masuk ?? '-'); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($a->status_badge); ?> bg-opacity-15 text-<?php echo e($a->status_badge); ?>" style="border-radius:20px;padding:.3rem .75rem;font-size:.74rem;"><?php echo e(ucfirst($a->status)); ?></span>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center py-5 text-muted"><i class="bi bi-calendar-x fs-2 d-block mb-2"></i>Belum ada riwayat absensi</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="photoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;overflow:hidden;">
            <div class="modal-header border-0"><h5 class="modal-title fw-bold">Foto Selfie</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body p-0 text-center"><img id="modal-photo" style="width:100%;max-height:500px;object-fit:contain;"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    function showPhoto(url) {
        document.getElementById('modal-photo').src = url;
        new bootstrap.Modal(document.getElementById('photoModal')).show();
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/attendance/history.blade.php ENDPATH**/ ?>