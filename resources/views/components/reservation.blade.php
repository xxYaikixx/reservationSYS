<form action="{{ route('reservation.modifyForm') }}" method="get">
  @csrf
  <button class="container mt-8 bg-white h-28 flex text-xl border w-8/12 mx-auto drop-shadow-xl">
    <div class="container bg-gray-600 w-20 h-28"></div>
    <p class="ml-4 mt-8">{{ DB::table('restaurants')->where('id', $restaurantid)->value('restaurant_name') }}</p>
    <p class="ml-4 mt-8">{{ substr(str_replace('-','/',$datetime),0,-3) }}〜
    </p>
    <p class="ml-4 mt-8">{{$count}}名様</p>
    <input type="hidden" id="id" name="id" value="{{ $id }}" />
    <input type="hidden" id="date" name="date" value="{{ substr($datetime,0,10) }}" />
    <input type="hidden" id="time" name="time" value="{{ substr($datetime,11,8) }}" />
    <input type="hidden" id="counts" name="counts" value="{{ $count }}" />
    <input type="hidden" id="restaurant_name" name="restaurant_name" value="{{ DB::table('restaurants')->where('id', $restaurantid)->value('restaurant_name') }}" />
  </button>
</form>