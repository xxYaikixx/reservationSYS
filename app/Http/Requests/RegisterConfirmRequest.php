<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordRule;

class RegisterConfirmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'family_name' => ['required'],
          'last_name' => ['required'],
          'tel' => ['required', 'regex:/^0[0-9]{9,10}$/'],
          'mail' => ['required', 'email', 'max:255'],
          'password' => ['required', new PasswordRule(), 'same:password_check'],
        ];
    }

    public function messages()
    {
        return [
          'family_name.required' => '氏名_姓が未入力です',
          'last_name.required' => '氏名_名が未入力です',
          'tel.required' => '電話番号が未入力です',
          'mail.required' => 'メールアドレスが未入力です',
          'mail.email' => 'メールアドレスが不正です',
          'password.required' => 'パスワードが未入力です',
          'password.same' => 'パスワードとパスワード(確認)が不一致です',
        ];
    }


}
