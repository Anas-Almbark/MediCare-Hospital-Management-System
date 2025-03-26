<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLabTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'gender' => 'sometimes|string|max:255',
            'phone_number' => 'sometimes|string|max:255',
            'identity_number' => 'sometimes|string|max:255',
            'doctor' => 'nullable|exists:users,id',
            'lab_type_id' => 'sometimes|exists:lab_types,id',
            'status' => 'sometimes|string|in:pending,completed,cancelled',
            'result' => 'required_if:status,completed|nullable|mimes:pdf'
        ];
    }
}
