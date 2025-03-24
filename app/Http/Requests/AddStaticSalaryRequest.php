<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddStaticSalaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "employee" => "required|exists:users,id",
            "salary" => "required|numeric|min:1",
        ];
    }
}
