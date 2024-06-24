<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'pharma_name' => $this->pharma_name,
            'pharmacist_name' => $this->pharmacist_name,
            'email' => $this->email,
            'license_date' => $this->license_date,
            'phone' => $this->phone,
            'address' => $this->address,
            'pharmacist_gender' => $this->pharmacist_gender,
            'is_band' => $this->is_band,
            'medicines' => MedicineResource::collection($this->whenLoaded('medicines')), // Using whenLoaded to conditionally load medicines
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
