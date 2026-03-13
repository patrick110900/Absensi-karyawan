<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Employee;
use App\Repositories\AttendanceRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AttendanceService
{
    public function __construct(private readonly AttendanceRepository $attendanceRepository) {}

    public function getTodayAttendance(int $employeeId): ?Attendance
    {
        return $this->attendanceRepository->getTodayAttendance($employeeId);
    }

    public function handleCheckIn(Employee $employee, string $selfieBase64, ?string $lokasi = null): Attendance
    {
        if ($this->getTodayAttendance($employee->id)) {
            throw new \RuntimeException('Anda sudah melakukan check in hari ini.');
        }

        $selfiePath = $this->saveSelfie($selfieBase64, $employee->id, 'masuk');

        return $this->attendanceRepository->storeAttendance([
            'employee_id'  => $employee->id,
            'tanggal'      => Carbon::today()->toDateString(),
            'jam_masuk'    => Carbon::now()->format('H:i:s'),
            'selfie_masuk' => $selfiePath,
            'status'       => 'hadir',
            'lokasi_masuk' => $lokasi,
        ]);
    }

    public function handleCheckOut(Employee $employee, string $selfieBase64, ?string $lokasi = null): Attendance
    {
        $attendance = $this->getTodayAttendance($employee->id);

        if (!$attendance) {
            throw new \RuntimeException('Anda belum melakukan check in hari ini.');
        }

        if ($attendance->jam_pulang) {
            throw new \RuntimeException('Anda sudah melakukan check out hari ini.');
        }

        $selfiePath = $this->saveSelfie($selfieBase64, $employee->id, 'pulang');

        $this->attendanceRepository->updateCheckout($attendance, [
            'jam_pulang'    => Carbon::now()->format('H:i:s'),
            'selfie_pulang' => $selfiePath,
            'lokasi_pulang' => $lokasi,
        ]);

        return $attendance->fresh();
    }

    private function saveSelfie(string $base64Image, int $employeeId, string $type): string
    {
        $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $base64Image);
        $imageData = base64_decode($imageData);

        $year     = Carbon::now()->year;
        $month    = Carbon::now()->format('m');
        $folder   = "attendance/{$year}/{$month}";
        $filename = "{$employeeId}_{$type}_" . Carbon::now()->timestamp . ".jpg";
        $path     = "{$folder}/{$filename}";

        Storage::disk('public')->put($path, $imageData);

        return $path;
    }
}
