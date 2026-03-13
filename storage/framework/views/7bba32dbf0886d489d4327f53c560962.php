<?php $__env->startSection('title', 'Absensi'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-header">
    <h1>Absensi Karyawan</h1>
    <p><?php echo e(now()->isoFormat('dddd, D MMMM Y')); ?></p>
</div>

<div class="row g-4">
    
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-header"><i class="bi bi-camera-fill me-2 text-primary"></i>Kamera Selfie</div>
            <div class="card-body d-flex flex-column align-items-center p-4">
                <div class="w-100 text-center mb-3">
                    <video id="camera-preview" autoplay playsinline></video>
                    <img id="captured-photo" alt="Selfie">
                </div>

                <div class="d-flex gap-2 flex-wrap justify-content-center mb-3">
                    <button id="btn-start" class="btn" style="background:#F1F5F9;" onclick="startCamera()">
                        <i class="bi bi-camera-video me-1"></i> Aktifkan Kamera
                    </button>
                    <button id="btn-capture" class="btn btn-primary" onclick="capturePhoto()" style="display:none;">
                        <i class="bi bi-camera me-1"></i> Ambil Foto
                    </button>
                    <button id="btn-retake" class="btn" style="background:#F1F5F9;display:none;" onclick="retakePhoto()">
                        <i class="bi bi-arrow-repeat me-1"></i> Ulangi
                    </button>
                </div>

                <canvas id="canvas" class="d-none"></canvas>
                <input type="hidden" id="selfie-data">

                <div class="w-100 px-3 py-2 rounded-3 mt-1" style="background:#F8FAFC;border:1px solid #E5E7EB;font-size:.775rem;color:#6B7280;">
                    <i class="bi bi-geo-alt me-1"></i><span id="loc-text">Mendapatkan lokasi GPS...</span>
                </div>
                <input type="hidden" id="loc-data">
            </div>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-header"><i class="bi bi-info-circle me-2 text-primary"></i>Status Absensi Hari Ini</div>
            <div class="card-body p-4">
                <?php if($attendance): ?>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div style="width:52px;height:52px;background:#ECFDF5;border-radius:50%;display:grid;place-items:center;font-size:1.4rem;color:#10B981;flex-shrink:0;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;">Sudah Check In</div>
                            <div style="color:#6B7280;font-size:.85rem;">Jam <?php echo e($attendance->jam_masuk); ?></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div style="background:#F8FAFC;border-radius:10px;padding:1rem;border:1px solid #E5E7EB;">
                                <div style="font-size:.74rem;color:#6B7280;margin-bottom:.2rem;">Jam Masuk</div>
                                <div style="font-weight:700;font-size:1.1rem;color:#10B981;"><?php echo e($attendance->jam_masuk ?? '-'); ?></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background:#F8FAFC;border-radius:10px;padding:1rem;border:1px solid #E5E7EB;">
                                <div style="font-size:.74rem;color:#6B7280;margin-bottom:.2rem;">Jam Pulang</div>
                                <div style="font-weight:700;font-size:1.1rem;color:<?php echo e($attendance->jam_pulang ? '#EF4444' : '#9CA3AF'); ?>;">
                                    <?php echo e($attendance->jam_pulang ?? 'Belum'); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if(!$attendance->jam_pulang): ?>
                        <button class="btn w-100 py-3" style="background:#EF4444;color:#fff;border-radius:12px;font-weight:700;" onclick="submit('checkout')">
                            <i class="bi bi-box-arrow-right me-2"></i>Check Out Sekarang
                        </button>
                    <?php else: ?>
                        <div class="alert alert-success mb-0"><i class="bi bi-check-circle-fill me-2"></i>Absensi hari ini sudah lengkap!</div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-3 mb-4">
                        <div style="width:64px;height:64px;background:#FEF2F2;border-radius:50%;display:grid;place-items:center;font-size:1.5rem;color:#EF4444;margin:0 auto 1rem;">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div style="font-weight:700;">Belum Check In</div>
                        <div style="color:#6B7280;font-size:.85rem;">Anda belum absen hari ini</div>
                    </div>
                    <button class="btn w-100 py-3" style="background:#10B981;color:#fff;border-radius:12px;font-weight:700;" onclick="submit('checkin')">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Check In Sekarang
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <div style="background:#EFF6FF;border-radius:12px;padding:1rem 1.25rem;">
            <div style="font-weight:600;color:#2563EB;font-size:.85rem;margin-bottom:.5rem;"><i class="bi bi-lightbulb me-1"></i>Panduan</div>
            <ul style="font-size:.8rem;color:#374151;margin:0;padding-left:1.1rem;">
                <li>Aktifkan kamera dan pastikan wajah terlihat jelas</li>
                <li>Ambil foto selfie sebelum check in / check out</li>
                <li>Izinkan akses GPS untuk mencatat lokasi</li>
                <li>Check in hanya bisa dilakukan satu kali per hari</li>
            </ul>
        </div>
    </div>
</div>


<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toast" class="toast align-items-center border-0" style="border-radius:12px;">
        <div class="d-flex">
            <div class="toast-body" id="toast-msg"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let stream = null;

    // GPS
    navigator.geolocation?.getCurrentPosition(
        p => {
            const val = `${p.coords.latitude.toFixed(6)},${p.coords.longitude.toFixed(6)}`;
            document.getElementById('loc-text').textContent = 'Lokasi: ' + val;
            document.getElementById('loc-data').value = val;
        },
        () => { document.getElementById('loc-text').textContent = 'Lokasi tidak tersedia'; }
    );

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false });
            document.getElementById('camera-preview').srcObject = stream;
            document.getElementById('camera-preview').style.display = '';
            document.getElementById('btn-start').style.display = 'none';
            document.getElementById('btn-capture').style.display = '';
        } catch (e) {
            showToast('Gagal akses kamera: ' + e.message, 'danger');
        }
    }

    function capturePhoto() {
        const v = document.getElementById('camera-preview');
        const c = document.getElementById('canvas');
        c.width = v.videoWidth; c.height = v.videoHeight;
        c.getContext('2d').drawImage(v, 0, 0);
        const url = c.toDataURL('image/jpeg', 0.85);
        document.getElementById('captured-photo').src = url;
        document.getElementById('captured-photo').style.display = '';
        v.style.display = 'none';
        document.getElementById('selfie-data').value = url;
        document.getElementById('btn-capture').style.display = 'none';
        document.getElementById('btn-retake').style.display = '';
        if (stream) stream.getTracks().forEach(t => t.stop());
    }

    function retakePhoto() {
        document.getElementById('captured-photo').style.display = 'none';
        document.getElementById('camera-preview').style.display = '';
        document.getElementById('selfie-data').value = '';
        document.getElementById('btn-retake').style.display = 'none';
        startCamera();
    }

    async function submit(type) {
        const selfie = document.getElementById('selfie-data').value;
        if (!selfie) { showToast('Ambil foto selfie dulu!', 'warning'); return; }

        const url = type === 'checkin'
            ? '<?php echo e(route("attendance.do-checkin")); ?>'
            : '<?php echo e(route("attendance.do-checkout")); ?>';

        const res  = await fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
            body: JSON.stringify({ selfie, lokasi: document.getElementById('loc-data').value }),
        });
        const data = await res.json();
        showToast(data.message, data.success ? 'success' : 'danger');
        if (data.success) setTimeout(() => location.reload(), 1500);
    }

    function showToast(msg, type) {
        const t = document.getElementById('toast');
        const colors = { success: '#10B981', danger: '#EF4444', warning: '#F59E0B' };
        t.style.background = colors[type] || '#2563EB';
        t.style.color = '#fff';
        document.getElementById('toast-msg').textContent = msg;
        new bootstrap.Toast(t, { delay: 3000 }).show();
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\SIMRS\Downloads\absensi-karyawan\resources\views/attendance/checkin.blade.php ENDPATH**/ ?>