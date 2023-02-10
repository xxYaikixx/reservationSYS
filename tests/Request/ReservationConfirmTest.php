<?php

namespace Tests\Feature;

use App\Http\Requests\ReservationConfirmRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class ReservationConfirmTest extends TestCase
{
    use RefreshDatabase;
    /**
     * ReservationConfirmRequestのバリデーションテスト
     *
     * @param array 項目名の配列
     * @param array 値の配列
     * @param boolean 期待値(true:バリデーションOK、false:バリデーションNG)
     * @dataProvider data_ReservationConfirm
     */
    public function test_ReservationConfirm(array $keys, array $values, bool $expect)
    {
        $dataList = array_combine($keys, $values);
        $request = new ReservationConfirmRequest();
        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);
        $result = $validator->passes();
        $this->assertEquals($expect, $result);
    }

    public function data_ReservationConfirm()
    {
        return [
            //予約登録[Case1,3,5,7,9,11,17]
            //予約更新[Case9,11,13,15,17,19,25]
            '正常系' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', '0312345678', 'test123@testaddress.com'],
                true,
            ],
            //予約登録[Case2]
            //予約更新[Case10]
            '日付必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', null, '18:00', '2', '姓のテスト', '名のテスト', '0312345678', 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case4]
            //予約更新[Case12]
            '時間必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', null, '2', '姓のテスト', '名のテスト', '0312345678', 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case6]
            //予約更新[Case14]
            '人数必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', null, '姓のテスト', '名のテスト', '0312345678', 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case8]
            //予約更新[Case16]
            '代表者_姓必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', null, '名のテスト', '0312345678', 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case10]
            //予約更新[Case18]
            '代表者_名必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', null, '0312345678', 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case12]
            //予約更新[Case20]
            '電話番号形式エラー(0から始まらない)' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', str_repeat('1', 10), 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case13]
            //予約更新[Case21]
            '電話番号形式エラー(0始まり、半角数字以外の文字)' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', '0ab123456', 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case14]
            //予約更新[Case22]
            '電話番号形式エラー(0始まり、9文字未満)' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', str_repeat('0', 8), 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case15]
            //予約更新[Case23]
            '電話番号形式エラー(0始まり、11文字以上)' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', str_repeat('0', 20), 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case16]
            //予約更新[Case24]
            '電話番号必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', null, 'test123@testaddress.com'],
                false,
            ],
            //予約登録[Case18]
            //予約更新[Case26]
            'メールアドレス形式エラー(@なし)' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', '0312345678', 'test123★testaddress.com'],
                false,
            ],
            //予約登録[Case19]
            //予約更新[Case27]
            'メールアドレス形式エラー(@の周りに半角英数字記号なし)' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', '0312345678', '@'],
                false,
            ],
            //予約登録[Case20]
            //予約更新[Case28]
            'メールアドレス必須エラー' => [
                ['restaurant', 'date', 'time', 'counts', 'representative_family_name', 'representative_last_name', 'representative_tel', 'representative_mail'],
                ['レストラン1', '2022-05-01', '18:00', '2', '姓のテスト', '名のテスト', '0312345678', null],
                false,
            ],
        ];
    }
}
