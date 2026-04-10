<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MaintenanceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'machine_id'       => 'required|exists:machines,id',
            'technician_id'    => 'nullable|exists:users,id',
            'maintenance_type' => 'required|in:preventive,corrective',
            'description'      => 'nullable|string|max:500',
            'maintenance_date' => 'required|date',
            'cost'             => 'nullable|numeric|min:0',
            'notes'            => 'nullable|string',
        ];
    }
}
