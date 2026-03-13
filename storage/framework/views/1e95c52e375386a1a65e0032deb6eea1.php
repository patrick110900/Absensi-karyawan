<header class="app-navbar">
    <div class="d-flex align-items-center gap-3">
        <button id="sidebarToggle" class="d-lg-none btn btn-sm" style="color:#fff;background:rgba(255,255,255,.1);border:none;border-radius:8px;">
            <i class="bi bi-list fs-5"></i>
        </button>
        <a href="<?php echo e(route('dashboard')); ?>" class="brand">
            <div class="brand-icon"><i class="bi bi-fingerprint"></i></div>
            <div>
                <div class="brand-name">Sistem Absensi</div>
                <div class="brand-sub">HR Management System</div>
            </div>
        </a>
    </div>

    <div class="nav-user">
        <div class="dropdown">
            <button class="dropdown-toggle" data-bs-toggle="dropdown">
                <div class="nav-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
                <div class="d-none d-md-block text-start">
                    <div style="font-size:.83rem;font-weight:600;line-height:1.3;"><?php echo e(auth()->user()->name); ?></div>
                    <div style="font-size:.7rem;opacity:.6;"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
                </div>
                <i class="bi bi-chevron-down" style="font-size:.7rem;opacity:.6;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end mt-2" style="border-radius:12px;border:1px solid #E5E7EB;min-width:200px;box-shadow:0 8px 30px rgba(0,0,0,.12);">
                <li>
                    <div class="px-3 py-2 border-bottom">
                        <div style="font-weight:600;font-size:.85rem;"><?php echo e(auth()->user()->name); ?></div>
                        <div style="font-size:.775rem;color:#6B7280;"><?php echo e(auth()->user()->email); ?></div>
                    </div>
                </li>
                <li>
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2 py-2 px-3 text-danger" style="font-size:.85rem;">
                            <i class="bi bi-box-arrow-right"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/components/navbar.blade.php ENDPATH**/ ?>