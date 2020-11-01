@if (sizeof($rsrvActivities) > 0)
@foreach ($rsrvActivities as $rsrvActivity)
<tr class="intro-x">
    <td class="text-center">{{ '2' }}</td>
    <td>
        <a href="" class="font-medium whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>
        <div class="text-gray-600 text-xs whitespace-no-wrap">
            {{ $faker['products'][0]['category'] }}
        </div>
    </td>
    <td class="text-center">
        <a href="" class="font-medium whitespace-no-wrap">8 - East Africans (@125 USD)</a>
        <a href="" class="font-medium whitespace-no-wrap"></a>
        <a href="" class="font-medium whitespace-no-wrap"></a>
    </td>
    <td class="text-center">50000 TZS</td>
    <td class="text-center">2675 TZS</td>
    <td class="table-report__action w-56">
        <div class="flex justify-center items-center">
            <a class="flex items-center mr-3" href="javascript:;">
                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
            </a>
            <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
                data-target="#delete-confirmation-modal">
                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
            </a>
        </div>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="6">
        <div class="text-center text-gray-600 font-medium">NO ACTIVITY FOUND</div>
    </td>
</tr>
@endif
