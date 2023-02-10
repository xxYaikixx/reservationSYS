<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationConfirmRequest;
use App\Models\AccountReservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function createView(Request $request)
    {
        $token = csrf_token();
        return view('reservation_form', [
            'date' => $request->date,
            'time' => $request->time,
            'counts' => $request->counts,
            'restaurant' => $request->restaurant_name,
            'validated' => false,
        ]);
    }

    public function confirm(ReservationConfirmRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        $alert = '以下の予約をします。よろしいですか。';
        return view("reservation_form", array_merge($data, ['validated' => $validated, 'alert' => $alert]));
    }

    public function store(Request $request)
    {
        $accountreservation = new AccountReservation;
        $accountreservation->account_id = DB::table('accounts')->where('family_name', Auth::user()->family_name)->value('id');
        $accountreservation->restaurant_id = DB::table('restaurants')->where('restaurant_name', $request->reservation_restaurant)->value('id');
        $accountreservation->reservation_datetime = date('Y-m-d H:i:s', (int) strtotime($request->reservation_date . ' ' . $request->reservation_time));
        $accountreservation->reservation_count = $request->reservation_count;
        $accountreservation->representative_family_name = $request->representative_family_name;
        $accountreservation->representative_last_name = $request->representative_last_name;
        $accountreservation->representative_tel = $request->representative_tel;
        $accountreservation->representative_mail = $request->representative_mail;
        $accountreservation->save();
        $accountreservations = DB::table('account_reservations')->where('account_id', $accountreservation->account_id)->paginate(5);
        session()->flash('flash_message', '予約が完了しました');
        return redirect()->route('service.view', ['accountreservations' => $accountreservations]);
    }

    public function listView()
    {
        $accountreservations = DB::table('account_reservations')
            ->where([
                ['account_id', DB::table('accounts')
                        ->where('family_name', Auth::user()->family_name)->value('id')],
                ['reservation_datetime', '>=', now()],
            ])
            ->orderBy('reservation_datetime')
            ->paginate(5);
        return view("reservation_list", [
            'accountreservations' => $accountreservations,
        ]);
    }

    public function createModifyView(Request $request)
    {
        $token = csrf_token();
        return view('reservation_modifyform', [
            'id' => $request->id,
            'date' => $request->date,
            'time' => $request->time,
            'counts' => $request->counts,
            'restaurant' => $request->restaurant_name,
            'validated' => false,
        ]);
    }

    public function modifyConfirm(ReservationConfirmRequest $request)
    {
        $accountreservation = new AccountReservation;
        $accountreservation->account_id = DB::table('accounts')->where('family_name', Auth::user()->family_name)->value('id');
        $accountreservations = DB::table('account_reservations')->where('account_id', $accountreservation->account_id)->paginate(5);
        if ($request->button === 'edit') {
            $validated = $request->validated();
            $data = $request->all();
            $alert = '以下で修正をします。よろしいですか。';
            return view("reservation_modifyform", array_merge($data, ['validated' => $validated, 'alert' => $alert]));
        } elseif ($request->button === 'delete') {
            // 削除の場合は、モーダルの中身の更新を行わない
            $validated = true;
            $reservationData = AccountReservation::find($request->id)->toArray();
            $data = array_merge($reservationData, ['restaurant' => $request->restaurant, 'date' => substr($reservationData['reservation_datetime'], 0, 10), 'time' => substr($reservationData['reservation_datetime'], 11, 5), 'counts' => $reservationData['reservation_count']]);
            $alert = '以下の予約を削除します。よろしいですか。';
            return view("reservation_modifyform", array_merge($data, ['validated' => $validated, 'alert' => $alert]));
        } else {
            return null;
        }
    }

    public function delete(Request $request)
    {
        $accountreservations = DB::table('account_reservations')->where('id', $request->id)->delete();
        $accountreservations = DB::table('account_reservations')->where('account_id', $request->account_id)->paginate(5);
        session()->flash('flash_message', '予約を取り消しました');
        return redirect()->route('reservation.delete', ['accountreservations' => $accountreservations]);
    }

    public function edit(Request $request)
    {
        $accountreservations = DB::table('account_reservations')->where('id', $request->id)->update([
            'reservation_datetime' => date('Y-m-d H:i:s', (int) strtotime($request->reservation_date . ' ' . $request->reservation_time)),
            'reservation_count' => $request->reservation_count,
            'representative_family_name' => $request->representative_family_name,
            'representative_last_name' => $request->representative_last_name,
            'representative_tel' => $request->representative_tel,
            'representative_mail' => $request->representative_mail,
        ]);
        $accountreservations = DB::table('account_reservations')->where('account_id', $request->account_id)->paginate(5);
        session()->flash('flash_message', '予約を修正しました');
        return redirect()->route('reservation.edit', ['accountreservations' => $accountreservations]);
    }
}
