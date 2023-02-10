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
  <div class="py-12 flex justify-center">
    <div class="w-1/2 px-16">
      <form method="GET" action="{{ route('service.search') }}">
        @csrf
        <x-button class="container mx-auto overflow-hidden shadow-sm sm:rounded-lg sm:px-6 lg:px-8 bg-gray-600">
          <p class="mx-auto pt-96 pb-96 text-lg">予約する</p>
        </x-button>
      </form>
    </div>
    <div class="w-1/2 px-16">
      <form method="GET" action="{{ route('service.view') }}">
        <x-button class="container mx-auto overflow-hidden shadow-sm sm:rounded-lg sm:px-6 lg:px-8 bg-gray-600">
          <p class="mx-auto pt-96 pb-96 text-lg">予約管理</p>
        </x-button>
      </form>
    </div>
  </div>
</x-app-layout>