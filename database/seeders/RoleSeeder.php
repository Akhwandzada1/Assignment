<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $roles = [
            'admin',
            'sub-admin',
        ];

        foreach($roles as $role){
            $newRole = Role::create(['name' => $role]);
            if($role == "admin"){
                $newRole->syncPermissions($permissions);
            } else if($role == "sub-admin") {
                $newRole->syncPermissions(['create_employee']);
            }
        }

    }
}
