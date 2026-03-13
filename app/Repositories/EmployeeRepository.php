<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepository
{
    public function __construct(private readonly Employee $model) {}

    public function getAll(): Collection
    {
        return $this->model->with('user')->orderByDesc('created_at')->get();
    }

    public function findById(int $id): ?Employee
    {
        return $this->model->with('user')->find($id);
    }

    public function findByUserId(int $userId): ?Employee
    {
        return $this->model->where('user_id', $userId)->first();
    }

    public function create(array $data): Employee
    {
        return $this->model->create($data);
    }

    public function update(Employee $employee, array $data): bool
    {
        return $employee->update($data);
    }

    public function delete(Employee $employee): bool
    {
        return $employee->delete();
    }

    public function count(): int
    {
        return $this->model->count();
    }
}
