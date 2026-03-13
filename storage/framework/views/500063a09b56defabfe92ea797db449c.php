<aside class="app-sidebar" id="app-sidebar">

    <?php if(auth()->user()->isAdmin()): ?>
        <p class="sidebar-label">Menu Utama</p>
        <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <p class="sidebar-label mt-2">Manajemen</p>
        <a href="<?php echo e(route('employees.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('employees.*') ? 'active' : ''); ?>">
            <i class="bi bi-people-fill"></i> Data Karyawan
        </a>
        <a href="<?php echo e(route('attendance.admin')); ?>" class="sidebar-link <?php echo e(request()->routeIs('attendance.admin') ? 'active' : ''); ?>">
            <i class="bi bi-calendar-check-fill"></i> Data Absensi
        </a>
        <a href="<?php echo e(route('reports.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('reports.*') ? 'active' : ''); ?>">
            <i class="bi bi-bar-chart-fill"></i> Laporan
        </a>
    <?php else: ?>
        <p class="sidebar-label">Menu Utama</p>
        <a href="<?php echo e(route('dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <p class="sidebar-label mt-2">Absensi</p>
        <a href="<?php echo e(route('attendance.checkin')); ?>" class="sidebar-link <?php echo e(request()->routeIs('attendance.checkin') ? 'active' : ''); ?>">
            <i class="bi bi-camera-fill"></i> Check In / Out
        </a>
        <a href="<?php echo e(route('attendance.history')); ?>" class="sidebar-link <?php echo e(request()->routeIs('attendance.history') ? 'active' : ''); ?>">
            <i class="bi bi-clock-history"></i> Riwayat Absensi
        </a>
    <?php endif; ?>

    <div class="sidebar-footer">
        <div class="sidebar-user-card">
            <div class="sidebar-user-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
            <div style="min-width:0;">
                <div style="color:#fff;font-size:.8rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo e(auth()->user()->name); ?></div>
                <div style="color:rgba(255,255,255,.45);font-size:.7rem;"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
            </div>
        </div>
    </div>
</aside>
<?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/components/sidebar.blade.php ENDPATH**/ ?>