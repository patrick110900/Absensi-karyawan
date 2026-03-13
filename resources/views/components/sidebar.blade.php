<aside class="app-sidebar" id="app-sidebar">

    @if(auth()->user()->isAdmin())
        <p class="sidebar-label">Menu Utama</p>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <p class="sidebar-label mt-2">Manajemen</p>
        <a href="{{ route('employees.index') }}" class="sidebar-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Data Karyawan
        </a>
        <a href="{{ route('attendance.admin') }}" class="sidebar-link {{ request()->routeIs('attendance.admin') ? 'active' : '' }}">
            <i class="bi bi-calendar-check-fill"></i> Data Absensi
        </a>
        <a href="{{ route('reports.index') }}" class="sidebar-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-fill"></i> Laporan
        </a>
    @else
        <p class="sidebar-label">Menu Utama</p>
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i> Dashboard
        </a>

        <p class="sidebar-label mt-2">Absensi</p>
        <a href="{{ route('attendance.checkin') }}" class="sidebar-link {{ request()->routeIs('attendance.checkin') ? 'active' : '' }}">
            <i class="bi bi-camera-fill"></i> Check In / Out
        </a>
        <a href="{{ route('attendance.history') }}" class="sidebar-link {{ request()->routeIs('attendance.history') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Riwayat Absensi
        </a>
    @endif

    <div class="sidebar-footer">
        <div class="sidebar-user-card">
            <div class="sidebar-user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div style="min-width:0;">
                <div style="color:#fff;font-size:.8rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
                <div style="color:rgba(255,255,255,.45);font-size:.7rem;">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
    </div>
</aside>
