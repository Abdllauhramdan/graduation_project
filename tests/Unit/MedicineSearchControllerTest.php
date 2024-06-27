<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\MedicineSearchController;
use App\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class MedicineSearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public $medicineSearchController;
    protected function setUp(): void
    {
        parent::setUp();
        $this->medicineSearchController = new MedicineSearchController();
    }

    /** @test */
    public function it_can_search_medicine_by_name()
    {
        $medicine = Medicine::factory()->create(['name' => 'Aspirin']);
        $alternative = Medicine::factory()->create(['name' => 'Aspirin', 'id' => $medicine->id + 1]);

        $request = new Request(['query' => 'Aspirin']);

        $response = $this->medicineSearchController->searchByName($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals($medicine->name, $responseData->drug->name);
        $this->assertCount(1, $responseData->alternatives);
    }

    /** @test */
    public function it_returns_no_medicines_found_when_searching_by_name()
    {
        $request = new Request(['query' => 'NonExistentMedicine']);

        $response = $this->medicineSearchController->searchByName($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals('No medicines found', $responseData->message);
    }

    /** @test */
    public function it_can_search_medicine_by_category()
    {
        $medicine = Medicine::factory()->create(['category_id' => 1]);

        $request = new Request(['category_id' => 1]);

        $response = $this->medicineSearchController->searchByCategory($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertCount(1, $responseData->drugs);
        $this->assertEquals($medicine->category_id, $responseData->drugs[0]->category_id);
    }

    /** @test */
    public function it_returns_no_medicines_found_when_searching_by_category()
    {
        $request = new Request(['category_id' => 999]);

        $response = $this->medicineSearchController->searchByCategory($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals('No medicines found', $responseData->message);
    }

    /** @test */
    public function it_can_search_medicine_by_company()
    {
        $medicine = Medicine::factory()->create(['company_name' => 'TestCompany']);

        $request = new Request(['company' => 'TestCompany']);

        $response = $this->medicineSearchController->searchByCompany($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertCount(1, $responseData->drugs);
        $this->assertEquals($medicine->company_name, $responseData->drugs[0]->company_name);
    }

    /** @test */
    public function it_returns_no_medicines_found_when_searching_by_company()
    {
        $request = new Request(['company' => 'NonExistentCompany']);

        $response = $this->medicineSearchController->searchByCompany($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals('No medicines found', $responseData->message);
    }
}
