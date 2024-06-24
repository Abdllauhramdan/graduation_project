<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ensure you have proper authorization logic here
    }

    public function rules(): array
    {
        $categoryId = $this->category ? $this->category->id : null;
        return [
            'name' => 'required|string|unique:categories,name,' . $categoryId,
        ];
    }
}
