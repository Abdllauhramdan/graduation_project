<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'emp_first_name' => 'nullable|string|max:255',
            'emp_last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|email|max:255',
            'password' => 'nullable|string|min:6',
            'birth_date' => 'nullable|date|before_or_equal:today',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'employee_gender' => 'nullable|in:male,female',
            'is_employee' => 'nullable|boolean',
            'job_title' => 'nullable|string',
            'salary' => 'nullable|numeric|min:0',
        ];
    }
}
