<x-app-layout>
  <x-slot name="header">
    <div class="absolute flex items-flexend right-0 mr-2">
      @auth
      <x-header-auth />
      @endauth
      @guest
      <x-header_non_auth />
      @endguest
    </div>
  </x-slot>

  <form action="{{ route('service.search') }}" method="GET">
    <div class="flex-col bg-gray-100 sm:rounded-lg shadow-sm sm:px-6 lg:px-8">
      @csrf
      <div class="flex justify-center">
        <h1 class="font-semibold p-6">条件入力</h1>
      </div>
      <div>
        <div class="flex mx-auto overflow-hidden">
          <div class="w-full">
            <div>
              <p class="text-gray-700 text-sm">・条件を入力してください</p>
            </div>
            <table class="table-fixed w-full justify-center">
              <tbody>
                <tr class="form-padding">
                  <td class="w-full flex">
                    <select id="pref" class="block mt-8 w-1/2 ml-2 select rounded-md border-gray-300" type="text" name="pref" placeholder="都道府県" onchange="onchangePref()">
                      <option value="" disabled selected>都道府県</option>
                      @foreach($prefs as $pref)
                      <option value="{{ $pref['prefName'] }}">{{ $pref['prefName'] }}</option>
                      @endforeach
                    </select>
                    <select id="municipalities" class="block mt-8 w-1/2 ml-2 select rounded-md border-gray-300" type="text" name="municipalities" placeholder="市区町村">
                      <option value="" disabled selected>市区町村</option>
                    </select>
                  </td>
                </tr>
                <tr class="form-padding">
                  <td class="w-full flex">
                    <x-input id="date" class="block mt-8 w-full" type="date" name="date" />
                    <select id="time" class="block mt-8 w-1/2 ml-2 select rounded-md border-gray-300" name="time" placeholder="時間">
                      <option value="" disabled selected>時間</option>
                      @foreach(config('reservation_time') as $key => $reservation_time)
                      <option value="{{ $key }}">{{ $reservation_time['label'] }}</option>
                      @endforeach
                    </select>
                    <select id="counts" class="block mt-8 w-1/2 ml-2 select rounded-md border-gray-300" name="counts" placeholder="人数">
                      <option value="" disabled selected>人数</option>
                      @foreach(config('count') as $key => $count)
                      <option value="{{ $key }}">{{ $count['label'] }}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="space-x-5">
            <div>
              <p class="text-gray-700 text-sm">ジャンル</p>
            </div>
            <div id="container" class="checkbox flex flex-wrap">
              @foreach(config('genre') as $key => $genre)
              <label class="p-2 relative block">
                <x-input type="checkbox" value="{{ $genre['id'] }}" name="genre[]" class="hidden" /><span class="block text-indigo-700 border border-indigo-400 rounded-3xl p-2 text-xs text-center">{{ $genre['label'] }}</span>
              </label> @endforeach
            </div>
          </div>
        </div>
      </div>
      <div>
        <div class="flex justify-center mt-4">
          <x-button class="ml-3 mb-4 w-30 justify-center p-6">
            {{ __('検索') }}
          </x-button>
        </div>
      </div>
    </div>
  </form>

  <div class="py-12 px-72">
    @foreach($restaurants as $restaurant)
    <x-result-label :restaurant="$restaurant" :genres="$genres" :date="$date" :time="$time" :counts="$counts" />
    @endforeach
  </div>
</x-app-layout>