<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pharma_name' => $this->faker->company,
            'pharmacist_name' => $this->faker->name,
            'password' => static::$password ??= Hash::make('password'), // تعيين كلمة مرور مشفرة
            'email' => $this->faker->unique()->safeEmail,
            'license_date' => $this->faker->date,
            'license_number' => $this->faker->unique()->numerify('###-###-###'),
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'pharmacist_gender' => $this->faker->randomElement(['male', 'female']),
            'is_band' => $this->faker->boolean,
            //role_name
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
