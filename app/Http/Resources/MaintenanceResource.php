<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MaintenanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'machine_id'        => $this->machine_id,
            'machine'           => [
                'id'   => $this->machine->id ?? null,
                'name' => $this->machine->name ?? null,
                'code' => $this->machine->code ?? null,
            ],
            'technician_id'     => $this->technician_id,
            'technician'        => $this->whenLoaded('technician', function () {
                return [
                    'id'   => $this->technician->id,
                    'name' => $this->technician->name,
                ];
            }),
            'maintenance_type'  => $this->maintenance_type,
            'description'       => $this->description,
            'maintenance_date'  => $this->maintenance_date?->format('Y-m-d'),
            'cost'              => (float) $this->cost,
            'notes'             => $this->notes,
            'created_at'        => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'        => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
