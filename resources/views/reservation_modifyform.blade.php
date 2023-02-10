<x-app-layout>
  <x-slot name="header">
    <div class="absolute flex items-flexend right-0 mr-2">
      <x-header-auth />
    </div>
  </x-slot>
  <button type="button" class="ml-72 mt-16" onclick="location.href='{{ route('service.view')}}'">
    {{ __('＜前画面へ戻る') }}
  </button>
  <div class="flex-col sm:rounded-lg shadow-sm sm:px-6 lg:px-8">
    @if($validated)
    <x-modify-form-modal :id="$id" :restaurant="$restaurant" :reservationdate="$date" :reservationtime="$time" :reservationcount="$counts" :representativefamilyname="$representative_family_name" :representativelastname="$representative_last_name" :representativetel="$representative_tel" :representativemail="$representative_mail" :alert="$alert" /> @endif
    <form action="{{ route('reservation.modifyConfirm') }}" method="POST">
      @csrf
      <div class="flex justify-center">
        <h1 class="font-semibold p-6">予約管理</h1>
        <input name="id" value="{{ $id }}" type="hidden" />
      </div>
      <div class="mt-6">
        @if ($errors -> any()) @foreach ($errors -> all() as $key => $message)
        <p class="flex justify-center text-red-600 text-xs">{{ $message }}</p>
        @endforeach @endif
      </div>
      <div class="py-12 flex justify-center">
        <div class="max-w-3xl px-12">
          <table>
            <tbody>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                </td>
                <td class="pl-3">
                  <div class="font-semibold p-2 border-l-8 border w-60">店舗概要</div>
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                </td>
                <td class="pl-3 text-2xl p-8">
                  <input id="restaurant" name="restaurant" value="{{ $restaurant }}" />
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                </td>
                <td class="pl-3 flex justify-between">
                  <div class="font-semibold p-2 border-l-8 border w-60">予約日時・人数</div>
                </td>
              </tr>
              <tr>
                <td>
                </td>
                <td class="pt-6">
                  <div class="text-xs text-right">
                    <span class="material-symbols-outlined">
                      edit
                    </span>
                    <input type="button" value="修正" class="underline" onclick="editableReservation()" name="date">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="pl-2 text-sm">
                  日時
                </td>
                <td class="pl-3">
                  <x-input id="date" class="block mt-2 w-full read-only:bg-gray-300" value="{{ $date }}" type="date" name="date" readonly />
                </td>
              </tr>
              <tr>
                <td>
                </td>
                <td class="pl-3">
                  <select id="time" class="block mt-8 w-full select rounded-md border-gray-300 disabled" name="time" tabindex="-1">
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
                  <select id="counts" class="block mt-8 w-full select rounded-md border-gray-300 disabled" name="counts" selected="{{ $counts }}" tabindex="-1">
                    @foreach(config('count') as $key => $count)
                    <option value="{{ $key }}" {{ $key==$counts ? 'selected' : '' }}>{{ $count['label'] }}</option>
                    @endforeach
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="max-w-3xl px-12">
          <table class="w-90">
            <tbody>
              <tr>
                <td class="pt-6 pl-2 text-sm">
                </td>
                <td class="pl-3 flex justify-between">
                  <div class="font-semibold p-2 border-l-8 border w-60">代表者</div>
                </td>
              </tr>
              <tr>
                <td>
                </td>
                <td class="pt-6">
                  <div class="text-xs text-right">
                    <span class="material-symbols-outlined">
                      edit
                    </span>
                    <input type="button" value="修正" class="underline" onclick="editableRepresentive()" name="date">
                  </div>
                </td>
              </tr>
              <tr>
                <td class="pt-6 pl-2 text-sm text-right w-25">
                  氏名
                </td>
                <td class="pl-3">
                  <div class="flex">
                    <x-input id="representative_family_name" class="block mt-2 w-half read-only:bg-gray-300" value="{{Auth::user()->family_name}}" name="representative_family_name" type="text" readonly />
                    <x-input id="representative_last_name" class="block mt-2 w-half ml-2 read-only:bg-gray-300" value="{{Auth::user()->last_name}}" name="representative_last_name" type="text" readonly />
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
        <x-button class="ml-3 mb-4 w-30 justify-center p-6" name="button" value="edit">
          {{ __('修正') }}
        </x-button>
        <x-button class="ml-3 mb-4 w-30 justify-center p-6" name="button" value="delete">
          {{ __('予約取消') }}
        </x-button>
      </div>
    </form>
</x-app-layout>