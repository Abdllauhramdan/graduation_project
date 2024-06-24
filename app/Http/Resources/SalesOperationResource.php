<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SalesOperationResource extends JsonResource
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
            'date' => $this->date,
            //'empaloyee' => new EmployeeResource($this->whenLoaded('employee')),
            'user' => new UserResource($this->whenLoaded('user')),
            'medicines' => MedicineResource::collection($this->whenLoaded('medicines')),
            'quantity_sold' => $this->quantity_sold,
            'total_price' => $this->total_price,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
