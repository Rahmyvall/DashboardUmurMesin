<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    /**
     * Field yang boleh diisi (mass assignment)
     */
    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'province',
        'postal_code',
        'country',
        'latitude',
        'longitude',
        'is_active',
    ];

    /**
     * Casting tipe data
     */
    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    /**
     * Default value
     */
    protected $attributes = [
        'is_active' => true,
        'country' => 'Indonesia',
    ];

    /**
     * Scope: hanya yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Accessor: full address
     */
    public function getFullAddressAttribute()
    {
        return collect([
            $this->address,
            $this->city,
            $this->province,
            $this->postal_code,
            $this->country,
        ])->filter()->implode(', ');
    }

    /**
     * Accessor: format koordinat
     */
    public function getCoordinatesAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return $this->latitude . ', ' . $this->longitude;
        }

        return null;
    }

    /**
     * Contoh relasi (opsional)
     * Misal location dimiliki user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
