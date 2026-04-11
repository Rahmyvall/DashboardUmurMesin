<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Alert extends Model
{
    use HasFactory;
    // use SoftDeletes; // Uncomment jika ingin menggunakan soft delete

    protected $table = 'alerts';

    protected $fillable = [
        'machine_id',
        'alert_type',
        'severity',
        'title',
        'message',
        'metadata',
        'is_read',
        'read_at',
        'resolved',
        'resolved_at',
        'resolved_by',
        'expires_at',
    ];

    protected $casts = [
        'metadata'     => 'array',
        'is_read'      => 'boolean',
        'resolved'     => 'boolean',
        'read_at'      => 'datetime',
        'resolved_at'  => 'datetime',
        'expires_at'   => 'datetime',
    ];

    protected $appends = [
        'is_expired',
        'status',
    ];

    // ====================== BOOT & OBSERVER ======================
    protected static function boot()
    {
        parent::boot();

        // Daftarkan Observer di sini (cara paling aman)
        static::observe(\App\Observers\AlertObserver::class);
    }

    // ====================== RELATIONSHIPS ======================

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }

    public function resolver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    // ====================== SCOPES ======================

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeUnresolved($query)
    {
        return $query->where('resolved', false);
    }

    public function scopeOfMachine($query, $machineId)
    {
        return $query->where('machine_id', $machineId);
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('severity', ['high', 'critical']);
    }

    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<', now());
    }

    // ====================== ACCESSORS ======================

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function getStatusAttribute(): string
    {
        if ($this->resolved) {
            return 'resolved';
        }

        if ($this->is_expired) {        // Menggunakan accessor is_expired
            return 'expired';
        }

        if (!$this->is_read) {
            return 'unread';
        }

        return 'read';
    }

    public function getSeverityColorAttribute(): string
    {
        return match ($this->severity) {
            'critical' => 'danger',
            'high'     => 'warning',
            'medium'   => 'info',
            'low'      => 'secondary',
            default    => 'secondary',
        };
    }

    // ====================== MUTATORS / HELPER METHODS ======================

    public function markAsRead(): bool
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
            return true;
        }
        return false;
    }

    public function markAsResolved(?int $userId = null): bool
    {
        if (!$this->resolved) {
            $this->update([
                'resolved'    => true,
                'resolved_at' => now(),
                'resolved_by' => $userId ?? Auth::id(),
            ]);
            return true;
        }
        return false;
    }

    public function isActive(): bool
    {
        return !$this->resolved && !$this->is_expired;
    }
}
