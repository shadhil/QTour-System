@if (sizeof($roomCategories) > 0)
@foreach ($roomCategories as $room_category)
<div class="intro-x">
    <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
        <div class="w-full ml-10 mr-4" data-id={{ $room_category->id }}
            data-category="{{ $room_category->room_category }}"
            onclick="editRoomCategory(cash(this).attr('data-id'),cash(this).attr('data-category'))">
            <div class="font-bold text-center capitalize">{{ $room_category->room_category }}
            </div>
        </div>
        <div class=" flex" data-id={{ $room_category->id }} data-category="{{ $room_category->room_category }}"
            onclick="deleteRoomCategory(cash(this).attr('data-id'),cash(this).attr('data-category'))">
            <i data-feather="trash" class="w-4 h-4 text-gray-200"></i>
        </div>
    </div>
</div>
@endforeach
@else
{{--  --}}
@endif
