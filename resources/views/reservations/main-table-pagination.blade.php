@if (sizeof($reservations) > 0)
{{ $reservations->links('vendor.pagination.tailwind') }}
@endif

@if (sizeof($rsrvActivities) > 0)
{{ $rsrvActivities->links('vendor.pagination.tailwind') }}
@endif
