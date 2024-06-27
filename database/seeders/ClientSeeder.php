<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Client',
            'guard_name' => 'api',
        ]);

        // $permissions = Permission::pluck('id', 'id')->all();
        // $role->syncPermissions($permissions);
        $clientPermissions = [
            'view-medicines',
            // 'view-roles',
            // 'create-role',
            // 'view-role',
            // 'update-role',
            // 'delete-role',
            'view-sales-operation',
            'update-sales-operation',
            'delete-sales-operation',
            'restore-sales-operation',
            'remove-medicine-from-sales-operation',
            'view-categories',
            'view-category',
            
        ];

        foreach ($clientPermissions as $permissionName) {
            $permission = Permission::where('name', $permissionName)->where('guard_name', 'api')->first();
            if ($permission) {
                $role->givePermissionTo($permission);
            }
        }

        $user = User::create([
            'pharma_name' => 'pharmacy',
            'pharmacist_name' => 'sammer',
            'password' =>Hash::make('Password@12'), // تشفير كلمة المرور
            'email' => 'Abdram2000@gmail.com',
            'license_date' => now()->format('Y-m-d'),
            'license_number' => 'LICENSE46',
            'phone' => '9876543210',
            'address' => '456 Secondary St',
            'pharmacist_gender' =>'male',
            'is_band' => false,
            'role_name' => 'Client',
        ]);

        $user->assignRole('Client');
    }
}
