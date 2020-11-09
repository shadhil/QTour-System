<!-- BEGIN: parks Layout -->
@foreach ($parks as $park)
<div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in view__profile">
    <div class="flex">
        <div class="mr-1" data-park-id={{ $park->id }} data-park-name="{{ $park->park_name }}"
            onclick="viewParkActivities(cash(this).attr('data-park-id'),cash(this).attr('data-park-name'))">
            <div class="font-medium text-base truncate">{{ $park->park_name }}</div>
            <div class="text-gray-600">{{ $park->region }}</div>
        </div>
        <div class="ml-auto" data-park-id={{ $park->id }} data-park-name="{{ $park->park_name }}"
            data-park-region={{ $park->region_id }}
            onclick="parkEdit(cash(this).attr('data-park-id'),cash(this).attr('data-park-name'),this.getAttribute('data-park-region'))">
            <i data-feather="edit" class="w-4 h-4 text-gray-600 ml-2 text-theme-1"></i></div>
    </div>
</div>
@endforeach
{{-- {{ $parks->links('vendor.pagination.tailwind') }} --}}
<!-- END: parks Layout -->
