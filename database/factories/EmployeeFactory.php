<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'emp_first_name' => $this->faker->firstName,
            'emp_last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'), // كلمة مرور مشفرة
            'birth_date' => $this->faker->date,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'employee_gender' => $this->faker->randomElement(['male', 'female']),
            'is_employee' => $this->faker->boolean,
            'job_title' => $this->faker->jobTitle,
            'salary' => $this->faker->numberBetween(3000, 10000),
        ];
    }
}
