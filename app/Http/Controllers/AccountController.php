<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterConfirmRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function show(Request $request)
    {
        $account = new Account;
        $token = csrf_token();
        if ($request->has('data')) {
            return view("register", [
                'family_name' => $request['data']['family_name'],
                'last_name' => $request['data']['last_name'],
                'tel' => $request['data']['tel'],
                'mail' => $request['data']['mail'],
                'account' => $account,
            ]);
        } else {
            return view("register", ['account' => $account]);
        }
    }

    public function confirm(RegisterConfirmRequest $request)
    {
        $validated = $request->validated();
        $data = $request->all();
        return view("register_confirm", [
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $account = new Account;
        $account->family_name = $request->family_name;
        $account->last_name = $request->last_name;
        $account->tel = $request->tel;
        $account->mail = $request->mail;
        $account->password = Hash::make($request->password);
        $account->save();
        Auth::login($account);
        Session::put('account', $account);
        return view("service_top", ['account' => $account]);
    }
}
