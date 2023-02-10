<x-app-layout>
  <x-slot name="header">
    <div class="absolute flex items-flexend right-0 mr-2">
      <a class="no-underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('account.register') }}">
        {{ __('会員登録') }}
      </a>
    </div>
  </x-slot>

  <div class="py-12 justify-center">
    <div class="mx-32 sm:px-6 lg:px-16">
      <div class="mx-96 overflow-hidden shadow-sm sm:rounded-lg sm:px-6 lg:px-8 bg-gray-100">
        <h1 class="font-semibold text-xl flex justify-center text-gray-800 leading-tight px-0 mt-6">
          ログイン
        </h1>
        <div class="mt-6">
          @if ($errors -> any()) @foreach ($errors -> all() as $key => $message)
          <p class="flex justify-center text-red-600 text-xs">{{ $message }}</p>
          @endforeach @endif
        </div>
        <form method="POST" action="{{ route('login.check') }}">
          @csrf
          <table class="table-fixed w-full justify-center">
            <tbody>
              <tr class="form-padding">
                <td class="w-full">
                  <x-input id="mail" class="block mt-8 w-full" type="email" name="mail" placeholder="メールアドレス" />
                </td>
              </tr>
              <tr class="form-padding">
                <td class="w-full">
                  <x-input id="password" class="block mt-8 w-full" type="password" name="password" placeholder="パスワード" />
                </td>
              </tr>
            </tbody>
          </table>
          <div class="flex justify-center mt-4">
            <x-button class="ml-3 mb-4">
              {{ __('ログイン') }}
            </x-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>