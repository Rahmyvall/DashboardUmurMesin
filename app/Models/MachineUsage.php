<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineUsage extends Model
{
    use HasFactory;

    // Nama tabel (karena tidak mengikuti plural default Laravel)
    protected $table = 'machine_usage';

    // Primary key (opsional karena default = id)
    protected $primaryKey = 'id';

    // Karena hanya ada created_at (tanpa updated_at)
    public $timestamps = false;

    // Field yang boleh diisi (mass assignment)
    protected $fillable = [
        'machine_id',
        'usage_date',
        'hours_used',
        'total_hours',
    ];

    // Casting tipe data
    protected $casts = [
        'usage_date' => 'date',
        'hours_used' => 'decimal:2',
        'total_hours' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel machines
     */
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'machine_id');
    }
}
