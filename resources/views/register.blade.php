<x-app-layout>
  <x-slot name="header">
    <div class="absolute flex items-flexend right-0 mr-2">
      <form method="post" action="{{ route('service.login') }}">
        @csrf
        <input type="submit" class="no-underline text-sm text-gray-600 hover:text-gray-900" value="ログイン" />
      </form>
    </div>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white mx-auto overflow-hidden shadow-sm sm:rounded-lg sm:px-6 lg:px-8">
        <h1 class="font-semibold text-xl flex justify-center text-gray-800 leading-tight px-0 mt-6 mb-4">
          会員登録
        </h1>
        <div id="errormsg">
          @if ($errors->any()) @foreach ($errors->all() as $key => $message)
          <p class="flex justify-center text-red-600 text-sm">{{ $message }}</p>
          @endforeach @endif
        </div>
        <form method="POST" action="{{ route('register.check') }}">
          @csrf
          <table class="table-fixed w-full flex justify-center">
            <tbody>
              <tr>
                <td class="w-32 py-6">
                  <x-label for="name" class="text-right" :value="__('氏名')" />
                </td>
                <td class="w-72">
                  <div class="flex justify-start">
                    <x-input id="family_name" class="block mt-1 w-40" type="text" name="family_name" maxlength="128" placeholder="姓" value="{{ $family_name ?? old('family_name', '') }}" />
                    <x-input id="last_name" class="block mt-1 w-40 ml-2" type="text" name="last_name" maxlength="128" placeholder="名" value="{{ $last_name ?? old('last_name', '') }}" />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <x-label for="tel" class="text-right" :value="__('電話番号')" />
                </td>
                <td class="w-72">
                  <x-input id="tel" class="block mt-1 w-80" type="tel" name="tel" placeholder="090********(ハイフン不要)" value="{{ $tel ?? old('tel', '') }}" />
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <x-label for="mail" class="text-right" :value="__('メールアドレス')" />
                </td>
                <td class="w-72">
                  <x-input id="mail" class="block mt-1 w-80" type="text" name="mail" maxlength="128" placeholder="test78abcde@servece.com" value="{{ $mail ?? old('mail', '') }}" />
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <x-label for="password" class="text-right" :value="__('パスワード')" />
                </td>
                <td class="w-72">
                  <div class="flex justify-start">
                    <x-input id="password" class="block mt-1 w-72" type="password" name="password" placeholder="英数字8文字以上" />
                    <button type="button" id="password-view" class="text-xs ml-2" onclick="password_view()">表示</button>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <x-label for="password_check" class="text-right" :value="__('パスワード（確認）')" />
                </td>
                <td class="w-72">
                  <div class="flex justify-start">
                    <x-input id="password_check" class="block mt-1 w-72" type="password" name="password_check" placeholder="英数字8文字以上" />
                    <button type="button" id="password_check-view" class="text-xs ml-2" onclick="password_view_check()">表示</button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex justify-center mt-4">
            <x-button class="mb-4">
              {{ __('確認') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>