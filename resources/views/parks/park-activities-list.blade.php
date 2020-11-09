@if (sizeof($parkActivities) > 0)
<!-- BEGIN: parks Layout -->
@php
$activityCatIds=array();
@endphp
@foreach ($parkActivities as $parkActivity)
@php
$activityPrice = '';
$categoryId = $parkActivity->category_id;
@endphp
@if (!in_array($categoryId, $activityCatIds))
<a href="javascript:;"
    class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md"
    data-activity-id={{ $parkActivity->id }} onclick="editParkActivity(cash(this).attr('data-activity-id'))">
    <div class="pos__ticket__item-name truncate mr-1">{{ $parkActivity->activity .' - '. $parkActivity->category}}
        <div class="ml-auto">
            @foreach ($parkActivities as $tempActivity)
            <span class="text-xs italic space-x-12 text-gray-600 mr-3">
                {{ '@'.$tempActivity->price_usd.'USD ' }}
            </span>
            @endforeach
        </div>
    </div>
</a>
@php
$activityCatIds[] = $categoryId;
@endphp
@endif
@endforeach
<!-- END: parks Layout -->
@endif
