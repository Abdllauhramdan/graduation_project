<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMedicineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // تحقق من صلاحيات المستخدم إذا لزم الأمر
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:1',
            'company_name' => 'nullable|string|max:255',
            'prescription_status' => 'nullable|boolean',
            'category_id' => 'nullable|exists:categories,id',
            'production_date' => 'nullable|date|before_or_equal:expiration_date',
            'expiration_date' => 'nullable|date|after_or_equal:production_date',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0|gte:purchase_price',
            'med_image' => 'nullable|image|max:2048',
            'alternative' => 'nullable|json|max:255',
            'description' => 'nullable|string|max:1000',
            'contraindications' => 'nullable|string|max:1000',
            'dose' => 'nullable|string|max:255',
            'medicine_shape' => 'nullable|string|max:255',
            'max_quantity_allowed' => 'nullable|integer|min:1'
        ];
    }
}

