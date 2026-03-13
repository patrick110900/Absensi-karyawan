<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Sistem Absensi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --primary:   #2563EB;
            --secondary: #1E293B;
            --success:   #10B981;
            --warning:   #F59E0B;
            --danger:    #EF4444;
            --bg:        #F8FAFC;
            --card:      #FFFFFF;
            --text:      #1F2937;
            --muted:     #6B7280;
            --sidebar-w: 260px;
            --navbar-h:  64px;
        }
        * { font-family: 'Poppins', sans-serif; box-sizing: border-box; }
        body { background: var(--bg); color: var(--text); min-height: 100vh; }

        /* Navbar */
        .app-navbar {
            background: var(--secondary);
            height: var(--navbar-h);
            position: fixed; top:0; left:0; right:0; z-index:1030;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.5rem;
            box-shadow: 0 2px 12px rgba(0,0,0,.3);
        }
        .brand { display:flex; align-items:center; gap:.75rem; color:#fff; text-decoration:none; }
        .brand-icon { width:38px; height:38px; background:var(--primary); border-radius:10px; display:grid; place-items:center; font-size:1.1rem; color:#fff; flex-shrink:0; }
        .brand-name { font-size:.95rem; font-weight:700; line-height:1.2; }
        .brand-sub  { font-size:.7rem; opacity:.5; font-weight:400; }
        .nav-user .dropdown-toggle {
            background: rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.12);
            border-radius:10px; color:#fff; padding:.4rem .9rem; font-size:.85rem;
            display:flex; align-items:center; gap:.5rem; transition:.2s;
        }
        .nav-user .dropdown-toggle:hover { background:rgba(255,255,255,.15); }
        .nav-user .dropdown-toggle::after { display:none; }
        .nav-avatar { width:30px; height:30px; border-radius:50%; background:var(--primary); display:grid; place-items:center; font-size:.8rem; font-weight:700; color:#fff; }

        /* Sidebar */
        .app-sidebar {
            background: var(--secondary);
            width: var(--sidebar-w);
            position: fixed; top:var(--navbar-h); left:0; bottom:0;
            overflow-y: auto; padding: 1rem 0 5rem;
            transition: transform .3s; z-index:1020;
        }
        .app-sidebar::-webkit-scrollbar { width:4px; }
        .app-sidebar::-webkit-scrollbar-thumb { background:rgba(255,255,255,.12); border-radius:2px; }
        .sidebar-label { color:rgba(255,255,255,.35); font-size:.65rem; font-weight:700; text-transform:uppercase; letter-spacing:1px; padding:.75rem 1.25rem .25rem; }
        .sidebar-link {
            display:flex; align-items:center; gap:.75rem; padding:.6rem 1.25rem;
            color:rgba(255,255,255,.65); text-decoration:none; font-size:.855rem; font-weight:500;
            transition:.15s; position:relative;
        }
        .sidebar-link i { font-size:1.05rem; width:20px; flex-shrink:0; }
        .sidebar-link:hover { background:#334155; color:#fff; }
        .sidebar-link.active { background:var(--primary); color:#fff; }
        .sidebar-link.active::before { content:''; position:absolute; left:0; top:0; bottom:0; width:3px; background:rgba(255,255,255,.6); border-radius:0 2px 2px 0; }
        .sidebar-footer { position:absolute; bottom:0; left:0; right:0; padding:.75rem 1rem; background:rgba(0,0,0,.2); }
        .sidebar-user-card { background:rgba(255,255,255,.05); border-radius:10px; padding:.6rem .85rem; display:flex; align-items:center; gap:.65rem; }
        .sidebar-user-avatar { width:32px; height:32px; background:var(--primary); border-radius:50%; display:grid; place-items:center; font-size:.85rem; font-weight:700; color:#fff; flex-shrink:0; }

        /* Main */
        .app-main { margin-left:var(--sidebar-w); margin-top:var(--navbar-h); padding:2rem; min-height:calc(100vh - var(--navbar-h)); }
        .app-footer { margin-left:var(--sidebar-w); padding:.85rem 2rem; background:#fff; border-top:1px solid #E5E7EB; font-size:.775rem; color:var(--muted); display:flex; justify-content:space-between; }

        /* Page header */
        .page-header { margin-bottom:1.75rem; }
        .page-header h1 { font-size:1.5rem; font-weight:700; margin:0; }
        .page-header p { font-size:.875rem; color:var(--muted); margin:.2rem 0 0; }

        /* Cards */
        .card { border:1px solid #E5E7EB; border-radius:14px; box-shadow:0 1px 4px rgba(0,0,0,.05); }
        .card-header { background:#F8FAFC; border-bottom:1px solid #E5E7EB; border-radius:14px 14px 0 0!important; padding:.9rem 1.25rem; font-weight:600; font-size:.875rem; }
        .stat-card { background:#fff; border-radius:14px; padding:1.5rem; border:1px solid #E5E7EB; box-shadow:0 1px 4px rgba(0,0,0,.05); transition:.2s; }
        .stat-card:hover { transform:translateY(-2px); box-shadow:0 6px 16px rgba(0,0,0,.09); }
        .stat-icon { width:48px; height:48px; border-radius:12px; display:grid; place-items:center; font-size:1.25rem; margin-bottom:1rem; }
        .stat-value { font-size:2rem; font-weight:700; line-height:1; margin-bottom:.2rem; }
        .stat-label { font-size:.8rem; color:var(--muted); font-weight:500; }

        /* Tables */
        .table-modern thead th { background:#F1F5F9; color:var(--muted); font-size:.74rem; font-weight:700; text-transform:uppercase; letter-spacing:.5px; border-bottom:none; padding:.85rem 1rem; }
        .table-modern tbody tr:hover td { background:#F8FAFC; }
        .table-modern tbody td { padding:.8rem 1rem; font-size:.875rem; vertical-align:middle; }

        /* Forms */
        .form-control, .form-select { border:1.5px solid #E5E7EB; border-radius:8px; font-size:.875rem; padding:.55rem .85rem; }
        .form-control:focus, .form-select:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(37,99,235,.12); }
        .form-label { font-size:.82rem; font-weight:600; margin-bottom:.35rem; }
        .btn { font-size:.875rem; font-weight:500; border-radius:8px; }
        .btn-primary { background:var(--primary); border-color:var(--primary); }
        .alert { border-radius:10px; font-size:.875rem; }

        /* Camera */
        #camera-preview { width:100%; max-width:400px; border-radius:12px; border:3px solid #E5E7EB; background:#0f172a; }
        #captured-photo { width:100%; max-width:400px; border-radius:12px; border:3px solid var(--success); display:none; }

        /* Responsive */
        @media (max-width:991px) {
            .app-sidebar { transform:translateX(-100%); }
            .app-sidebar.show { transform:translateX(0); }
            .app-main, .app-footer { margin-left:0 !important; }
        }
        @media (max-width:575px) { .app-main { padding:1rem; } }
        @media print { .app-sidebar, .app-navbar, .app-footer, .no-print { display:none!important; } .app-main { margin:0!important; padding:0!important; } }
    </style>
    @stack('styles')
</head>
<body>

{{-- Navbar --}}
@include('components.navbar')

{{-- Sidebar overlay (mobile) --}}
<div id="sidebarOverlay" class="d-none" style="position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1010;" onclick="closeSidebar()"></div>

{{-- Sidebar --}}
@include('components.sidebar')

{{-- Main Content --}}
<div class="app-main">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @yield('content')
</div>

{{-- Footer --}}
@include('components.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function closeSidebar() {
        document.getElementById('app-sidebar').classList.remove('show');
        document.getElementById('sidebarOverlay').classList.add('d-none');
    }
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('app-sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('d-none');
    });
</script>
@stack('scripts')
</body>
</html>
