@if (sizeof($dayParks) > 0)
@foreach ($dayParks as $dayPark)
<div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in day-activity"
    data-day="{{$dayPark->day}}" data-park-id="{{$dayPark->park_id}}"
    onclick="onDayActivity(this.getAttribute('data-day'),this.getAttribute('data-park-id'))">
    <div class="font-medium text-base">{{'Day - '.$dayPark->day}}</div>
    <div class="text-gray-600">{{$dayPark->park_name}}</div>
</div>
@endforeach
@endif
<div class="col-span-12 sm:col-span-3 xxl:col-span-2 box bg-theme-1 dark:bg-theme-1 p-5 cursor-pointer zoom-in day-activity"
    data-day="0" data-park-id="0"
    onclick="onDayActivity(this.getAttribute('data-day'),this.getAttribute('data-park-id'))">
    <div class="font-medium text-base text-white">New Activity</div>
    <div class="text-theme-25 dark:text-gray-400">Start Select Day &amp; Park</div>
</div>
