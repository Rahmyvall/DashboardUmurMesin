<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MachineConditionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'machine_id'        => $this->machine_id,

            // Informasi Mesin (include relasi)
            'machine' => [
                'id'   => $this->machine?->id,
                'name' => $this->machine?->name,           // sesuaikan dengan kolom di tabel machines
                'code' => $this->machine?->code,
                // tambahkan field mesin lain yang diperlukan
            ],

            'condition_status'  => $this->condition_status,
            'status_label'      => $this->status_label,     // dari accessor di Model

            'temperature'       => $this->temperature,
            'vibration'         => $this->vibration,
            'pressure'          => $this->pressure,

            'recorded_at'       => $this->recorded_at?->format('Y-m-d H:i:s'),
            'recorded_at_human'=> $this->recorded_at?->diffForHumans(),

            'created_at'        => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'        => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
