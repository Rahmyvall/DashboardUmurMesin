<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance';

    protected $primaryKey = 'id';

    // Jika ingin menggunakan timestamp (created_at & updated_at)
    public $timestamps = true;

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'machine_id',
        'technician_id',
        'maintenance_type',
        'description',
        'maintenance_date',
        'cost',
        'notes',
    ];

    /**
     * Kolom yang harus di-cast ke tipe data tertentu
     */
    protected $casts = [
        'maintenance_date' => 'date',
        'cost'             => 'decimal:2',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /**
     * Relasi ke Model Machine
     */
    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }

    /**
     * Relasi ke Model User (Technician)
     */
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    /**
     * Scope untuk maintenance preventive
     */
    public function scopePreventive($query)
    {
        return $query->where('maintenance_type', 'preventive');
    }

    /**
     * Scope untuk maintenance corrective
     */
    public function scopeCorrective($query)
    {
        return $query->where('maintenance_type', 'corrective');
    }

    /**
     * Scope berdasarkan tanggal maintenance
     */
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('maintenance_date', $date);
    }

    /**
     * Scope untuk maintenance di rentang tanggal
     */
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('maintenance_date', [$startDate, $endDate]);
    }

    /**
     * Accessor untuk format cost dengan Rupiah (opsional)
     */
    public function getCostRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->cost, 0, ',', '.');
    }

    /**
     * Mutator untuk maintenance_type (opsional)
     */
    public function setMaintenanceTypeAttribute($value)
    {
        $this->attributes['maintenance_type'] = strtolower($value);
    }
}