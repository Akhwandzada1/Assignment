<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;



class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['name' => 'Admin', 'password' => Hash::make('password'), 'email' => 'admin@admin.com', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ]
        ];

        foreach($users as $user){
            $admin = User::create($user);
            $admin->assignRole('admin');
        }
    }
}
