<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Admin',
            'guard_name' => 'api',
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);

        $user = User::create([
            'pharma_name' => 'Admain',
            'pharmacist_name' => 'Abdullah',
            'password' =>Hash::make('Password@1234'), // تشفير كلمة المرور
            'email' => 'Admin2000@gmail.com',
            'license_date' => now()->format('Y-m-d'),
            'license_number' => 'LICENSE4562',
            'phone' => '0988556619',
            'address' => '456 Secondary St',
            'pharmacist_gender' =>'male',
            'is_band' => false,
            'role_name' => 'Admin',
        ]);

        $user->assignRole('Admin');
    }
}
