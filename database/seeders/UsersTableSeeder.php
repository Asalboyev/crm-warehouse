<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\table;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            //Admineee
            [
                'name' => '1Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => 'active',
            ],
            // Selller
            [
                'name' => '1aleks',
                'username' => 'seller',
                'email' => 'selller@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'seller',
                'status' => 'active',
            ],
            // guard
            [
                'name' => '2aleks',
                'username' => 'guard',
                'email' => 'guard@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'guard',
                'status' => 'active',
            ],
            // warehouseman
            [
                'name' => '3aleks',
                'username' => 'warehouseman',
                'email' => 'warehouseman@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'warehouseman',
                'status' => 'active',
            ],
            //user
            [
                'name' => '4Aleks',
                'username' => 'aleks',
                'email' => 'aleks@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
