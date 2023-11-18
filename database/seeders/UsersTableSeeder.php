<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            //Admin
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' =>'active',

            ],

            //Secretary
            [
                'name' => 'Secretary',
                'username' => 'secretary',
                'email' => 'secretary@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'secretary',
                'status' =>'active',
                'department_id' => 1,

            ],

            //User
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' =>'active',
                'department_id' => 1,
            ],
        ];
        if(User::count() > 0){
            return;
        }
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
