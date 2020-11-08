@if (sizeof($rsrvActivities) > 0)
@php
$dayCatList=array();
@endphp
@foreach ($rsrvActivities as $rsrvActivity)
@php
$dayCat = $rsrvActivity->day.'-'.$rsrvActivity->park_id.'-'.$rsrvActivity->category_id;
$categoryId = $rsrvActivity->category_id;
$tourDay = $rsrvActivity->day;
$parkId = $rsrvActivity->park_id;
$totalPrice = 0.00;
//array_push($categories, '');
@endphp
@if (!in_array($dayCat, $dayCatList))
<tr class="intro-x">
    <td class="text-center">{{ $rsrvActivity->day }}</td>
    <td>
        <a href=""
            class="font-medium whitespace-no-wrap">{{ $rsrvActivity->activity .' - '. $rsrvActivity->category}}</a>
        <div class="text-gray-600 text-xs whitespace-no-wrap">
            {{ $rsrvActivity->park_name }}
        </div>
    </td>
    <td class="text-center">
        @foreach ($rsrvActivities as $tempActivity)
        @if ($tempActivity->day == $tourDay && $tempActivity->park_id == $parkId && $tempActivity->category_id ==
        $categoryId)
        <a href="javascript:;"
            class="font-medium whitespace-no-wrap">{{$tempActivity->pax.' - '. $tempActivity->type.' (@'.$tempActivity->price.' '.$tempActivity->currency.')' }}</a>
        @php
        $totalPrice = (float)$totalPrice + (float)$tempActivity->total_price;
        @endphp
        @endif
        @endforeach
    </td>
    <td class="text-center">{{ $totalPrice.' '.$rsrvActivity->currency }}</td>
    <td class="text-center">{{ ($totalPrice * 0.18).' '.$rsrvActivity->currency }}</td>
    <td class="table-report__action w-56">
        <div class="flex justify-center items-center">
            <a class="flex items-center mr-3" href="javascript:;" data-day={{$tourDay}}
                data-activity-id={{$rsrvActivity->activity_id}} data-category-id={{$categoryId}}
                data-park-id={{$parkId}}
                onclick="onActivityEdit(this.getAttribute('data-day'), this.getAttribute('data-park-id'), this.getAttribute('data-activity-id'), this.getAttribute('data-category-id'))">
                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
            </a>
            <a class="flex items-center text-theme-6" href="javascript:;" data-day={{$tourDay}}
                data-category-id={{$categoryId}} data-park-id={{$parkId}}
                onclick="onActivityDelete(this.getAttribute('data-day'),this.getAttribute('data-park-id'),this.getAttribute('data-category-id'))">
                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
            </a>
        </div>
    </td>
</tr>

@php
//array_push($dayCatList, $dayCat);
$dayCatList[] = $dayCat;
//print_r($dayCatList);
@endphp
@endif
@endforeach

@else
<tr>
    <td colspan="6">
        <div class="text-center text-gray-600 font-medium">NO ACTIVITY FOUND</div>
    </td>
</tr>
@endif
