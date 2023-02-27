<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('restaurants')->insert([
            'id' => 1,
            'restaurant_name' => '和食札幌',
            'pref' => '北海道',
            'municipalities' => '札幌市',
            'catchphrase' => 'うどんがおいしい',
            'line' => 'テスト鉄道1',
            'station' => 'テスト1',
            'minutes' => '1',
            'price' => 1,
            'genre' => 2,
        ]);

        DB::table('restaurants')->insert([
            'id' => 2,
            'restaurant_name' => '寿司HOKKAIDO',
            'pref' => '北海道',
            'municipalities' => '札幌市北区',
            'catchphrase' => '寿司ネタうまい',
            'line' => 'テスト鉄道2',
            'station' => 'テスト2',
            'minutes' => '2',
            'price' => 2,
            'genre' => 2,
        ]);

        DB::table('restaurants')->insert([
            'id' => 3,
            'restaurant_name' => 'コリアン札幌',
            'pref' => '北海道',
            'municipalities' => '札幌市北区',
            'catchphrase' => 'キムチがうまい！',
            'line' => 'テスト鉄道2',
            'station' => 'テスト2.5',
            'minutes' => '10',
            'price' => 3,
            'genre' => 7,
        ]);

        DB::table('restaurants')->insert([
            'id' => 4,
            'restaurant_name' => 'レストラン4',
            'pref' => '北海道',
            'municipalities' => '札幌市北区',
            'catchphrase' => 'テスト4テスト2テスト2',
            'line' => 'テスト鉄道2',
            'station' => 'テスト2',
            'minutes' => '12',
            'price' => 4,
            'genre' => 2,
        ]);

        DB::table('restaurants')->insert([
            'id' => 5,
            'restaurant_name' => 'レストラン5',
            'pref' => '北海道',
            'municipalities' => '札幌市北区',
            'catchphrase' => 'テスト4テスト44テスト22',
            'line' => 'テスト鉄道2',
            'station' => 'テスト2.6',
            'minutes' => '5',
            'price' => 1,
            'genre' => 3,
        ]);

        DB::table('restaurants')->insert([
            'id' => 6,
            'restaurant_name' => 'レストラン6',
            'pref' => '神奈川県',
            'municipalities' => '川崎市',
            'catchphrase' => 'テスト3テスト3テスト3テスト3',
            'line' => 'テスト鉄道3',
            'station' => 'テスト3',
            'minutes' => '3',
            'price' => 1,
            'genre' => 6,
        ]);

        DB::table('restaurants')->insert([
            'id' => 7,
            'restaurant_name' => 'レストラン7',
            'pref' => '東京都',
            'municipalities' => '港区',
            'catchphrase' => 'テスト5テスト5テスト5テスト5テスト5テスト5',
            'line' => 'テスト鉄道5',
            'station' => 'テスト5',
            'minutes' => '5',
            'price' => 1,
            'genre' => 2,
        ]);

        DB::table('restaurants')->insert([
            'id' => 8,
            'restaurant_name' => 'レストラン8',
            'pref' => '沖縄県',
            'municipalities' => '那覇市',
            'catchphrase' => 'テスト6テスト6テスト6テスト6テスト6テスト6',
            'line' => 'テスト鉄道6',
            'station' => 'テスト6',
            'minutes' => '2',
            'price' => 1,
            'genre' => 11,
        ]);

        DB::table('restaurants')->insert([
            'id' => 9,
            'restaurant_name' => 'レストラン9',
            'pref' => '愛知県',
            'municipalities' => '名古屋市',
            'catchphrase' => 'テスト7テスト7テスト7テスト7テスト7',
            'line' => 'テスト鉄道7',
            'station' => 'テスト7',
            'minutes' => '3',
            'price' => 2,
            'genre' => 2,
        ]);
    }
}
