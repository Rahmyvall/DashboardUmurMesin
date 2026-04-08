<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    protected $table = 'machines';

    protected $primaryKey = 'id';

    public $timestamps = false; // karena hanya ada created_at

    protected $fillable = [
        'code',
        'name',
        'brand',
        'type',
        'serial_number',
        'purchase_date',
        'installation_date',
        'lifetime_hours',
        'status',
        'location_id',
        'created_at'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'installation_date' => 'date',
        'created_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // Relasi ke lokasi
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPE (Optional - biar clean query)
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    public function scopeBroken($query)
    {
        return $query->where('status', 'rusak');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSOR (Optional)
    |--------------------------------------------------------------------------
    */

    // Contoh: format tanggal
    public function getPurchaseDateFormattedAttribute()
    {
        return $this->purchase_date
            ? $this->purchase_date->format('d-m-Y')
            : null;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATOR (Optional)
    |--------------------------------------------------------------------------
    */

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }

}
