<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\SalesOperationController;
use App\Models\Sales_operation;
use App\Models\Medicine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesOperationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->salesOperationController = new SalesOperationController();
    }

    /** @test */
    public function it_can_list_all_sales_operations()
    {
        $salesOperation = Sales_operation::factory()->create();

        $response = $this->salesOperationController->index();

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertCount(1, $responseData->data);
    }

    /** @test */
    public function it_can_create_a_sales_operation()
    {
        $medicine = Medicine::factory()->create(['quantity' => 10, 'selling_price' => 5]);
        $request = new Request([
            'user_id' => 1,
            'medicines' => [
                $medicine->id => ['quantity' => 2]
            ]
        ]);

        $response = $this->salesOperationController->store($request);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals(1, $responseData->data->user_id);
        $this->assertEquals(2, $responseData->data->quantity_sold);
        $this->assertEquals(10, $responseData->data->total_price);
    }

    /** @test */
    public function it_can_show_a_sales_operation()
    {
        $salesOperation = Sales_operation::factory()->create();

        $response = $this->salesOperationController->show($salesOperation);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals($salesOperation->id, $responseData->data->id);
    }

    /** @test */
    public function it_can_update_a_sales_operation()
    {
        $salesOperation = Sales_operation::factory()->create();
        $medicine = Medicine::factory()->create(['quantity' => 10, 'selling_price' => 5]);
        $request = new Request([
            'user_id' => 2,
            'medicines' => [
                $medicine->id => ['quantity' => 3]
            ]
        ]);

        $response = $this->salesOperationController->update($request, $salesOperation);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals(2, $responseData->data->user_id);
        $this->assertEquals(3, $responseData->data->quantity_sold);
        $this->assertEquals(15, $responseData->data->total_price);
    }

    /** @test */
    public function it_can_delete_a_sales_operation()
    {
        $salesOperation = Sales_operation::factory()->create();

        $response = $this->salesOperationController->destroy($salesOperation);

        $this->assertEquals(200, $response->status());
        $this->assertNull(Sales_operation::find($salesOperation->id));
    }

    /** @test */
    public function it_can_restore_a_sales_operation()
    {
        $salesOperation = Sales_operation::factory()->create();
        $salesOperation->delete();

        $response = $this->salesOperationController->restore($salesOperation->id);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEquals($salesOperation->id, $responseData->data->id);
    }

    /** @test */
    public function it_can_force_delete_a_sales_operation()
    {
        $salesOperation = Sales_operation::factory()->create();
        $salesOperation->delete();

        $response = $this->salesOperationController->forceDelete($salesOperation);

        $this->assertEquals(200, $response->status());
        $this->assertNull(Sales_operation::withTrashed()->find($salesOperation->id));
    }

    /** @test */
    public function it_can_remove_medicine_from_sales_operation()
    {
        $salesOperation = Sales_operation::factory()->create();
        $medicine = Medicine::factory()->create(['quantity' => 10, 'selling_price' => 5]);
        $salesOperation->medicines()->attach($medicine->id, ['quantity' => 2]);
        $salesOperation->total_price = 10;
        $salesOperation->save();

        $request = new Request();

        $response = $this->salesOperationController->removeMedicine($request, $salesOperation, $medicine->id);

        $responseData = $response->getData();
        $this->assertEquals(200, $response->status());
        $this->assertEmpty($salesOperation->medicines()->find($medicine->id));
        $this->assertEquals(0, $salesOperation->total_price);
    }
}
