<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'tanggal', 'jam_masuk', 'jam_pulang',
        'selfie_masuk', 'selfie_pulang', 'status',
        'lokasi_masuk', 'lokasi_pulang',
    ];

    protected $casts = ['tanggal' => 'date'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /**
     * Returns Bootstrap color class based on attendance status.
     */
    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'hadir' => 'success',
            'izin'  => 'warning',
            'sakit' => 'info',
            'alpha' => 'danger',
            default => 'secondary',
        };
    }
}
