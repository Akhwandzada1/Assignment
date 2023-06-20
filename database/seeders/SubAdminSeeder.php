<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class SubAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['name' => 'Sub-Admin', 'password' => Hash::make('password'), 'email' => 'sub-admin@admin.com', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ]
        ];

        foreach($users as $user){
            $subAdmin = User::create($user);
            $subAdmin->assignRole('sub-admin');
        }
    }
}
