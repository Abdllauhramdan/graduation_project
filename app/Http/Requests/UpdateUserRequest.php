<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // أو تحقق من صلاحيات المستخدم هنا إن لزم الأمر
    }

    /*
     * Returns an array of validation rules for the update user request.
     *
     * @return array An array of validation rules.
     */
    public function rules(): array
    {
        return [
            'pharma_name' => 'nullable|alpha',
            'pharmacist_name' => 'nullable|alpha',
            'password' => 'nullable|min:6',
            'email' => 'nullable|email|unique:users,email,' . $this->user->id, // استثناء السجل الحالي من التحقق
            'license_date' => 'nullable|date',
            'license_number' => 'nullable|string|unique:pharmacies,license_number',
            'phone' => 'nullable',
            'address' => 'nullable|max:255',
            'pharmacist_gender' => 'nullable',
            'is_band' => 'nullable',
        ];
    }
}


