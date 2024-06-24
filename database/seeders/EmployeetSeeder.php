<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'view-users',
            'view-roles',
            'view-sales-operations',
            'view-categories',
            'view-employees',
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
