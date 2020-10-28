<!-- BEGIN: parks Layout -->
@foreach ($parks as $park)
<div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in view__profile"
    data-park-id={{ $park->id }} data-park-name="{{ $park->park_name }}" data-park-region={{ $park->region_id }}
    ondblclick="parkEdit(cash(this).attr('data-park-id'),cash(this).attr('data-park-name'),this.getAttribute('data-park-region'))">
    <div class="font-medium text-base truncate">{{ $park->park_name }}</div>
    <div class="text-gray-600">{{ $park->region }}</div>
</div>
@endforeach
{{-- {{ $parks->links('vendor.pagination.tailwind') }} --}}
<!-- END: parks Layout -->
