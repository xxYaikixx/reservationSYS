<?php

namespace Tests\Feature;

use app\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationViewTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    // [予約照会case2,3,4] 予約一覧画面上にある予約が過去日付になっていないか
    public function test_view_case2_3_4()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get('service/reservation/list?page=1');
        $response->assertSee('<p class="ml-4 mt-8">2022/06/22 20:00〜', $escaped = false);
        $response->assertDontSeeText('2000/04/01 12:00〜', $escaped = false);
        $response = $this->actingAs($account)->get('service/reservation/list?page=2');
        $response->assertSee('<p class="ml-4 mt-8">2100/03/01 18:00〜', $escaped = false);
        $response->assertDontSeeText('2000/04/01 12:00〜', $escaped = false);
    }

    // [予約照会case5] 予約日付が未来日付のみの利用者予約データすべてが予約一覧画面上に表示されているか
    public function test_view_case5()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get('service/reservation/list?page=1');
        $response->assertSee('<p class="ml-4 mt-8">2022/06/22 20:00〜', $escaped = false);
        $response->assertSee('<p class="ml-4 mt-8">2022/08/14 19:00〜', $escaped = false);
        $response->assertSee('<p class="ml-4 mt-8">2023/03/01 15:00〜', $escaped = false);
        $response->assertSee('<p class="ml-4 mt-8">2023/12/22 10:00〜', $escaped = false);
        $response->assertSee('<p class="ml-4 mt-8">2025/06/19 11:00〜', $escaped = false);

        $response = $this->actingAs($account)->get('service/reservation/list?page=2');
        $response->assertSee('<p class="ml-4 mt-8">2100/03/01 18:00〜', $escaped = false);
    }

    // [予約照会case6] 利用者IDがログインユーザーIDである利用者予約データすべてが予約一覧画面上に表示されているか
    // [予約照会case7] 利用者予約データが日付の昇順になっているか
    // [予約照会case8] ページングが正しく機能しているか
    // [予約照会case9] ユーザー認証をしている場合、予約一覧画面に直接アクセスできるか
    public function test_view_case6_7_8_9()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get('service/reservation/list?page=1');
        $response->assertSeeText('姓のテスト 名のテスト &nbsp;様の予約一覧', $escaped = false);
        $this->assertEquals('2022-06-22 20:00:00', $response['accountreservations'][0]->reservation_datetime);
        $this->assertEquals('2022-08-14 19:00:00', $response['accountreservations'][1]->reservation_datetime);
        $this->assertEquals('2023-03-01 15:00:00', $response['accountreservations'][2]->reservation_datetime);
        $this->assertEquals('2023-12-22 10:00:00', $response['accountreservations'][3]->reservation_datetime);
        $this->assertEquals('2025-06-19 11:00:00', $response['accountreservations'][4]->reservation_datetime);
        $response->assertDontSeeText('2023/11/30 20:00〜', $escaped = false);
        $this->assertEquals(5, count($response['accountreservations']));
        $response = $this->actingAs($account)->get('service/reservation/list?page=2');
        $this->assertEquals('2100-03-01 18:00:00', $response['accountreservations'][0]->reservation_datetime);
        $this->assertEquals(1, count($response['accountreservations']));
        $response->assertDontSeeText('2023/11/30 20:00〜', $escaped = false);
    }

    // [予約照会case10] ユーザー認証をしていない場合、予約一覧画面へアクセスするとログイン画面に遷移されるか
    // [予約照会case11] ユーザー認証をしていない場合に遷移されるログイン画面でログインしたとき、予約一覧画面に遷移されるか
    public function test_view_case10_11()
    {
        $account = Account::factory()->create();
        $response = $this->get(route('service.view'));
        $response->assertRedirect('http://localhost/service/login?to=http%3A%2F%2Flocalhost%2Fservice%2Freservation%2Flist');
        $response = $this->get(route('service.login'));
        $response->assertSee('ログイン', $escaped = false);
        $response->assertDontSee('予約一覧', $escaped = false);
        $response = $this->actingAs($account)->get(route('service.view'));
        $response->assertSee('予約一覧', $escaped = false);
    }

    // [予約照会case12] 予約登録処理後に予約一覧画面上にメッセージが表示されるか
    public function test_view_case12()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->post(route('reservation.store'), [
            "reservation_restaurant" => 'レストラン1',
            "reservation_date" => '2022-05-01',
            "reservation_time" => '18:00',
            "reservation_count" => '2',
            "representative_family_name" => '姓のテスト',
            "representative_last_name" => '名のテスト',
            "representative_tel" => '0312345678',
            "representative_mail" => 'test123@testaddress.com',
        ])->assertRedirect('http://localhost/service/reservation/list?accountreservations%5BonEachSide%5D=3')->assertSessionHas('flash_message', '予約が完了しました');
    }

    // [予約照会case13]予約修正処理後に予約一覧画面上にメッセージが表示されるか
    public function test_view_case13()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->put(route(
            'reservation.edit',
            [
            'id' => 1,
            'reservation_date' => '2024-03-01',
            'reservation_time' => '18:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]
        ))->assertRedirect('http://localhost/service/reservation/list?accountreservations%5BonEachSide%5D=3')->assertSessionHas('flash_message', '予約を修正しました');
    }

    // [予約照会case14]予約取消処理後に予約一覧画面上にメッセージが表示されるか
    public function test_view_case14()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->delete(route(
            'reservation.edit',
            [
            'id' => 1,
            'reservation_date' => '2100-03-01',
            'reservation_time' => '18:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ]
        ))->assertRedirect('http://localhost/service/reservation/list?accountreservations%5BonEachSide%5D=3')->assertSessionHas('flash_message', '予約を取り消しました');
    }

    // [予約編集画面作成case1,2,3,4]予約編集画面の項目が予約一覧画面で選択した予約の項目と紐付けがされているか
    public function test_create_screen_case_1_2_3_4()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get(route('reservation.modifyForm', [
            "id" => 1,
            "date" => '2100-03-01',
            "time" => '18:00',
            "counts" => '2',
            "restaurant_name" => 'レストラン1',
            'validated' => false,
        ]));
        $response->assertSee('2100-03-01', $escaped = false);
        $response->assertSee('18:00', $escaped = false);
        $response->assertSee('2', $escaped = false);
        $response->assertSee('レストラン1', $escaped = false);
    }

    // [予約編集画面作成case5]予約編集画面の代表者がログインアカウントの情報のものになっているか
    public function test_create_screen_case_5()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get(route('reservation.modifyForm', [
            "id" => 1,
            "date" => '2100-03-01',
            "time" => '18:00',
            "counts" => '2',
            "restaurant_name" => 'レストラン1',
            'validated' => false,
        ]));
        $response->assertSee('姓のテスト', $escaped = false);
        $response->assertSee('名のテスト', $escaped = false);
        $response->assertSee('0312345678', $escaped = false);
        $response->assertSee('test123@testaddress.com', $escaped = false);
    }

    // [予約編集画面作成case6][予約修正case5][予約取消case5] ユーザー認証をしている場合、予約編集画面に直接アクセスできるか
    public function test_case6()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get(route('reservation.modifyForm', [
            "id" => 1,
            "date" => '2100-03-01',
            "time" => '18:00',
            "counts" => '2',
            "restaurant_name" => 'レストラン1',
            'validated' => false,
        ]));
        $response->assertSee('予約管理', $escaped = false);
    }

    // [予約編集画面作成case7][予約修正case6][予約取消case6] ユーザー認証をしていない場合、予約編集画面へアクセスするとログイン画面に遷移されるか
    // [予約編集画面作成case8][予約修正case7][予約取消case6] ユーザー認証をしていない場合に遷移されるログイン画面でログインしたとき、予約編集画面に遷移されるか
    public function test_case7_8()
    {
        $account = Account::factory()->create();
        $response = $this->get(route('reservation.modifyForm', [
            "id" => 1,
            "date" => '2100-03-01',
            "time" => '18:00',
            "counts" => '2',
            "restaurant_name" => 'レストラン1',
            'validated' => false,
        ]));
        $response->assertRedirect('http://localhost/service/login?to=http%3A%2F%2Flocalhost%2Fservice%2Freservation%2Fedit%3Fcounts%3D2%26date%3D2100-03-01%26id%3D1%26restaurant_name%3D%25E3%2583%25AC%25E3%2582%25B9%25E3%2583%2588%25E3%2583%25A9%25E3%2583%25B31%26time%3D18%253A00%26validated%3D0');
        $response = $this->get(route('service.login'));
        $response->assertSee('ログイン', $escaped = false);
        $response->assertDontSee('予約管理', $escaped = false);
        $response = $this->actingAs($account)->get(route('reservation.modifyForm'));
        $response->assertSee('予約管理', $escaped = false);
    }

    // [予約編集画面作成case9][予約修正case1][予約削除case1] 予約編集画面のパスが正しいか
    public function test_case9()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->get('/service/reservation/edit', [
            "id" => 1,
            "date" => '2100-03-01',
            "time" => '18:00',
            "counts" => '2',
            "restaurant_name" => 'レストラン1',
            'validated' => false,
        ]);
        $response->assertSee('予約管理', $escaped = false);
    }

    // [予約修正case2、3]予約編集画面の修正ボタンをクリックした場合、パラメータの取得を正しく行うことができるか
    public function test_edit_case2_3()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->post(route(
            'reservation.modifyConfirm',
            [
            'id' => '1',
            'restaurant' => 'レストラン1',
            'date' => '2024-03-01',
            'time' => '18:00',
            'counts' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
            'button' => 'edit',
        ],
        ));

        $response->assertSee('以下で修正をします。よろしいですか。', $escaped = false);
        $response->assertSee('<td class="pl-2">2024/03/01 18:00〜 レストラン1 2名様</td>', $escaped = false);
        $response->assertSee('<td class="pl-2">姓のテスト 名のテスト</td>', $escaped = false);
        $response->assertSee('<td class="pl-2">0312345678</td>', $escaped = false);
        $response->assertSee('<td class="pl-2">test123@testaddress.com</td>', $escaped = false);
    }

    // [予約修正case4]予約が正しく修正されているか
    public function test_edit_case4()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->put(route(
            'reservation.edit',
            [
            'id' => 1,
            'reservation_date' => '2024-03-01',
            'reservation_time' => '18:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ],
        ));
        $this->assertDatabaseHas('account_reservations', [
            "id" => 1,
            "account_id" => 1,
            "restaurant_id" => 1,
            "reservation_datetime" => '2024-03-01 18:00:00',
            "reservation_count" => '2',
            "representative_family_name" => '姓のテスト',
            "representative_last_name" => '名のテスト',
            "representative_tel" => '0312345678',
            "representative_mail" => 'test123@testaddress.com',
        ]);
    }

    // [予約取消case2、3]予約編集画面の修正ボタンをクリックした場合、パラメータの取得を正しく行うことができるか
    public function test_delete_case2_3()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->post(route(
            'reservation.modifyConfirm',
            [
            'id' => '1',
            'restaurant' => 'レストラン1',
            'date' => '2024-03-01',
            'time' => '18:00',
            'counts' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
            'button' => 'delete',
        ],
        ));

        $response->assertSee('以下の予約を削除します。よろしいですか。', $escaped = false);
        $response->assertSee('<td class="pl-2">2100/03/01 18:00〜 レストラン1 2名様</td>', $escaped = false);
        $response->assertSee('<td class="pl-2">姓のテスト 名のテスト</td>', $escaped = false);
        $response->assertSee('<td class="pl-2">0312345678</td>', $escaped = false);
        $response->assertSee('<td class="pl-2">test123@testaddress.com</td>', $escaped = false);
    }

    // [予約修正case4]予約が正しく削除されているか
    public function test_delete_case4()
    {
        $account = Account::factory()->create();
        $response = $this->actingAs($account)->delete(route(
            'reservation.edit',
            [
            'id' => 1,
            'reservation_date' => '2100-03-01',
            'reservation_time' => '18:00:00',
            'reservation_count' => '2',
            'representative_family_name' => '姓のテスト',
            'representative_last_name' => '名のテスト',
            'representative_tel' => '0312345678',
            'representative_mail' => 'test123@testaddress.com',
        ],
        ));
        $this->assertDatabaseMissing('account_reservations', [
            "id" => 1,
            "account_id" => 1,
            "restaurant_id" => 1,
            "reservation_datetime" => '2100-03-01 18:00:00',
            "reservation_count" => '2',
            "representative_family_name" => '姓のテスト',
            "representative_last_name" => '名のテスト',
            "representative_tel" => '0312345678',
            "representative_mail" => 'test123@testaddress.com',
        ]);
    }
}
