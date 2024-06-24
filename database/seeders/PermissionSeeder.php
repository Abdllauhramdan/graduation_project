<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
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
        'view-roles',
        'create-role',
        'view-role',
        'update-role',
        'delete-role',
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
        'view-employees',
        'create-employee',
        'view-employee',
        'update-employee',
        'delete-employee',
        'restore-employee',
        'force-delete-employee',
        ];

        foreach ($permissions as $permission) {
            // Check if the permission already exists to avoid duplication
            $existingPermission = Permission::where('name', $permission)->where('guard_name', 'api')->first();

            if (!$existingPermission) {
                Permission::create(['guard_name' => 'api', 'name' => $permission]);
            }
        }
    }
}
