<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure proper authorization logic
    }

    /**
     * Returns an array of validation rules for the request.
     *
     * @return array An array of validation rules.
     */
    public function rules(): array
    {
        return [
            'pharma_name' => 'required|',//,alpha
            'pharmacist_name' => 'required|',//alpha',
            'password' => [
                'required',
                'string',
                'min:8', // الحد الأدنى لطول كلمة المرور
                'max:50', // الحد الأقصى لطول كلمة المرور
                'regex:/[a-z]/', // يجب أن تحتوي على حرف صغير واحد على الأقل
                'regex:/[A-Z]/', // يجب أن تحتوي على حرف كبير واحد على الأقل
                'regex:/[0-9]/', // يجب أن تحتوي على رقم واحد على الأقل
                'regex:/[@$!%*?&]/', // يجب أن تحتوي على رمز خاص واحد على الأقل
            ],
            'email' => 'required|email|unique:users,email',
            'license_date' => 'required|date',
            'license_number' => 'required|string|unique:users,license_number',
            'phone' => 'required|regex:/^[0-9]{10,15}$/',
            'address' => 'required|string|max:255',
            'pharmacist_gender' => 'required|in:male,female',
            'is_band' => 'required|boolean',
        ];
    }
}
