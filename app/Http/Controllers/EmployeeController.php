<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function __construct(private readonly EmployeeRepository $employeeRepository) {}

    public function index()
    {
        $employees = $this->employeeRepository->getAll();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => 'karyawan',
            ]);

            $this->employeeRepository->create([
                'user_id'       => $user->id,
                'nip'           => $request->nip,
                'jabatan'       => $request->jabatan,
                'departemen'    => $request->departemen,
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);
        });

        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(StoreEmployeeRequest $request, Employee $employee)
    {
        DB::transaction(function () use ($request, $employee) {
            $userData = ['name' => $request->name, 'email' => $request->email];
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }
            $employee->user->update($userData);

            $this->employeeRepository->update($employee, [
                'nip'           => $request->nip,
                'jabatan'       => $request->jabatan,
                'departemen'    => $request->departemen,
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);
        });

        return redirect()->route('employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        DB::transaction(fn() => $employee->user->delete());
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil dihapus.');
    }
}
