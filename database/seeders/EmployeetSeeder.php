<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class EmployeetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Employee',
            'guard_name' => 'api',
        ]);

        $employeePermissions = [
            'view-medicines',
            'create-medicine',
            'update-medicine',
            'delete-medicine',
            'restore-medicine',
            'force-delete-medicine',
            'view-users',
            'create-user',
            'view-user',
            'update-user',
            'delete-user',
            'restore-user',
            'force-delete-user',
            // 'view-roles',
            // 'create-role',
            // 'view-role',
            // 'update-role',
            // 'delete-role',
            'view-sales-operations',
            'view-sales-operation',
            'update-sales-operation',
            'delete-sales-operation',
            'restore-sales-operation',
            'force-delete-sales-operation',
            'remove-medicine-from-sales-operation',
            'view-categories',
            'create-category',
            'view-category',
            'update-category',
            'delete-category',
            'restore-category',
            'force-delete-category',
        ];

        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions($permissions);
        foreach ($employeePermissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->where('guard_name', 'api')->first();
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }


        $user = User::create([
            'pharma_name' => 'null',
            'pharmacist_name' => 'Ahmad',
            'password' =>Hash::make('Password@1234'), // تشفير كلمة المرور
            'email' => 'employee1@gmail.com',
            'license_date' => now()->format('Y-m-d'),
            'license_number' => 'LICENSE4564',
            'phone' => '9876543210',
            'address' => '456 Secondary St',
            'pharmacist_gender' =>'female',
            'is_band' => false,
            'role_name' => 'Employee',
        ]);

        $user->assignRole('Employee');
    }
}
