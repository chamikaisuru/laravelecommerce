<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class SubAdminSeeder extends Seeder
{

    public function run(): void
    {
        $password1 = Hash::make('sudun123');
        $password2 = Hash::make('dasun123');
        $subadminData = [
            ['id' => 2, 'name' => 'sadun', 'type' => 'subadmin', 'mobile' => '0718718596', 'email' => 'sadun@gmail.com', 'password' => $password1, 'image' =>'', 'status' =>1],
            ['id' => 3, 'name' => 'dasun', 'type' => 'subadmin', 'mobile' => '0718718597', 'email' => 'dasun@gmail.com', 'password' => $password2, 'image' =>'', 'status' =>1],

        ];

        Admin::insert($subadminData);
    }
}
