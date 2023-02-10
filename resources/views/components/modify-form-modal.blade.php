<div class="modal fixed top-0 left-0  w-full h-full outline-none overflow-x-hidden overflow-y-auto backdrop-blur" id="formModalCenter" tabindex="-1" aria-labelledby="formModalCenterTitle" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered relative w-auto pointer-events-none">
    <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
      <div class="modal-header flex flex-shrink-0 items-center justify-center p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-medium leading-normal text-gray-800 mx-auto" id="formModalScrollableLabel">
          {{ $alert }}
        </h5>
        <button type="button" class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline" id="formModalCenter_close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      @if(strpos( $alert, '修正'))
      <form method="post" action="{{ route('reservation.edit') }}">
        @method('put') @endif @if(strpos( $alert, '削除'))
        <form method="post" action="{{ route('reservation.delete') }}">
          @method('delete') @endif @csrf
          <div class="modal-body relative p-4">
            <table class="mx-auto">
              <tr>
                <td>予約内容</td>
                <td class="pl-2">{{ str_replace('-','/',$reservationdate) }} {{ $reservationtime }}〜 {{ $restaurant }} {{ $reservationcount }}名様</td>
              </tr>
              <tr>
                <td>代表者</td>
                <td class="pl-2">{{ $representativefamilyname }} {{ $representativelastname }}</td>
              </tr>
              <tr>
                <td></td>
                <td class="pl-2">{{ $representativetel }}</td>
              </tr>
              <tr>
                <td></td>
                <td class="pl-2">{{ $representativemail }}</td>
              </tr>
            </table>
            <input name="id" value="{{ $id }}" type="hidden">
            <input name="reservation_date" value="{{ $reservationdate }}" type="hidden">
            <input name="reservation_time" value="{{ $reservationtime }}" type="hidden">
            <input name="reservation_restaurant" value="{{ $restaurant }}" type="hidden">
            <input name="reservation_count" value="{{ $reservationcount }}" type="hidden">
            <input name="representative_family_name" value="{{ $representativefamilyname }}" type="hidden">
            <input name="representative_last_name" value="{{ $representativelastname }}" type="hidden">
            <input name="representative_tel" value="{{ $representativetel }}" type="hidden">
            <input name="representative_mail" value="{{ $representativemail }}" type="hidden">
          </div>

          <div class="flex justify-center ">
            @if (strpos( $alert, '削除')) @method('DELETE') @endif
            <x-button class="mb-4 w-40 justify-center p-6">
              {{ __('はい') }}
            </x-button>
            <x-button class="ml-12 mb-4 w-40 justify-center p-6" type="button" id="formModalCenter_close_button">
              {{ __('いいえ') }}
            </x-button>
          </div>
        </form>


    </div>
  </div>
</div>