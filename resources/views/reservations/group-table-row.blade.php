@if (sizeof($groups) > 0)
@foreach ($groups as $group)
<tr>
    <td class="border-b dark:border-dark-5">{{ $group->id}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->type}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->adults}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->children}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->babies}}</td>
    <td class="border-b dark:border-dark-5">
        <div class="flex justify-center items-center">
            <a class="flex items-center mr-5 text-theme-1 tooltip" title="Add Visitor" href="javascript:;"
                data-toggle="modal" data-target="#add-visitor-name" data-group-id={{$group->id}}>
                <i data-feather="user-plus" class="w-4 h-4 mr-1"></i> Names
            </a>
            <a class="flex items-center mr-5 tooltip" title="Edit" href="javascript:;" data-group-id={{$group->id}}> <i
                    data-feather="check-square" class="w-4 h-4 mr-1"></i>
            </a>
            <a class="flex items-center text-theme-6 tooltip" title="Delete" href="javascript:;" data-toggle="modal"
                data-target="#delete-confirmation-modal" data-group-id={{$group->id}}> <i data-feather="trash-2"
                    class="w-4 h-4 mr-1"></i></a>
        </div>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6">
        <div class="text-center text-gray-600 font-medium">NO GROUPS FOUND</div>
    </td>
</tr>
@endif
