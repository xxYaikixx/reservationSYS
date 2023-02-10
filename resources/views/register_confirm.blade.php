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
        <h1 class="font-semibold text-xl flex justify-center text-gray-800 leading-tight px-0 mt-6">
          会員登録確認
        </h1>
        <div class="flex justify-center mt-6">以下で登録します。よろしいですか。</div>
        <form method="POST" action="{{ route('register.store') }}">
          @csrf
          <table class="table-fixed w-full flex justify-center">
            <tbody>
              <tr>
                <td class="w-32 py-6">
                  <label>氏名</label>
                </td>
                <td class="w-72">
                  {{ $data['family_name'] }}{{ $data['last_name'] }}
                  <input name="family_name" value="{{ $data['family_name'] }}" type="hidden">
                  <input name="last_name" value="{{ $data['last_name'] }}" type="hidden">
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <label>電話番号</label>
                </td>
                <td class="w-72">
                  {{ $data['tel'] }}
                  <input name="tel" value="{{ $data['tel'] }}" type="hidden">
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <label>メールアドレス</label>
                </td>
                <td class="w-72">
                  {{ $data['mail'] }}
                  <input name="mail" value="{{ $data['mail'] }}" type="hidden">
                </td>
              </tr>
              <tr>
                <td class="w-32 py-6">
                  <label>パスワード</label>
                </td>
                <td class="w-72">
                  <input name="password" id="password" value="{{ $data['password'] }}" type="password" style="border:none">
                  <button type="button" id="password-view" class="text-xs" onclick="password_view()">表示</button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex justify-center mt-4">
            <x-button type="button" class="mb-4" onclick="location.href='{{ route('account.register', ['data'=>$data])}}'">
              {{ __('修正') }}
            </x-button>
            <x-button class="mb-4 ml-12">
              {{ __('登録') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>