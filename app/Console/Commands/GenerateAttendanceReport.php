<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateAttendanceReport extends Command
{
    protected $signature = 'attendance:generate-report {--date= : Tanggal laporan format Y-m-d, default hari ini}';

    protected $description = 'Generate laporan absensi harian';

    public function handle(): int
    {
        $date = $this->option('date')
            ? Carbon::parse($this->option('date'))
            : Carbon::today();

        $this->info("📋 Laporan Absensi: {$date->isoFormat('dddd, D MMMM Y')}");
        $this->newLine();

        $employees = Employee::with([
            'user',
            'attendances' => fn($q) => $q->whereDate('tanggal', $date),
        ])->get();

        $totalEmp = $employees->count();
        $hadir    = $employees->filter(fn($e) => $e->attendances->where('status', 'hadir')->count() > 0)->count();
        $izin     = $employees->filter(fn($e) => $e->attendances->where('status', 'izin')->count() > 0)->count();
        $sakit    = $employees->filter(fn($e) => $e->attendances->where('status', 'sakit')->count() > 0)->count();
        $alpha    = $totalEmp - $hadir - $izin - $sakit;

        $this->table(['Metrik', 'Jumlah'], [
            ['Total Karyawan', $totalEmp],
            ['✅ Hadir',       $hadir],
            ['📝 Izin',        $izin],
            ['🏥 Sakit',       $sakit],
            ['❌ Alpha',       max(0, $alpha)],
        ]);

        $this->newLine();

        $rows = $employees->map(fn($emp) => [
            $emp->nip,
            $emp->user->name,
            $emp->departemen,
            $emp->jabatan,
            $emp->attendances->first()?->jam_masuk  ?? '-',
            $emp->attendances->first()?->jam_pulang ?? '-',
            strtoupper($emp->attendances->first()?->status ?? 'alpha'),
        ]);

        $this->table(
            ['NIP', 'Nama', 'Departemen', 'Jabatan', 'Jam Masuk', 'Jam Pulang', 'Status'],
            $rows
        );

        $this->newLine();
        $this->info('✅ Laporan selesai dibuat!');

        return Command::SUCCESS;
    }
}
