<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationConfirmRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'restaurant' => [],
            'date' => ['required'],
            'time' => ['required'],
            'counts' => ['required'],
            'representative_family_name' => ['required'],
            'representative_last_name' => ['required'],
            'representative_tel' => ['required', 'regex:/^0[0-9]{9,10}$/'],
            'representative_mail' => ['required', 'email', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'restaurant' => '',
            'date.required' => '日付が未入力です',
            'time.required' => '時間が未入力です',
            'counts.required' => '人数が未入力です',
            'representative_family_name.required' => '代表者_姓が未入力です',
            'representative_last_name.required' => '代表者_名が未入力です',
            'representative_tel.required' => '代表者_電話番号が未入力です',
            'representative_mail.required' => '代表者_メールアドレスが未入力です',
            'representative_mail.email' => '代表者_メールアドレスが不正です',
        ];
    }
}
