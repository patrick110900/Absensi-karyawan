<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Budi Santoso',  'email' => 'budi@absensi.com',  'nip' => 'EMP001', 'jabatan' => 'Software Engineer',   'departemen' => 'IT'],
            ['name' => 'Siti Rahayu',   'email' => 'siti@absensi.com',   'nip' => 'EMP002', 'jabatan' => 'HR Manager',           'departemen' => 'Human Resource'],
            ['name' => 'Ahmad Fauzi',   'email' => 'ahmad@absensi.com',  'nip' => 'EMP003', 'jabatan' => 'Finance Analyst',      'departemen' => 'Finance'],
            ['name' => 'Dewi Lestari',  'email' => 'dewi@absensi.com',   'nip' => 'EMP004', 'jabatan' => 'UI/UX Designer',       'departemen' => 'IT'],
            ['name' => 'Riko Pratama',  'email' => 'riko@absensi.com',   'nip' => 'EMP005', 'jabatan' => 'Marketing Specialist', 'departemen' => 'Marketing'],
        ];

        foreach ($data as $item) {
            $user = User::firstOrCreate(
                ['email' => $item['email']],
                ['name' => $item['name'], 'password' => Hash::make('password'), 'role' => 'karyawan']
            );

            Employee::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nip'           => $item['nip'],
                    'jabatan'       => $item['jabatan'],
                    'departemen'    => $item['departemen'],
                    'tanggal_masuk' => now()->subMonths(rand(6, 36))->toDateString(),
                ]
            );
        }
    }
}
