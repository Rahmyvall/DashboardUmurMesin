<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $currentHours = $this->machine?->total_operating_hours ?? $this->last_maintenance_hours;
        $sisaJam = $this->next_maintenance_hours - $currentHours;

        return [
            'id'                     => $this->id,
            'machine_id'             => $this->machine_id,
            'machine'                => [
                'id'   => $this->machine?->id,
                'name' => $this->machine?->name,
                'code' => $this->machine?->code,
            ],

            'interval_hours'         => (int) $this->interval_hours,
            'last_maintenance_hours' => (float) $this->last_maintenance_hours,
            'next_maintenance_hours' => (float) $this->next_maintenance_hours,

            'sisa_jam'               => round($sisaJam, 2),
            'status'                 => $this->status,
            'notes'                  => $this->notes,

            'maintenance_status'     => $this->getMaintenanceStatus($sisaJam),

            'created_at'             => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'             => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Helper untuk menentukan status maintenance
     */
    private function getMaintenanceStatus(float $sisaJam): string
    {
        if ($sisaJam <= 0) {
            return 'overdue';
        } elseif ($sisaJam <= 100) {
            return 'upcoming';
        } else {
            return 'on_schedule';
        }
    }
}
