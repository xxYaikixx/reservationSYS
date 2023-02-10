<div class="container rounded-3xl border h-80 mt-4">
  <div class="bg-indigo-50 rounded-t-3xl h-48">
    <p class="text-right pr-4 pt-2">{{ $genres[$restaurant['genre']]['label']}}</p>
    <h1 class="pl-3 pt-24 text-4xl font-semibold">{{ $restaurant['restaurant_name'] }}</h1>
    <div class="flex">
      <p class="pl-3">@for($i = 0; $i<$restaurant[ 'price' ]; $i++) ￥ @endfor </p>
          <p class="text-gray-400 pl-1">@for ($i = 0; $i<(5-$restaurant[ 'price' ]); $i++) ￥ @endfor </p>
    </div>
  </div>
  <div class="px-3 pt-2">
    <div class="flex justify-between pr-8">
      <p class="text-gray-500 text-xs">{{ $restaurant['line'] }}線{{ $restaurant['station'] }}駅 徒歩{{ $restaurant['minutes'] }}分</p>
      <form action="{{ route('reservation.form') }}" method="get">
        @csrf
        <input type="hidden" id="date" name="date" value="{{ $date }}" />
        <input type="hidden" id="time" name="time" value="{{ $time }}" />
        <input type="hidden" id="counts" name="counts" value="{{ $counts }}" />
        <input type="hidden" id="restaurant_name" name="restaurant_name" value="{{ $restaurant['restaurant_name'] }}" />
        <x-button class="ml-3 mb-4 w-20 justify-center">
          {{ __('予約') }}
        </x-button>
      </form>
    </div>
    <div class="border-t border-dotted">
      <p class="text-xs">{{ $restaurant['catchphrase'] }}</p>
    </div>
  </div>
</div>