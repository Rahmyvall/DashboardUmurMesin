<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class MaintenanceSchedule extends Model
{
    use HasFactory;

    protected $table = 'maintenance_schedules';

    protected $fillable = [
        'machine_id',
        'interval_hours',
        'last_maintenance_hours',
        'next_maintenance_hours',
        'status',
    ];

    protected $casts = [
        'interval_hours'          => 'integer',
        'last_maintenance_hours'  => 'decimal:2',
        'next_maintenance_hours'  => 'decimal:2',
        'created_at'              => 'datetime',
        'updated_at'              => 'datetime',
        'status'                  => 'string',
    ];

    /**
     * Relasi ke Machine
     */
    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    // ======================
    // SCOPE & HELPER METHODS
    // ======================

    /**
     * Scope untuk mendapatkan schedule yang sudah harus maintenance (overdue)
     */
    public function scopeOverdue($query)
    {
        return $query->where('next_maintenance_hours', '<=', now()->format('Y-m-d H:i:s'));
        // Sesuaikan jika next_maintenance_hours adalah akumulasi jam operasi, bukan tanggal
    }

    /**
     * Scope untuk schedule yang akan segera maintenance (misal dalam 50 jam lagi)
     */
    public function scopeUpcoming($query, $withinHours = 50)
    {
        return $query->where('next_maintenance_hours', '<=',
            DB::raw("last_maintenance_hours + {$withinHours} + interval_hours")
        );
    }

    /**
     * Cek apakah maintenance sudah overdue
     */
    public function isOverdue(): bool
    {
        // Jika next_maintenance_hours adalah target jam operasi
        return $this->next_maintenance_hours <= $this->getCurrentMachineHours();
    }

    /**
     * Hitung sisa jam sampai maintenance berikutnya
     */
    public function hoursUntilNextMaintenance(): float
    {
        $currentHours = $this->getCurrentMachineHours();
        return max(0, $this->next_maintenance_hours - $currentHours);
    }

    /**
     * Update last & next maintenance setelah maintenance dilakukan
     */
    public function completeMaintenance(float $currentMachineHours): bool
    {
        $this->last_maintenance_hours = $currentMachineHours;
        $this->next_maintenance_hours = $currentMachineHours + $this->interval_hours;

        return $this->save();
    }

    /**
     * Helper untuk mendapatkan total jam operasi mesin saat ini
     * (Kamu bisa override atau inject logic sesuai sistem kamu)
     */
    protected function getCurrentMachineHours(): float
    {
        // Contoh: ambil dari relasi machine
        return $this->machine?->total_operating_hours ?? 0;
    }

    // ======================
    // ACCESSORS & MUTATORS
    // ======================

    /**
     * Accessor: Status Maintenance
     */
    public function getMaintenanceStatusAttribute(): string
    {
        $remaining = $this->hoursUntilNextMaintenance();

        if ($remaining <= 0) {
            return 'Overdue';
        } elseif ($remaining <= 50) {
            return 'Upcoming';
        }

        return 'On Schedule';
    }
}