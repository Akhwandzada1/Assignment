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
            ['group' => 'employees', 'name' => 'create_employee', 'title' => 'Create Employees'],
            ['group' => 'employees','name' => 'read_employee', 'title' => 'Read Employees'],
            ['group' => 'employees', 'name' => 'update_employee', 'title' => 'Update Employees'],
            ['group' => 'employees', 'name' => 'delete_employees', 'title' => 'Delete Employees'],
            ['group' => 'companies', 'name' => 'create_company', 'title' => 'Create Companies'],
            ['group' => 'companies', 'name' => 'read_company', 'title' => 'Read Companies'],
            ['group' => 'companies', 'name' => 'update_company', 'title' => 'Update Companies'],
            ['group' => 'companies', 'name' => 'delete_company', 'title' => 'Delete Companies'],
        ];

        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }
}
