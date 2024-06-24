<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'emp_first_name' => $this->emp_first_name,
            'emp_last_name' => $this->emp_last_name,
            'email' => $this->email,
            'birth_date' => $this->birth_date,
            'phone' => $this->phone,
            'address' => $this->address,
            'employee_gender' => $this->employee_gender,
            'is_employee' => $this->is_employee,
            'job_title' => $this->job_title,
            'salary' => $this->salary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
