<!-- BEGIN: parks Layout -->
@foreach ($parks as $park)
<div class="col-span-12 sm:col-span-4 xxl:col-span-3 box p-5 cursor-pointer zoom-in">
    <div class="font-medium text-base">{{ $park->park_name }}</div>
    <div class="text-gray-600">{{ $park->region }}</div>
</div>
@endforeach
{{ $parks->links('vendor.pagination.tailwind') }}
<!-- END: parks Layout -->
