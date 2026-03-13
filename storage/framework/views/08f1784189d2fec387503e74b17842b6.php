<?php $__env->startSection('title', 'Data Absensi'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-header"><h1>Data Absensi</h1><p>Kelola seluruh data absensi karyawan</p></div>

<div class="card mb-4 no-print">
    <div class="card-body p-3">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4"><label class="form-label">Filter Tanggal</label>
                <input type="date" name="date" class="form-control" value="<?php echo e(request('date', today()->toDateString())); ?>">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-filter me-1"></i>Filter</button>
                <a href="<?php echo e(route('attendance.admin')); ?>" class="btn" style="background:#F1F5F9;">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-calendar-check me-2 text-primary"></i>
            Absensi — <?php echo e(request('date') ? \Carbon\Carbon::parse(request('date'))->isoFormat('D MMMM Y') : 'Semua'); ?>

        </span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;"><?php echo e($attendances->count()); ?> data</span>
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
                    <?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div style="font-weight:600;font-size:.85rem;"><?php echo e($a->employee->user->name); ?></div>
                            <div style="font-size:.75rem;color:#6B7280;"><?php echo e($a->employee->departemen); ?></div>
                        </td>
                        <td style="font-size:.825rem;"><?php echo e($a->tanggal->format('d M Y')); ?></td>
                        <td>
                            <?php if($a->jam_masuk): ?><span class="badge" style="background:#ECFDF5;color:#10B981;border-radius:20px;"><?php echo e($a->jam_masuk); ?></span>
                            <?php else: ?><span class="text-muted">-</span><?php endif; ?>
                        </td>
                        <td>
                            <?php if($a->jam_pulang): ?><span class="badge" style="background:#FEF2F2;color:#EF4444;border-radius:20px;"><?php echo e($a->jam_pulang); ?></span>
                            <?php else: ?><span class="text-muted">-</span><?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <?php if($a->selfie_masuk): ?>
                                    <img src="<?php echo e(asset('storage/' . $a->selfie_masuk)); ?>" style="width:36px;height:36px;border-radius:6px;object-fit:cover;border:2px solid #10B981;cursor:pointer;" onclick="showPhoto('<?php echo e(asset('storage/' . $a->selfie_masuk)); ?>','Masuk')">
                                <?php endif; ?>
                                <?php if($a->selfie_pulang): ?>
                                    <img src="<?php echo e(asset('storage/' . $a->selfie_pulang)); ?>" style="width:36px;height:36px;border-radius:6px;object-fit:cover;border:2px solid #EF4444;cursor:pointer;" onclick="showPhoto('<?php echo e(asset('storage/' . $a->selfie_pulang)); ?>','Pulang')">
                                <?php endif; ?>
                                <?php if(!$a->selfie_masuk && !$a->selfie_pulang): ?><span class="text-muted">-</span><?php endif; ?>
                            </div>
                        </td>
                        <td style="font-size:.775rem;color:#6B7280;max-width:100px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo e($a->lokasi_masuk ?? '-'); ?></td>
                        <td>
                            <span class="badge bg-<?php echo e($a->status_badge); ?> bg-opacity-15 text-<?php echo e($a->status_badge); ?>" style="border-radius:20px;padding:.3rem .75rem;font-size:.74rem;"><?php echo e(ucfirst($a->status)); ?></span>
                        </td>
                        <td class="text-center no-print">
                            <button class="btn btn-sm" style="background:#FEF2F2;color:#EF4444;"
                                    onclick="if(confirm('Hapus data absensi ini?')) document.getElementById('del-<?php echo e($a->id); ?>').submit()">
                                <i class="bi bi-trash"></i>
                            </button>
                            <form id="del-<?php echo e($a->id); ?>" action="<?php echo e(route('attendance.destroy', $a)); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="8" class="text-center py-5 text-muted"><i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada data absensi</td></tr>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    function showPhoto(url, type) {
        document.getElementById('modal-photo').src = url;
        document.getElementById('photo-type').textContent = type;
        new bootstrap.Modal(document.getElementById('photoModal')).show();
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/attendance/admin-index.blade.php ENDPATH**/ ?>