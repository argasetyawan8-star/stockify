<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
            'guard_name' => 'web'
        ]);


        $manager = Role::firstOrCreate([
            'name' => 'Manager Gudang',
            'guard_name' => 'web'
        ]);


        $staff = Role::firstOrCreate([
            'name' => 'Staff Gudang',
            'guard_name' => 'web'
        ]);



        /*
        |--------------------------------------------------------------------------
        | Permission Admin
        |--------------------------------------------------------------------------
        */

        $admin->syncPermissions([

            'view dashboard',

            'manage products',
            'view products',

            'manage categories',
            'manage suppliers',

            'manage users',

            'stock in',
            'stock out',
            'stock opname',

            'view reports',

            'view activity logs',

        ]);



        /*
        |--------------------------------------------------------------------------
        | Permission Manager Gudang
        |--------------------------------------------------------------------------
        */

        $manager->syncPermissions([

            'view dashboard',

            'view products',
            'manage products',

            'stock in',
            'stock out',
            'stock opname',

            'manage suppliers',

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

            'stock in',
            'stock out',

        ]);

    }
}