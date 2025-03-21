<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSalaryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'base_salary' => 'sometimes|numeric|min:0',
            'bonus' => 'sometimes|numeric|min:0',
            'deductions' => 'sometimes|numeric|min:0',
            'payment_date' => 'sometimes|date|after_or_equal:today'
        ];
    }
}
