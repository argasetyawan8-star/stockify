<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            /*
            |--------------------------------------------------------------------------
            | Dashboard
            |--------------------------------------------------------------------------
            */

            'view dashboard',

            /*
            |--------------------------------------------------------------------------
            | Categories
            |--------------------------------------------------------------------------
            */

            'view categories',
            'manage categories',

            /*
            |--------------------------------------------------------------------------
            | Suppliers
            |--------------------------------------------------------------------------
            */

            'view suppliers',
            'manage suppliers',

            /*
            |--------------------------------------------------------------------------
            | Products
            |--------------------------------------------------------------------------
            */

            'view products',
            'manage products',

            /*
            |--------------------------------------------------------------------------
            | Stock In
            |--------------------------------------------------------------------------
            */

            'view stock in',
            'manage stock in',

            /*
            |--------------------------------------------------------------------------
            | Stock Out
            |--------------------------------------------------------------------------
            */

            'view stock out',
            'manage stock out',

            /*
            |--------------------------------------------------------------------------
            | Stock Opname
            |--------------------------------------------------------------------------
            */

            'view stock opname',
            'manage stock opname',

            /*
            |--------------------------------------------------------------------------
            | Reports
            |--------------------------------------------------------------------------
            */

            'view reports',

            /*
            |--------------------------------------------------------------------------
            | Users
            |--------------------------------------------------------------------------
            */

            'view users',
            'manage users',

            /*
            |--------------------------------------------------------------------------
            | Activity Logs
            |--------------------------------------------------------------------------
            */

            'view activity logs',

             /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            'view settings',
            'manage settings',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name'       => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Roles
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
        | Admin
        |--------------------------------------------------------------------------
        */

        $admin->syncPermissions($permissions);

        /*
        |--------------------------------------------------------------------------
        | Manajer Gudang
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
        | Staff Gudang
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