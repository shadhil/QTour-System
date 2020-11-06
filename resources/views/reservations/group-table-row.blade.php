@if (sizeof($groups) > 0)
@php
$id = 1;
@endphp
@foreach ($groups as $group)
<tr>
    <td class="border-b dark:border-dark-5">{{ $id}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->type}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->adults}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->children}}</td>
    <td class="text-center border-b dark:border-dark-5">{{ $group->babies}}</td>
    <td class="border-b dark:border-dark-5">
        <div class="flex justify-center items-center">
            <a class="flex items-center mr-5 text-theme-1 tooltip" title="Add Visitor" href="javascript:;"
                data-group-id={{$group->id}} onclick="onAddVisitor(this.getAttribute('data-group-id'))">
                <i data-feather="user-plus" class="w-4 h-4 mr-1"></i> Names
            </a>
            <a class="flex items-center mr-5 tooltip edit-group" title="Edit" href="javascript:;"
                data-group-id={{$group->id}} onclick="onEditGroup(this.getAttribute('data-group-id'))"> <i
                    data-feather="edit" class="w-4 h-4 mr-1"></i>
            </a>
            <a class="flex items-center text-theme-6 tooltip delete-group" title="Delete" href="javascript:;"
                data-group-id={{$group->id}} onclick="onDeleteGroup(this.getAttribute('data-group-id'))"> <i
                    data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
        </div>
    </td>
</tr>
@php
$id++;
@endphp
@endforeach
@else
<tr>
    <td colspan="6">
        <div class="text-center text-gray-600 font-medium">NO GROUPS FOUND</div>
    </td>
</tr>
@endif
