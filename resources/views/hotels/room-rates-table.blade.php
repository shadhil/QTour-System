@if (sizeof($hotelRates) > 0)
@php
$hotelCatList=array();
$mealTypeList=array();
@endphp
@foreach ($hotelRates as $hotelRate)
@php
$categoryId = $hotelRate->room_category_id;
@endphp
@if (!in_array($categoryId, $hotelCatList))
<tr class="w-full bg-theme-1">
    <th class="w-full text-center text-white font-medium whitespace-no-wrap" colspan="5">
        {{ $hotelRate->room_category }}
    </th>
</tr>
@foreach ($hotelRates as $tempRates)
@if ($tempRates->room_category_id == $categoryId)
@php
$typeId = $tempRates->room_type_id;
$mealId = $tempRates->meal_plan_id;
$mealTypeIds = $typeId.'-'.$mealId;
$hs_sto = $hs_rack = $ms_sto = $ms_rack = $ls_sto = $ls_rack = $hs_id = $ms_id = $ls_id = '';
@endphp
@if (!in_array($mealTypeIds, $mealTypeList))
<tr class="intro-x">
    <td>
        <span href="" class="font-medium whitespace-no-wrap">{{ $tempRates->room_type }}</span>
        <div class="text-gray-600 text-xs whitespace-no-wrap">
            {{ $tempRates->meal_plan }}</div>
    </td>
    <td class="w-56">
        @foreach ($hotelRates as $seasonRates)
        @if ($seasonRates->room_category_id == $categoryId && $seasonRates->room_type_id = $typeId &&
        $seasonRates->meal_plan_id == $mealId)
        <div class="flex items-center justify-center">
            {{ $seasonRates->season }}
        </div>
        @endif
        @endforeach
    </td>
    <td class="text-center">
        @foreach ($hotelRates as $seasonRates)
        @if ($seasonRates->room_category_id == $categoryId && $seasonRates->room_type_id = $typeId &&
        $seasonRates->meal_plan_id == $mealId)
        <div class="flex items-center justify-center">
            {{ $seasonRates->sto_rate.' USD' }}
        </div>
        @php
        if($seasonRates->season_id == '1'){
        $hs_sto = $seasonRates->sto_rate;
        }elseif ($seasonRates->season_id == '2') {
        $ms_sto = $seasonRates->sto_rate;
        }elseif ($seasonRates->season_id == '3') {
        $ls_sto = $seasonRates->sto_rate;
        }
        @endphp
        @endif
        @endforeach
    </td>
    <td class="text-center">
        @foreach ($hotelRates as $seasonRates)
        @if ($seasonRates->room_category_id == $categoryId && $seasonRates->room_type_id = $typeId &&
        $seasonRates->meal_plan_id == $mealId)
        <div class="flex items-center justify-center">
            {{ $seasonRates->rack_rate == '' ? ' - - - ' : '$'.$seasonRates->rack_rate }}
        </div>
        @php
        if($seasonRates->season_id == '1'){
        $hs_rack = $seasonRates->rack_rate;
        $hs_id = $seasonRates->id;
        }elseif ($seasonRates->season_id == '2') {
        $ms_rack = $seasonRates->rack_rate;
        $ms_id = $seasonRates->id;
        }elseif ($seasonRates->season_id == '3') {
        $ls_rack = $seasonRates->rack_rate;
        $ls_id = $seasonRates->id;
        }
        @endphp
        @endif
        @endforeach
    </td>

    <td class="table-report__action w-40">
        <div class="flex justify-center items-center">
            <a class="flex items-center mr-3 text-theme-1" href="javascript:;" data-category-id={{ $categoryId }}
                data-type-id={{ $typeId }} data-meal-id={{ $mealId }} data-hsto={{ $hs_sto }} data-hrack="{{$hs_rack}}"
                data-msto="{{$ms_sto}}" data-mrack="{{$ms_rack}}" data-lsto="{{$ls_sto}}" data-lrack="{{$ls_rack}}"
                data-ms-id="{{$ms_id}}" data-ls-id="{{$ls_id}}" data-hs-id="{{$hs_id}}"
                onclick="editRates(cash(this).attr('data-category-id'), cash(this).attr('data-type-id'), cash(this).attr('data-meal-id'), cash(this).attr('data-hsto'), cash(this).attr('data-hrack'), cash(this).attr('data-msto'), cash(this).attr('data-mrack'), cash(this).attr('data-lsto'), cash(this).attr('data-lrack') , cash(this).attr('data-hs-id'), cash(this).attr('data-ms-id'), cash(this).attr('data-ls-id'))">
                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
            </a>
            {{-- <a class="flex items-center text-theme-6" href="javascript:;"
                data-category-id={{ $tempRates->room_category_id }} data-type-id={{ $tempRates->room_type_id }}
            data-meal-id={{ $tempRates->meal_plan_id }}
            onclick="deleteRates(cash(this).attr('data-category-id'), cash(this).attr('data-type-id'),
            cash(this).attr('data-meal-id'))"
            data-toggle="modal" data-target="#delete-confirmation-modal">
            <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
            </a> --}}
        </div>
    </td>
</tr>
@php
$mealTypeList[] = $mealTypeIds;
@endphp
@endif
@endif
@endforeach
@php
$hotelCatList[] = $categoryId;
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
