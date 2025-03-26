<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLabTestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255',
            'doctor_id' => 'nullable|exists:users,id',
            'lab_type_id' => 'required|exists:lab_types,id',
        ];
    }
}
