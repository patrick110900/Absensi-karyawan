<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistem Absensi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
        }
        .login-wrap { width:100%; max-width:420px; padding:1rem; }
        .login-card { background:#fff; border-radius:20px; padding:2.5rem; box-shadow:0 25px 60px rgba(0,0,0,.4); }
        .login-logo { width:58px; height:58px; background:#2563EB; border-radius:16px; display:grid; place-items:center; font-size:1.6rem; color:#fff; margin:0 auto 1.25rem; }
        .form-control { border:1.5px solid #E5E7EB; border-radius:10px; padding:.6rem 1rem; font-size:.875rem; }
        .form-control:focus { border-color:#2563EB; box-shadow:0 0 0 3px rgba(37,99,235,.12); }
        .btn-login { background:#2563EB; color:#fff; border:none; border-radius:10px; padding:.7rem; font-weight:600; width:100%; font-size:.9rem; transition:.2s; }
        .btn-login:hover { background:#1d4ed8; transform:translateY(-1px); }
        .demo-box { background:#F8FAFC; border:1.5px solid #E5E7EB; border-radius:12px; padding:.85rem 1rem; font-size:.775rem; color:#6B7280; }
        .input-icon-wrap { position:relative; }
        .input-icon { position:absolute; left:.85rem; top:50%; transform:translateY(-50%); color:#9CA3AF; }
        .input-icon-wrap input { padding-left:2.5rem; }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="login-card">
        <div class="login-logo"><i class="bi bi-fingerprint"></i></div>
        <h1 class="text-center fw-bold mb-1" style="font-size:1.5rem;">Selamat Datang</h1>
        <p class="text-center text-muted mb-4" style="font-size:.85rem;">Masuk ke Sistem Absensi Karyawan</p>

        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3" style="border-radius:10px;font-size:.825rem;">
                <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold" style="font-size:.82rem;">Email</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                           placeholder="admin@absensi.com" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold" style="font-size:.82rem;">Password</label>
                <div class="input-icon-wrap">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" id="pwdInput" class="form-control"
                           placeholder="••••••••" required style="padding-left:2.5rem;padding-right:2.75rem;">
                    <button type="button" onclick="togglePwd()"
                            style="position:absolute;right:.75rem;top:50%;transform:translateY(-50%);background:none;border:none;padding:0;color:#9CA3AF;">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-login mb-4">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="demo-box">
            <div class="fw-semibold mb-1" style="color:#374151;font-size:.8rem;">🔑 Demo Akun</div>
            <div class="d-flex justify-content-between mb-1">
                <span><b>Admin</b> — admin@absensi.com</span>
                <span>password</span>
            </div>
            <div class="d-flex justify-content-between">
                <span><b>Karyawan</b> — budi@absensi.com</span>
                <span>password</span>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePwd() {
        const i = document.getElementById('pwdInput');
        const e = document.getElementById('eyeIcon');
        const isText = i.type === 'text';
        i.type = isText ? 'password' : 'text';
        e.className = isText ? 'bi bi-eye' : 'bi bi-eye-slash';
    }
</script>
</body>
</html>
