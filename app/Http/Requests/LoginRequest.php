<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator; // استيراد Validator من المسار الصحيح
use Illuminate\Http\Exceptions\HttpResponseException; // استيراد HttpResponseException من المسار الصحيح
use App\Providers\ApiResponseService; // استيراد ApiResponseService من المسار الصحيح (تأكد من أن المسار صحيح بناءً على هيكلية مشروعك)

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|max:50|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',

        ];
    }
    /**
     * Returns an array of validation error messages.
     *
     * @return array<string, string> An associative array where the keys are the validation
     *     rule names and the values are the corresponding error messages.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.exists' => 'These credentials do not match our records.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.max' => 'The password may not be greater than 50 characters.',
            'password.regex' => 'The password format is invalid.',
        ];
    }

    protected function prepareValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException(ApiResponseService::error('Validation Errors', 422, $errors));
    }
}
