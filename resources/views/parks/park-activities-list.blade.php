@if (sizeof($parkActivities) > 0)
<!-- BEGIN: parks Layout -->
@php
$activityCatIds=array();
@endphp
@foreach ($parkActivities as $parkActivity)
@php
$categoryId = $parkActivity->category_id;
@endphp
@if (!in_array($categoryId, $activityCatIds))
<a href="javascript:;"
    class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md"
    data-park-id={{ $parkActivity->park_id }} data-category-id={{ $parkActivity->category_id }}
    onclick="editParkActivity(cash(this).attr('data-park-id'),cash(this).attr('data-category-id'))">
    <div class="pos__ticket__item-name truncate mr-1">{{ $parkActivity->activity .' - '. $parkActivity->category}}
        <div class="ml-auto">
            @foreach ($parkActivities as $tempActivity)
            @if ($parkActivity->category_id == $tempActivity->category_id)
            <span class="text-xs italic space-x-12 text-gray-600 mr-3">
                {{ '@'.$tempActivity->price_usd.'USD ' }}
            </span>
            @endif
            @endforeach
        </div>
    </div>
</a>
@php
$activityCatIds[] = $categoryId;
@endphp
@endif
@endforeach
@else
{{-- <a href="javascript:;"
    class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
    <div class="pos__ticket__item-name truncate mr-1">
        NO ACTIVITY IS ASSIGNED TO THIS PARK!!
    </div>
</a> --}}
@endif
