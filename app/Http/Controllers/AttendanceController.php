<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Repositories\AttendanceRepository;
use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(
        private readonly AttendanceService $attendanceService,
        private readonly AttendanceRepository $attendanceRepository,
    ) {}

    public function checkInForm()
    {
        $employee   = auth()->user()->employee;
        $attendance = $this->attendanceService->getTodayAttendance($employee->id);
        return view('attendance.checkin', compact('attendance'));
    }

    public function checkIn(Request $request)
    {
        $request->validate(['selfie' => ['required', 'string'], 'lokasi' => ['nullable', 'string']]);

        try {
            $this->attendanceService->handleCheckIn(auth()->user()->employee, $request->selfie, $request->lokasi);
            return response()->json(['message' => 'Check in berhasil!', 'success' => true]);
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage(), 'success' => false], 422);
        }
    }

    public function checkOut(Request $request)
    {
        $request->validate(['selfie' => ['required', 'string'], 'lokasi' => ['nullable', 'string']]);

        try {
            $this->attendanceService->handleCheckOut(auth()->user()->employee, $request->selfie, $request->lokasi);
            return response()->json(['message' => 'Check out berhasil!', 'success' => true]);
        } catch (\RuntimeException $e) {
            return response()->json(['message' => $e->getMessage(), 'success' => false], 422);
        }
    }

    public function history(Request $request)
    {
        $employee = auth()->user()->employee;
        $history  = $this->attendanceRepository->getAttendanceHistory(
            $employee->id, $request->start_date, $request->end_date
        );
        return view('attendance.history', compact('history'));
    }

    public function adminIndex(Request $request)
    {
        $attendances = $this->attendanceRepository->getAllAttendances($request->date);
        return view('attendance.admin-index', compact('attendances'));
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->back()->with('success', 'Data absensi berhasil dihapus.');
    }
}
