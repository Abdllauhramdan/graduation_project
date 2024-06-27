<?php

namespace Tests\Unit;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $employee = Employee::factory()->create();

        $response = $this->getJson('/api/employees');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    '*' => [
                        'id',
                        'emp_first_name',
                        'emp_last_name',
                        'email',
                        'birth_date',
                        'phone',
                        'address',
                        'employee_gender',
                        'is_employee',
                        'job_title',
                        'salary',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

    public function testStore()
    {
        $employeeData = [
            'emp_first_name' => 'John',
            'emp_last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'password' => 'password',
            'birth_date' => '1990-01-01',
            'phone' => '1234567890',
            'address' => '123 Main St',
            'employee_gender' => 'Male',
            'is_employee' => true,
            'job_title' => 'Developer',
            'salary' => 60000,
        ];

        $response = $this->postJson('/api/employees', $employeeData);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'emp_first_name',
                    'emp_last_name',
                    'email',
                    'birth_date',
                    'phone',
                    'address',
                    'employee_gender',
                    'is_employee',
                    'job_title',
                    'salary',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function testShow()
    {
        $employee = Employee::factory()->create();

        $response = $this->getJson('/api/employees/' . $employee->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data' => [
                    'id',
                    'emp_first_name',
                    'emp_last_name',
                    'email',
                    'birth_date',
                    'phone',
                    'address',
                    'employee_gender',
                    'is_employee',
                    'job_title',
                    'salary',
                    'created_at',
                    'updated_at',
                ]
            ]);
    }

    public function testUpdate()
    {
        $employee = Employee::factory()->create();

        $updateData = [
            'emp_first_name' => 'Jane',
            'emp_last_name' => 'Smith',
            'email' => 'jane.smith@example.com',
        ];

        $response = $this->putJson('/api/employees/' . $employee->id, $updateData);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'emp_first_name' => 'Jane',
                    'emp_last_name' => 'Smith',
                    'email' => 'jane.smith@example.com',
                ]
            ]);
    }

    public function testDestroy()
    {
        $employee = Employee::factory()->create();

        $response = $this->deleteJson('/api/employees/' . $employee->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Employee deleted successfully',
            ]);
    }

    public function testRestore()
    {
        $employee = Employee::factory()->create();
        $employee->delete();

        $response = $this->postJson('/api/employees/restore/' . $employee->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Employee restored successfully',
            ]);
    }

    public function testForceDelete()
    {
        $employee = Employee::factory()->create();
        $employee->delete();

        $response = $this->deleteJson('/api/employees/force-delete/' . $employee->id);

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'message' => 'Employee force deleted successfully',
            ]);
    }
}
