<x-app-layout>
  <x-slot name="header">
    <div class="absolute flex items-flexend right-0 mr-2">
      <x-header-auth />
    </div>
  </x-slot>
  <div class="flex-col sm:rounded-lg shadow-sm sm:px-6 lg:px-8">
    @if($validated)
    <x-form-modal :restaurant="$restaurant" :reservationdate="$date" :reservationtime="$time" :reservationcount="$counts" :representativefamilyname="$representative_family_name" :representativelastname="$representative_last_name" :representativetel="$representative_tel" :representativemail="$representative_mail" :alert="$alert" />
    @endif
    <form action="{{ route('reservation.confirm') }}" method="POST">
      @csrf
      <div class="flex justify-center">
        <h1 class="font-semibold p-6">予約フォーム</h1>
      </div>
      <div class="mt-6">
        @if ($errors -> any())
        @foreach ($errors -> all() as $key => $message)
        <p class="flex justify-center text-red-600 text-xs">{{ $message }}</p>
        @endforeach
        @endif
      </div>
      <div class="py-12 flex justify-center">
        <input type="hidden" id="restaurant" name="restaurant" value="{{ $restaurant }}" />
        <div class="max-w-3xl">
          <table>
            <tbody>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                </td>
                <td class="pl-3">
                  <div class="font-semibold p-2 border-l-8 border w-60">予約日時・人数</div>
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                  日時
                </td>
                <td class="pl-3">
                  <x-input id="date" class="block mt-8 w-full" value="{{ $date }}" type="date" name="date" />
                </td>
              </tr>
              <tr>
                <td>
                </td>
                <td class="pl-3">
                  <select id="time" class="block mt-8 w-full select rounded-md border-gray-300" name="time">
                    @foreach(config('reservation_time') as $key => $reservation_time)
                    <option value="{{ $key }}" {{ $key==$time ? 'selected' : '' }}>{{ $reservation_time['label'] }}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                  人数
                </td>
                <td class="pl-3">
                  <select id="counts" class="block mt-8 w-full select rounded-md border-gray-300" name="counts" selected="{{ $counts }}">
                    @foreach(config('count') as $key => $count)
                    <option value="{{ $key }}" {{ $key==$counts ? 'selected' : '' }}>{{ $count['label'] }}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="max-w-3xl">
          <table class="w-90">
            <tbody>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                </td>
                <td class="pl-3 flex justify-between">
                  <div class="font-semibold p-2 border-l-8 border w-60">代表者</div>
                  <div class="text-xs">
                    <span class="material-symbols-outlined">
                      edit
                    </span>
                    <input type="button" value=編集 class="underline" onclick="editable()" name="date">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm text-right w-25">
                  氏名
                </td>
                <td class="pl-3">
                  <div class="flex">
                    <x-input id="representative_family_name" class="block mt-8 w-half read-only:bg-gray-300" value="{{Auth::user()->family_name}}" name="representative_family_name" type="text" readonly />
                    <x-input id="representative_last_name" class="block mt-8 w-half ml-2 read-only:bg-gray-300" value="{{Auth::user()->last_name}}" name="representative_last_name" type="text" readonly />
                  </div>
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm text-right">
                  電話番号
                </td>
                <td class="pl-3">
                  <x-input id="representative_tel" class="block mt-8 w-90 read-only:bg-gray-300" value="{{Auth::user()->tel}}" name="representative_tel" type="text" readonly />
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm text-right">
                  メールアドレス
                </td>
                <td class="pl-3">
                  <x-input id="representative_mail" class="block mt-8 w-full read-only:bg-gray-300" value="{{Auth::user()->mail}}" name="representative_mail" type="email" readonly />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="flex justify-center mt-4">
        <x-button class="ml-3 mb-4 w-30 justify-center p-6">
          {{ __('予約') }}
        </x-button>
      </div>
    </form>
</x-app-layout>