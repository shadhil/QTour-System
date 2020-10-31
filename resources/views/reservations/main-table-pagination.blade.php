@if (sizeof($reservations) > 0)
{{ $reservations->links('vendor.pagination.tailwind') }}
@endif
