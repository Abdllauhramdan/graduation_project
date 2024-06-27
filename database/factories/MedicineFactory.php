<?php

namespace Database\Factories;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medicine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
            'company_name' => $this->faker->company,
            'prescription_status' => $this->faker->randomElement(['With Prescription', 'Without Prescription']),
            'category_id' => $this->faker->numberBetween(1, 10), // يجب استبدال 10 بعدد الفئات الموجودة في قاعدة البيانات
            'production_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'expiration_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'purchase_price' => $this->faker->randomFloat(2, 1, 100),
            'selling_price' => $this->faker->randomFloat(2, 1, 200),
            'med_image' => 'path/to/your/image.jpg', // يجب استبداله بمسار الصورة الفعلي
            'alternative' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'contraindications' => $this->faker->sentence,
            'dose' => $this->faker->sentence,
            'medicine_shape' => $this->faker->randomElement(['Tablet', 'Capsule', 'Liquid', 'Powder']),
            'max_quantity_allowed' => $this->faker->numberBetween(50, 200),
        ];
    }
}
