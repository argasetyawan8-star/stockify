<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Buat Role
        |--------------------------------------------------------------------------
        */

        $admin = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manajer Gudang',
            'guard_name' => 'web',
        ]);

        $staff = Role::firstOrCreate([
            'name' => 'Staff Gudang',
            'guard_name' => 'web',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Permission Admin
        |--------------------------------------------------------------------------
        */

        $admin->syncPermissions([

            'view dashboard',

            'view categories',
            'manage categories',

            'view suppliers',
            'manage suppliers',

            'view products',
            'manage products',

            'view stock in',
            'manage stock in',

            'view stock out',
            'manage stock out',

            'view stock opname',
            'manage stock opname',

            'view reports',

            'view users',
            'manage users',

            'view activity logs',

            'view settings',
            'manage settings',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Permission Manajer Gudang
        |--------------------------------------------------------------------------
        */

        $manager->syncPermissions([

            'view dashboard',

            'view suppliers',

            'view products',
            'manage products',

            'view stock in',
            'manage stock in',

            'view stock out',
            'manage stock out',

            'view stock opname',
            'manage stock opname',

            'view reports',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Permission Staff Gudang
        |--------------------------------------------------------------------------
        */

        $staff->syncPermissions([

            'view dashboard',

            'view products',

            'view stock in',
            'manage stock in',

            'view stock out',
            'manage stock out',
        ]);
    }
}