<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Add proper authorization logic
    }

    public function rules()
    {
        $employeeId = $this->employee ? $this->employee->id : null;
        return [
            'emp_first_name' => 'required|string|max:255',
            'emp_last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employeeId,
            'password' => 'required|string|min:6',
            'birth_date' => 'required|date|before_or_equal:today',
            'phone' => 'required|string',
            'address' => 'required|string',
            'employee_gender' => 'required|in:male,female',
            'is_employee' => 'required|boolean',
            'job_title' => 'required|string',
            'salary' => 'required|numeric|min:0',
        ];
    }
}
