<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Http\Requests\EmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    use ApiResponseTrait;


    // public function __construct()
    // {
    //     $this->middleware(['permission:view-employees'], ['only' => ['index']]);
    //     $this->middleware(['permission:create-employee'], ['only' => ['create', 'store']]);
    //     $this->middleware(['permission:view-employee'], ['only' => ['show']]);
    //     $this->middleware(['permission:update-employee'], ['only' => ['edit', 'update']]);
    //     $this->middleware(['permission:delete-employee'], ['only' => ['destroy']]);
    //     $this->middleware(['permission:restore-employee'], ['only' => ['restore']]);
    //     $this->middleware(['permission:force-delete-employee'], ['only' => ['forceDelete']]);
    // }

    public function index()
    {
        try {
            $employees = Employee::all();
            return $this->customeResponse(EmployeeResource::collection($employees), "Done", 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    public function store(EmployeeRequest $request)
    {
        try {
            // Create a new employee with the request data
            $employee = Employee::create([
                'emp_first_name' => $request->emp_first_name,
                'emp_last_name' => $request->emp_last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password), // Encrypt the password
                'birth_date' => $request->birth_date,
                'phone' => $request->phone,
                'address' => $request->address,
                'employee_gender' => $request->employee_gender,
                'is_employee' => $request->is_employee,
                'job_title' => $request->job_title,
                'salary' => $request->salary,
            ]);
            // Return a custom response indicating success
            return $this->customeResponse(new EmployeeResource($employee), 'Employee created successfully', 200);
        } catch (\Throwable $th) {
            // Log the error for debugging
            Log::error($th);
            return $this->$th;
            // Return a custom response indicating an error occurred
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    
    public function show(Employee $employee)
    {
        try {
            return $this->customeResponse(new EmployeeResource($employee), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
        $employee->emp_first_name = $request->input('emp_first_name') ?? $employee->emp_first_name;
        $employee->emp_last_name = $request->input('emp_last_name') ?? $employee->emp_last_name;
        $employee->email = $request->input('email') ?? $employee->email;
        $employee->password = $request->input('password') ?? $employee->password;
        $employee->birth_date = $request->input('birth_date') ?? $employee->birth_date;
        $employee->phone = $request->input('phone') ?? $employee->phone;
        $employee->address = $request->input('address') ?? $employee->address;
        $employee->employee_gender = $request->input('employee_gender') ?? $employee->employee_gender;
        $employee->is_employee = $request->input('is_employee') ?? $employee->is_employee;
        $employee->job_title = $request->input('job_title') ?? $employee->job_title;
        $employee->salary = $request->input('salary') ?? $employee->salary;
        
        $employee->save();
            return $this->customeResponse(new EmployeeResource($employee), 'Employee updated successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return $this->customeResponse(null, 'Employee deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    public function restore(String $id)
    {
        try {
            $employee = Employee::withTrashed()->findOrFail($id);
            if (!$employee->trashed()) {
                return $this->customeResponse(null, 'Employee is not deleted. No need to restore.', 404);
            }
    
            $employee->restore();
            return $this->customeResponse(new EmployeeResource($employee), 'Employee restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error("Error restoring employee: " . $th->getMessage());
            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }
    
    
    public function forceDelete(Request $request, $id)
    {
        try {
            $employee = Employee::withTrashed()->find($id);

            if (!$employee) {
                return $this->customeResponse(null, 'Employee not found', 404);
            }

            if (!$employee->trashed()) {
                return $this->customeResponse(null, 'Employee is not soft deleted. Use delete first.', 400);
            }

            $employee->forceDelete();

            return $this->customeResponse("", 'Employee force deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error("Failed to permanently delete employee: " . $th->getMessage());
            return $this->customeResponse(null, "There is something wrong on the server", 500);
        }
    }

    

}