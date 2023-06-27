<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'ADMIN',
                'email' => 'rbplans@admin.com',
                'password' => Hash::make('adminrb@123456'),
            ],
            [
                'name' => 'Tainá',
                'email' => 'cavalcantetaina22@gmail.com',
                'password' => Hash::make('taina@123456')
            ]
        ]);
    }
}
