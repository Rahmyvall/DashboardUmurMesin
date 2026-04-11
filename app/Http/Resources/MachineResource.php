<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MachineResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'code'              => $this->code,
            'type'              => $this->type,
            'location'          => $this->location,
            'status'            => $this->status,
            'status_label'      => $this->status_label ?? $this->status,

            'specifications'    => $this->specifications,   // JSON column (jika ada)
            'installed_at'      => $this->installed_at?->format('Y-m-d'),
            'last_maintenance'  => $this->last_maintenance?->format('Y-m-d H:i:s'),

            'conditions_count'  => $this->whenCounted('conditions'),
            'latest_condition'  => $this->whenLoaded('latestCondition', function () {
                return new MachineConditionResource($this->latestCondition);
            }),

            'created_at'        => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at'        => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
