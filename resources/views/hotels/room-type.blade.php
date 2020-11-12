@if (sizeof($roomTypes) > 0)
@foreach ($roomTypes as $room_type)
<div class="intro-x">
    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
        <div class="w-full ml-10 mr-4" data-id={{ $room_type->id }} data-type="{{ $room_type->room_type }}"
            onclick="editRoomType(cash(this).attr('data-id'),cash(this).attr('data-type'))">
            <div class="font-bold text-center capitalize">{{ $room_type->room_type }}
            </div>
        </div>
        <div class=" flex" data-id={{ $room_type->id }} data-type="{{ $room_type->room_type }}"
            onclick="deleteRoomType(cash(this).attr('data-id'),cash(this).attr('data-type'))">
            <i data-feather="trash" class="w-4 h-4 text-gray-200"></i>
        </div>
    </div>
</div>
@endforeach
@else
{{--  --}}
@endif
