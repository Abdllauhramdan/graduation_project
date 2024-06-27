<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\MedicineController;
use App\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Mockery;

class MedicineControllerTest extends TestCase
{
    use RefreshDatabase;

    public $medicineController; // ملاحظة
    protected function setUp(): void
    {
        parent::setUp();
        $this->medicineController = new MedicineController();
    }

    /** @test */
    public function it_can_get_all_medicines()
    {
        Medicine::factory()->count(5)->create();

        $response = $this->medicineController->index();

        $this->assertEquals(200, $response->status());
        $this->assertCount(5, $response->getData()->data);
    }

    /** @test */
    public function it_can_create_a_medicine()
    {
        $request = new Request([
            'name' => 'Medicine Name',
            'quantity' => 10,
            'company_name' => 'Company Name',
            'prescription_status' => 'required',
            'category_id' => 1,
            'production_date' => now(),
            'expiration_date' => now()->addYear(),
            'purchase_price' => 10.00,
            'selling_price' => 15.00,
            'alternative' => 'Alternative Medicine',
            'description' => 'Description',
            'contraindications' => 'Contraindications',
            'dose' => 'Dose',
            'medicine_shape' => 'Shape',
            'max_quantity_allowed' => 100
        ]);

        $response = $this->medicineController->store($request);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('medicines', ['name' => 'Medicine Name']);
    }

    /** @test */
    public function it_can_show_a_medicine()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->medicineController->show($medicine);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($medicine->name, $response->getData()->data->name);
    }

    /** @test */
    public function it_can_update_a_medicine()
    {
        $medicine = Medicine::factory()->create();

        $request = new Request([
            'name' => 'Updated Medicine Name'
        ]);

        $response = $this->medicineController->update($request, $medicine);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('medicines', ['id' => $medicine->id, 'name' => 'Updated Medicine Name']);
    }

    /** @test */
    public function it_can_delete_a_medicine()
    {
        $medicine = Medicine::factory()->create();

        $response = $this->medicineController->destroy($medicine);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('medicines', ['id' => $medicine->id]);
    }

    /** @test */
    public function it_can_restore_a_medicine()
    {
        $medicine = Medicine::factory()->create(['deleted_at' => now()]);

        $response = $this->medicineController->restore($medicine->id);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseHas('medicines', ['id' => $medicine->id, 'deleted_at' => null]);
    }

    /** @test */
    public function it_can_force_delete_a_medicine()
    {
        $medicine = Medicine::factory()->create(['deleted_at' => now()]);

        $response = $this->medicineController->forceDelete($medicine);

        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('medicines', ['id' => $medicine->id]);
    }
}
