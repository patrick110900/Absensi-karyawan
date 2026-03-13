<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        $userId     = $this->route('employee')?->user_id ?? 'NULL';
        $employeeId = $this->route('employee')?->id ?? 'NULL';

        return [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', "unique:users,email,{$userId}"],
            'password'      => [$this->isMethod('POST') ? 'required' : 'nullable', 'string', 'min:8'],
            'nip'           => ['required', 'string', "unique:employees,nip,{$employeeId}"],
            'jabatan'       => ['required', 'string', 'max:255'],
            'departemen'    => ['required', 'string', 'max:255'],
            'tanggal_masuk' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Nama wajib diisi.',
            'email.required'         => 'Email wajib diisi.',
            'email.unique'           => 'Email sudah terdaftar.',
            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'nip.required'           => 'NIP wajib diisi.',
            'nip.unique'             => 'NIP sudah terdaftar.',
            'jabatan.required'       => 'Jabatan wajib diisi.',
            'departemen.required'    => 'Departemen wajib diisi.',
            'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
        ];
    }
}
