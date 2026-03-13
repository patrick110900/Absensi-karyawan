<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', Carbon::now()->format('Y-m'));
        [$year, $monthNum] = explode('-', $month);

        $employees = Employee::with(['user', 'attendances' => function ($q) use ($year, $monthNum) {
            $q->whereYear('tanggal', $year)->whereMonth('tanggal', $monthNum);
        }])->get();

        $summary = $employees->map(fn($emp) => [
            'employee' => $emp,
            'hadir'    => $emp->attendances->where('status', 'hadir')->count(),
            'izin'     => $emp->attendances->where('status', 'izin')->count(),
            'sakit'    => $emp->attendances->where('status', 'sakit')->count(),
            'alpha'    => $emp->attendances->where('status', 'alpha')->count(),
            'total'    => $emp->attendances->count(),
        ]);

        return view('reports.index', compact('summary', 'month'));
    }
}
