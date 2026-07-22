<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | Role
        |--------------------------------------------------------------------------
        */

        $admin = Role::where('name', 'Admin')->first();

        $manager = Role::where('name', 'Manajer Gudang')->first();

        $staff = Role::where('name', 'Staff Gudang')->first();



        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($admin) {

            $admin->syncPermissions(
                Permission::all()
            );

        }



        /*
        |--------------------------------------------------------------------------
        | MANAJER GUDANG
        |--------------------------------------------------------------------------
        */

        if ($manager) {

            $managerPermissions = [

                'view dashboard',

                'view products',
                'manage products',

                'view suppliers',

                'manage stock in',
                'manage stock out',

                'manage stock opname',

                'view reports',

            ];


            $manager->syncPermissions(
                Permission::whereIn(
                    'name',
                    $managerPermissions
                )->get()
            );

        }



        /*
        |--------------------------------------------------------------------------
        | STAFF GUDANG
        |--------------------------------------------------------------------------
        */

        if ($staff) {

            $staffPermissions = [

                'view dashboard',

                'manage stock in',

                'manage stock out',

                'manage stock opname',

            ];


            $staff->syncPermissions(
                Permission::whereIn(
                    'name',
                    $staffPermissions
                )->get()
            );

        }

    }
}