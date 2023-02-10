<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class AccountLoginRequest extends FormRequest
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
          'mail' => ['required'],
          'password' => ['required'],
        ];
    }

    public function messages()
    {
        return [
          'mail.required' => 'メールアドレスが未入力です',
          'password.required' => 'パスワードが未入力です',
        ];
    }

        /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        if (! Auth::attempt($this->only('mail', 'password'))) {
            throw ValidationException::withMessages([
                'mail' => trans('auth.failed'),
            ]);
        }
    }
}
