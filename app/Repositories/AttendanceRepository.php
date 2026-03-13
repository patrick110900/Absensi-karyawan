<?php

namespace App\Repositories;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AttendanceRepository
{
    public function __construct(private readonly Attendance $model) {}

    public function getTodayAttendance(int $employeeId): ?Attendance
    {
        return $this->model
            ->where('employee_id', $employeeId)
            ->whereDate('tanggal', Carbon::today())
            ->first();
    }

    public function storeAttendance(array $data): Attendance
    {
        return $this->model->create($data);
    }

    public function updateCheckout(Attendance $attendance, array $data): bool
    {
        return $attendance->update($data);
    }

    public function getAttendanceHistory(int $employeeId, ?string $startDate = null, ?string $endDate = null): Collection
    {
        return $this->model
            ->where('employee_id', $employeeId)
            ->when($startDate, fn($q) => $q->whereDate('tanggal', '>=', $startDate))
            ->when($endDate,   fn($q) => $q->whereDate('tanggal', '<=', $endDate))
            ->orderByDesc('tanggal')
            ->get();
    }

    public function getAllAttendances(?string $date = null): Collection
    {
        return $this->model
            ->with(['employee.user'])
            ->when($date, fn($q) => $q->whereDate('tanggal', $date))
            ->orderByDesc('tanggal')
            ->get();
    }

    public function getTodayStats(): array
    {
        $today = Carbon::today()->toDateString();

        return [
            'hadir' => $this->model->whereDate('tanggal', $today)->where('status', 'hadir')->count(),
            'izin'  => $this->model->whereDate('tanggal', $today)->where('status', 'izin')->count(),
            'sakit' => $this->model->whereDate('tanggal', $today)->where('status', 'sakit')->count(),
            'alpha' => $this->model->whereDate('tanggal', $today)->where('status', 'alpha')->count(),
        ];
    }
}
