<?php

namespace App\Http\Controllers;

use App\Repositories\AttendanceRepository;
use App\Repositories\EmployeeRepository;

class DashboardController extends Controller
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository,
        private readonly AttendanceRepository $attendanceRepository,
    ) {}

    public function index()
    {
        $stats = [
            'total_karyawan' => $this->employeeRepository->count(),
            ...$this->attendanceRepository->getTodayStats(),
        ];

        $recentAttendances = $this->attendanceRepository->getAllAttendances(today()->toDateString());

        return view('dashboard.index', compact('stats', 'recentAttendances'));
    }
}
