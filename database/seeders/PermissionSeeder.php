<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            'create-employee',
            'read-employee',
            'update-employee',
            'delete-employee',
            'create-company',
            'read-company',
            'update-company',
            'delete-company',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
