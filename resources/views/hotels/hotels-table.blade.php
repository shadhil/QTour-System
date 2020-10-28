@foreach ($hotels as $hotel)
<a href="javascript:;" data-toggle="modal" data-target="#add-item-modal"
    class="intro-y block col-span-12 sm:col-span-3 xxl:col-span-3">
    <div class="box rounded-md p-3 relative zoom-in">
        <div class="flex-none pos-image relative block">
            <div class="pos-image__preview image-fit">
                <img alt="Midone Tailwind HTML Admin Template"
                    src="{{asset(empty($hotel->photo) ? 'dist/images/food-beverage-11.jpg' : $hotel->photo)}}">
            </div>
        </div>
        <div class="block font-medium text-center truncate mt-3">{{ $hotel->name }}</div>
    </div>
</a>
@endforeach
{{ $hotels->links('vendor.pagination.tailwind') }}
