<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesOperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Implement authorization logic
    }

    /**
     * Returns an array of validation rules for the SalesOperationRequest.
     *
     * @return array An array of validation rules.
     */
    public function rules(): array
    {
        return [
            'date' => 'nullable|date',
            'user_id' => 'required|exists:users,id', // Make 'user_id' required
            'quantity_sold' => 'nullable|integer|min:0|max:1000',
            'total_price' => 'nullable|numeric|min:0|max:100000',
        ];
    }
}
