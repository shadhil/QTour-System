@foreach ($hotels as $hotel)
<a href="javascript:;" class="intro-y block col-span-12 sm:col-span-3 xxl:col-span-3 view__profile"
    data-hotel-id="{{$hotel->id}}" onclick="hotelClick(cash(this).attr('data-hotel-id'))">
    <div class="box rounded-md p-3 relative zoom-in">
        <div class="flex-none pos-image relative block">
            <div class="pos-image__preview image-fit">
                <img alt="Hotel Photo"
                    src="{{asset(empty($hotel->photo) ? 'dist/images/food-beverage-11.jpg' : $hotel->photo)}}">
            </div>
        </div>
        <div class="block font-medium text-center truncate mt-3">{{ $hotel->name }}</div>
    </div>
</a>
@endforeach
{{ $hotels->links('vendor.pagination.tailwind') }}
