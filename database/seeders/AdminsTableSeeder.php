<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('admin123');

        $adminData = ['id' => 1, 'name' => 'madusanka', 'type' => 'admin', 'mobile' => '0718718598', 'email' => 'isurumadusanka.tmc@gmail.com', 'password' => $password, 'image' =>'', 'status' =>1] ;

        Admin::insert($adminData);

    }
}
