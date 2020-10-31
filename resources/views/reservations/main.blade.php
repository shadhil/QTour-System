@php
$reservations = $data['reservations'];
@endphp
@extends('../layout/main')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <button id="new_reservation" class="button text-white bg-theme-1 shadow-md mr-2">New Reservation</button>
        <div class="hidden md:block mx-auto text-gray-600"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN: Data List -->
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-no-wrap">GROUP NAME</th>
                    <th class="text-center whitespace-no-wrap">VISITORS</th>
                    <th class="text-center whitespace-no-wrap">TOUR DATES</th>
                    <th class="whitespace-no-wrap">PERMIT HOLDER</th>
                    <th class="text-center whitespace-no-wrap">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="table-rows">
                @include('reservations.main-table')
            </tbody>
        </table>
    </div>
</div>
<div id="table-pagination" class="grid grid-cols-12 gap-6">
    @include('reservations.main-table-pagination')
</div>

<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="delete-confirmation-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Are you sure?</div>
            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.
            </div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
@endsection

@section('script')
<script>
    cash('#new_reservation').on('click', event => {
        location.href = "{{ route('reservations.new')}}"
    })
</script>

@endsection
