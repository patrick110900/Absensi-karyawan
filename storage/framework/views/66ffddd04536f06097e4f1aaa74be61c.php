<?php $__env->startSection('title', 'Data Karyawan'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
    <div><h1>Data Karyawan</h1><p>Kelola seluruh data karyawan</p></div>
    <a href="<?php echo e(route('employees.create')); ?>" class="btn btn-primary no-print">
        <i class="bi bi-plus-lg me-1"></i> Tambah Karyawan
    </a>
</div>

<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people me-2 text-primary"></i>Daftar Karyawan</span>
        <span class="badge" style="background:#EFF6FF;color:#2563EB;"><?php echo e($employees->count()); ?></span>
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
                    <?php $__empty_1 = true; $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width:38px;height:38px;background:#EFF6FF;border-radius:50%;display:grid;place-items:center;font-weight:700;color:#2563EB;flex-shrink:0;">
                                    <?php echo e(strtoupper(substr($emp->user->name, 0, 1))); ?>

                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:.875rem;"><?php echo e($emp->user->name); ?></div>
                                    <div style="font-size:.775rem;color:#6B7280;"><?php echo e($emp->user->email); ?></div>
                                </div>
                            </div>
                        </td>
                        <td><code style="background:#F1F5F9;padding:.2rem .5rem;border-radius:5px;font-size:.8rem;"><?php echo e($emp->nip); ?></code></td>
                        <td style="font-size:.85rem;"><?php echo e($emp->jabatan); ?></td>
                        <td><span style="background:#F1F5F9;color:#374151;padding:.2rem .6rem;border-radius:20px;font-size:.775rem;"><?php echo e($emp->departemen); ?></span></td>
                        <td style="font-size:.825rem;"><?php echo e($emp->tanggal_masuk->format('d M Y')); ?></td>
                        <td class="text-center no-print">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="<?php echo e(route('employees.edit', $emp)); ?>" class="btn btn-sm" style="background:#EFF6FF;color:#2563EB;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-sm" style="background:#FEF2F2;color:#EF4444;"
                                        onclick="if(confirm('Hapus karyawan <?php echo e(addslashes($emp->user->name)); ?>?')) document.getElementById('del-<?php echo e($emp->id); ?>').submit()">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            <form id="del-<?php echo e($emp->id); ?>" action="<?php echo e(route('employees.destroy', $emp)); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-people fs-2 d-block mb-2"></i>Belum ada data karyawan</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/employees/index.blade.php ENDPATH**/ ?>