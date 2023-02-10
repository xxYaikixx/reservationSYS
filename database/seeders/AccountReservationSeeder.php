<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account_reservations')->insert([
            'id' => 1,
            'account_id' => 1,
            'restaurant_id' => 1,
            'reservation_datetime' => '2100/03/01 18:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 2,
            'account_id' => 1,
            'restaurant_id' => 2,
            'reservation_datetime' => '2022/06/22 20:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 3,
            'account_id' => 1,
            'restaurant_id' => 3,
            'reservation_datetime' => '2000/04/01 12:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 4,
            'account_id' => 1,
            'restaurant_id' => 3,
            'reservation_datetime' => '2023/03/01 15:00:00',
            'reservation_count' => '3',
            'representative_family_name' => '姓のテスト1',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 5,
            'account_id' => 1,
            'restaurant_id' => 4,
            'reservation_datetime' => '2022/08/14 19:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト2',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 6,
            'account_id' => 1,
            'restaurant_id' => 5,
            'reservation_datetime' => '2023/12/22 10:00:00',
            'reservation_count' => '4',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 7,
            'account_id' => 2,
            'restaurant_id' => 5,
            'reservation_datetime' => '2023/11/30 20:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0311112222',
            'representative_mail' => 'test321@testaddress.com',
        ]);

        DB::table('account_reservations')->insert([
            'id' => 8,
            'account_id' => 1,
            'restaurant_id' => 6,
            'reservation_datetime' => '2025/06/19 11:00:00',
            'reservation_count' => '4',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]);
    }
}
