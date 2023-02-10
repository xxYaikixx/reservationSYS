<x-app-layout>
  <x-slot name="header">
    <div class="absolute flex items-flexend right-0 mr-2">
      <x-header-auth />
    </div>
  </x-slot>
  @if (session('flash_message'))
  <div class="w-8/12 mx-auto">
    <div id=" flash_message" class="w-1/2 mt-8 bg-gray-100 h-8 rounded-md fadeout">
      <p class="pt-1 pl-1">{{ session('flash_message') }}</p>
    </div>
  </div>
  @endif
  <div class="w-8/12 mx-auto mt-8 flex justify-between">
    <div>
      {{ Auth::user()->family_name }} {{ Auth::user()->last_name }} &nbsp;様の予約一覧
    </div>
    <div>
      {{ $accountreservations->links() }}
    </div>
  </div>
  @foreach($accountreservations as $accountreservation)
  <x-reservation :id="$accountreservation->id" :restaurantid="$accountreservation->restaurant_id" :datetime="$accountreservation->reservation_datetime" :count="$accountreservation->reservation_count" /> @endforeach
  <div class="flex justify-center mt-8">
    <x-button type="button" class="mb-4" onclick="location.href='{{ route('service.top')}}'">
      {{ __('戻る') }}
    </x-button>
  </div>
</x-app-layout>