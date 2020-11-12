@if (sizeof($activities) > 0)
@foreach ($activities as $activity)
<a href="javascript:;"
    class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
    <div class="pos__ticket__item-name truncate mr-1" data-activity-id={{$activity->id}}
        data-activity="{{$activity->activity}}"
        onclick="viewCategories(cash(this).attr('data-activity-id'),cash(this).attr('data-activity'))">
        {{ $activity->activity }}</div>
    <div class=" ml-auto" data-activity-id={{$activity->id}} data-activity="{{$activity->activity}}""
        onclick=" updateActivity(cash(this).attr('data-activity-id'),cash(this).attr('data-activity'))"><i
            data-feather="edit" class="w-4 h-4 text-gray-200 ml-2"></i></div>
    <div class=" ml-3" data-activity-id={{$activity->id}}
        ondblclick="removeActivity(cash(this).attr('data-activity-id'))"><i data-feather="trash"
            class="w-4 h-4 text-gray-200 ml-2"></i></div>
</a>
@endforeach
@else
{{--  --}}
@endif
