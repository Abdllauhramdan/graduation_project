<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
            return [
                'id' => $this->id,
                'name' => $this->name,
                'quantity' => $this->quantity,
                'company_name' => $this->company_name,
                'prescription_status' => $this->prescription_status,
                'category_id' => $this->category_id,
                'production_date' => $this->production_date,
                'expiration_date' => $this->expiration_date,
                'purchase_price' => $this->purchase_price,
                'selling_price' => $this->selling_price,
                'med_image' => $this->med_image,
                'alternative' => $this->alternative,
                'description' => $this->description,
                'contraindications' => $this->contraindications,
                'dose' => $this->dose,
                'medicine_shape' => $this->medicine_shape,
                'max_quantity_allowed' => $this->max_quantity_allowed,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ];
    
    }
}
