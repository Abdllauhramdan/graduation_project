<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure authorization logic is properly set
    }

    /**
     * Get the validation rules that apply to the medicine request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'company_name' => 'required|string|max:255',
            'prescription_status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'production_date' => 'required|date|before:tomorrow',
            'expiration_date' => 'required|date|after:production_date',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0|gte:purchase_price',
            'med_image' => 'nullable|max:2048',
            'alternative' => 'nullable|json|max:255',
            'description' => 'nullable|string|max:1000',
            'contraindications' => 'nullable|string|max:1000',
            'dose' => 'nullable|string|max:255',
            'medicine_shape' => 'required|string|max:255',
            'max_quantity_allowed' => 'required|integer|min:1'
        ];
    }
}
