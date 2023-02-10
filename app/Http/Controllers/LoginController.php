<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{

    public function show(Request $request)
    {
        return view('service_top');
    }

    public function confirm(AccountLoginRequest $request)
    {
        $validated = $request->validated();
        $request->session()->regenerate();
        $request->authenticate();
        $token = csrf_token();

        parse_str(parse_url(URL::previous(), PHP_URL_QUERY), $params);
        if (array_key_exists('to', $params)) {
            return redirect($params['to']);
        } else {
            return redirect()
                ->route('service.top');
        }
    }
}
