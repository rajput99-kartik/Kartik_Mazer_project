<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Order_CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions = [
            [
                'group_name' => 'Order Category',
                'permissions' => [
                    'ordercategory-list',
                    'ordercategory-create',
                    'ordercategory-edit',
                    'ordercategory-delete',
                ]
            ],
        ];

       // $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'web']);

        //findOrCreate()
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        //$roleSuperAdmin = Role::create(['name' => 'superadmin']);
        //$role->givePermissionTo(Permission::all());

        // Create and Assign Permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup, 'guard_name' => 'web']);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }

        // $admin = User::where('username', 'superadmin')->first();
        $admin = User::where('id', '1')->first();
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }
}
