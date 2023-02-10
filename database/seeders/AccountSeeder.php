<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'id' => 1,
            'family_name' => '姓のテスト',
            'last_name' => '名のテスト',
            'tel' => '0312345678',
            'mail' => 'test123@testaddress.com',
            'password' => Hash::make('Password012'),
        ]);

        DB::table('accounts')->insert([
            'id' => 2,
            'family_name' => '姓のテスト2',
            'last_name' => '名のテスト2',
            'tel' => '0311112222',
            'mail' => 'test321@testaddress.com',
            'password' => Hash::make('Password123'),
        ]);
    }
}
