@if (sizeof($reservations) > 0)
@foreach ($reservations as $reservation)
@php
$a = empty($reservation->adults) ? 0 : (int)$reservation->adults;
$b = empty($reservation->babies) ? 0 : (int)$reservation->babies;
$c = empty($reservation->children) ? 0 : (int)$reservation->children;
$sd = date_create($reservation->start_date);
$ed = date_create($reservation->end_date);
@endphp
<tr class="intro-x border border-gray-500 zoom-in">
    <td>
        <a href="" class="font-medium whitespace-no-wrap truncate">{{ $reservation->group_name }}</a>
        <div class="text-gray-600 text-xs whitespace-no-wrap">
            {{ $reservation->code }}
        </div>
    </td>
    <td class="text-center">{{ ($a + $b + $c) }}</td>
    <td class="text-center">{{date_format($sd,"m/d/Y").' - '.date_format($ed,"m/d/Y")}}</td>
    <td>
        <a href="" class="font-normal whitespace-no-wrap">{{ $reservation->cr_fname.' '.$reservation->cr_lname }}</a>
    </td>
    <td class="table-report__action w-56">
        <div class="flex justify-center items-center">
            <a class="flex items-center mr-3 text-theme-1"
                href="{{ route('reservations.activities', $reservation->code)}}">
                <i data-feather="activity" class="w-4 h-4 mr-1"></i> Activities
            </a>
            <a class="flex items-center mr-3" href="{{ route('reservations.edit', $reservation->code)}}">
                <i data-feather="edit" class="w-4 h-4 mr-1"></i>
            </a>
            <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal"
                data-target="#delete-confirmation-modal" data-rsrv-id={{$reservation->id}}>
                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i>
            </a>
        </div>
    </td>
</tr>
@endforeach
@else
<div class="intro-y col-span-12">
    <div class="w-full">
        <div class="text-center text-gray-600 font-medium p-4">NO VISITORS' NAMES FOUND</div>
    </div>
</div>
@endif
