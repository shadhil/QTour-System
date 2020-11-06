@php
$groups = $data['groups'];
$names = $data['names'];
$reservation = $data['reservation'];
$action = "new";
$startDate = '';
$endDate = '';
$permitHolder = '';
$bookedBy = Auth::user()->id;
$touringDays = '';
if (!empty($data['reservation'])) {
$action = "edit";
$permitHolder = $reservation->permit_holder ?? '0';
$sd = date_create($reservation->start_date);
$ed = date_create($reservation->end_date);
$touringDays=(date_diff($sd,$ed)->format("%a") + 1);
$startDate = date_format($sd,"m/d/Y");
$endDate = date_format($ed,"m/d/Y");
$bookedBy = $reservation->booked_by;
}
@endphp
@extends('../layout/main')

@section('content')
{{-- <div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Wizard Layout</h2>
</div> --}}
<!-- BEGIN: Wizard Layout -->
<div id="general_info" class="intro-y box py-5 sm:py-10 mt-5">
    <div class="px-5 mt-1">
        <div class="font-medium text-center text-lg">
            {{ $action == "new" ? 'Register New Reservartion' : 'Edit Reservartion' }}</div>
        <div id="step-info" class="text-gray-600 text-center mt-2">
            {{ $action == "new" ? 'To start off, please enter group/family name, pick a permit holder and start date and tottal days of the tour.' : 'You can only change group name and permit holder, dates can only be changed if no activity is added' }}
        </div>
    </div>
    <form id="reservation_form" class="validate-form" enctype="multipart/form-data">
        <input type="hidden" id="reservation_id" name="reservation_id" value="{{$reservation->id ?? ''}}" />
        <input type="hidden" id="og_start_date" name="og_start_date" value="{{$startDate}}" />
        <input type="hidden" id="og_end_date" name="og_end_date" value="{{$endDate}}" />
        <input type="hidden" id="og_days" name="og_days" value="{{$reservation->days ?? ''}}" />
        <input type="hidden" id="og_nights" name="og_nights" value="{{$reservation->nights ?? ''}}" />
        <div class="px-5 sm:px-20 mt-5 pt-10 border-t border-gray-200 dark:border-dark-5">
            <div class="font-medium text-base">General Details</div>
            <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6 input-form">
                    <div class="mb-2">Group/Family Name</div>
                    <input id="group_name" name="group_name" type="text" class="input w-full border flex-1"
                        value="{{$reservation->group_name ?? ''}}" placeholder="ie. John Doe Family" required>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 input-form">
                    <div class="mb-2">Permit Holder</div>
                    <select id="permit_holder" name="permit_holder" class="input w-full border flex-1" required>
                        <option>-- Select a Driver --</option>
                        @foreach ($data['drivers'] as $driver)
                        @if (empty($driver->reservation_id))
                        <option value="{{$driver->id}}" {{($permitHolder == $driver->id) ? 'selected' : ''}}>
                            {{$driver->first_name.' '.$driver->last_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="intro-y col-span-12 sm:col-span-4 input-form">
                    <div class="mb-2">Start Date</div>
                    <div class="relative">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                            <i data-feather="calendar" class="w-4 h-4"></i> </div>
                        <input id="start_date" name="start_date" type="text"
                            class="datepicker input pl-12 w-full border flex-1" data-single-mode="true"
                            value="{{ $startDate }}" required>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-2 input-form">
                    <div class="mb-2">Day(s)</div>
                    <input id="days" name="days" type="number" value="{{$touringDays}}" class="input w-24 border flex-1"
                        placeholder="1 ..." min="0" required>
                </div>
                <div class="intro-y col-span-12 sm:col-span-2">
                    <div class="mb-2">Night(s)</div>
                    <input id="nights" name="nights" type="number" value="{{$reservation->nights ?? '0'}}" min="0"
                        class="input w-24 border flex-1">
                </div>
                <div class="intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">End Date</div>
                    <div class="relative">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                            <i data-feather="calendar" class="w-4 h-4"></i> </div>
                        <input id="end_date" name="end_date" type="text"
                            class="input pl-12 w-full border flex-1 bg-gray-100 cursor-not-allowed"
                            data-single-mode="true" value="{{ $startDate }}" readonly>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="mb-2">Reservation Code</div>
                    <input id="code" name="code" type="text"
                        class="input w-full border flex-1 bg-gray-100 cursor-not-allowed" placeholder=""
                        value="{{$reservation->code ?? ''}}" readonly>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6 input-form">
                    <div class="mb-2">Booked By</div>
                    <select id="booked_by" name="booked_by"
                        class="input w-full border flex-1 bg-gray-100 cursor-not-allowed" readonly>
                        <option>-- Select a Driver --</option>
                        @foreach ($data['bookers'] as $booker)
                        <option value="{{$booker->id}}" {{$booker->id == $bookedBy ? 'selected' : ''}}>
                            {{$booker->first_name.' '.$booker->last_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                    <button id="btn-save-reservation"
                        class="button w-24 justify-center block bg-theme-1 text-white ml-2" type="submit">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div id="visitor_info" class="intro-y box py-5 sm:py-10 mt-5 {{ $action == 'new' ? 'hidden' : ''}}">
    <div class="px-5 mt-1">
        <div class="font-medium text-center text-lg">Visitors Information</div>
        <div id="step-info" class="text-gray-600 text-center mt-2">
            {{ $action == "new" ? 'Please enter type of visitors in the group, but their names are optional, for your own records.' : 'Now you can edit/add group visitor info including their name and country they come from.' }}
        </div>
    </div>
    <div class="px-5 sm:px-20 mt-5 border-t border-gray-200 dark:border-dark-5">
        <div id="group_inputs" class="grid grid-cols-12 gap-4 row-gap-5 mt-5 hidden">
            <input type="hidden" id="reservation" name="reservation" value="{{$reservation->id ?? ''}}">
            <div class="intro-y col-span-12 sm:col-span-4">
                <div class="mb-2">Group Type</div>
                <select id="group_type" class="input w-full border flex-1">
                    <option value=""> -- Select Nationality of the Group -- </option>
                    <option value="2">Expatriate</option>
                    <option value="3">Non Resident</option>
                    <option value="1">East Africa Citizen</option>
                </select>
            </div>
            <div class="flex gap-4 intro-y col-span-12 sm:col-span-8">
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Adult(s)</div>
                    <input id="tot_adults" type="number" min="0" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Children</div>
                    <input id="tot_children" type="number" min="0" class="input w-full border flex-1"
                        placeholder="eg. 2">
                </div>
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Baby</div>
                    <input id="tot_babies" type="number" min="0" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-start mt-5">
                <div id="show-group-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                </div>
                <button id="save_group" class="button w-24 justify-center block bg-theme-1 text-white ">Submit</button>
                <button id="hide_group_inputs"
                    class="button w-24 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300 ml-2">Close</button>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                <div class="font-medium text-base intro-y col-span-12 mt-5">Visitors
                    Group(s)</div>
                <div class="hidden md:block mx-auto text-gray-600"></div>
                <button id="add_group"
                    class="button w-24 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Add
                    Group</button>
            </div>
            <div class="intro-y col-span-12 overflow-x-auto lg:overflow-visible">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-700 dark:bg-dark-1 text-white">
                            <th class="whitespace-no-wrap">#</th>
                            <th class="text-center whitespace-no-wrap">Group Type</th>
                            <th class="text-center whitespace-no-wrap">Adults</th>
                            <th class="text-center whitespace-no-wrap">Children</th>
                            <th class="text-center whitespace-no-wrap">Babies</th>
                            <th class="text-center whitespace-no-wrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="group-rows">
                        @include('reservations.group-table-row')
                    </tbody>
                </table>
            </div>
            <div id="visitor_names" class="intro-y col-span-12 grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12">
                    <div class="grid grid-cols-12 gap-6 mt-3">
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                            <div class="font-medium text-base intro-y col-span-12 mt-5">Visitor
                                Name(s)</div>
                            <div class="hidden md:block mx-auto text-gray-600"></div>
                            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                                    <input id="input-search" type="text"
                                        class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search..."
                                        value="">
                                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"
                                        data-feather="search"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- BEGIN: Users Layout -->
                <div class="intro-y col-span-12">
                    <div id="visitor-names-table" class="grid grid-cols-12 gap-6">
                        @include('reservations.visitor-names')
                    </div>
                </div>
                <!-- BEGIN: Users Layout -->
            </div>
        </div>

        <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
            <button id="return_main"
                class="button w-20 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Return</button>
        </div>
    </div>
</div>
<!-- END: Wizard Layout -->

<div class="modal" id="add-visitor-name">
    <div class="modal__content modal__content--lg">
        <form id="visitor_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="visitor_id" name="visitor_id" value="" />
            <input type="hidden" id="reservation_id" name="reservation_id" value="" />
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto modal-title">Visitor Personal Info</h2>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12">
                    <label>Visitor's Name</label>
                    <input id="full_name" name="full_name" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Full Name" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Gender</label>
                    <select id="gender" name="gender" class="input w-full border mt-2 flex-1" required>
                        <option> -- Visitor's Gender -- </option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Country</label>
                    <select id="country" name="country" class="input w-full border mt-2 flex-1" required>
                        <option>Select a country he/she is from</option>
                        @foreach ($data['countries'] as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Email</label>
                    <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                        placeholder="eample@email.com">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Other Contact</label>
                    <input id="other_contact" name="other_contact" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="phone number etc. ....">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5 hidden">
                </div>
                <button id="btn-delete-visitor" type="button"
                    class="button w-20 bg-theme-6 text-white hidden">Delete</button>
                <button type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-save-visitor" type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="delete-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Are you sure?</div>
            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.
            </div>
            <input id="deleting-id" type="hidden">
            <input id="delete-type" type="hidden">
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
            <button id="btn-delete" type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
        </div>
    </div>
</div>
<!-- END: Delete Confirmation Modal -->
@endsection

@section('script')
<script>
    // cash('#end_date').daterangepicker({
    //     "startDate": "10/19/2020",
    //     "endDate": "10/25/2020"
    //     }, function(start, end, label) {
    //         console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    // });

    cash('#add_group').on('click', event => {
        console.log('clicked');
        if (cash('#group_inputs').hasClass('hidden')) {
            cash('#group_inputs').removeClass('hidden')
            cash('#add_group').addClass('hidden')
        }else{
            cash('#group_inputs').addClass('hidden')
        }
    })

    cash('#hide_group_inputs').on('click', event => {
        console.log('clicked');
        cash('#group_inputs').addClass('hidden')
        cash('#add_group').removeClass('hidden')
        cash('#group_type').val('')
        cash('#tot_adults').val('')
        cash('#tot_children').val('')
        cash('#tot_babies').val('')
    })

    cash('#save_group').on('click', event => {
        console.log('clicked');
        // cash('#group_inputs').addClass('hidden')
        let type = cash('#group_type').val()
        let adults = (cash('#tot_adults').val() == "") ? "0" : cash('#tot_adults').val()
        let children = (cash('#tot_children').val() == "") ? "0" : cash('#tot_children').val()
        let babies = (cash('#tot_babies').val() == "") ? "0" : cash('#tot_babies').val()

        if (type == '' || (adults == '0' && children == '0' && babies == '0')) {
            alert('Select Group and add total visitor count')
        }else{
            addUpdateGroup(type, adults, children, babies)
        }

    })

    async function addUpdateGroup(type, adults, children, babies) {
        let reservation = cash('#reservation').val()
        cash('#save_group').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.post("{{url('/reservations/add-group')}}", {
            visitor_type : type,
            adults: adults,
            children: children,
            babies: babies,
            reservation: reservation,
        }).then(res => {
        cash('#save_group').html('Save')
        console.log(res.data);
        if (res.data.success == true) {
            console.log('Is True?!');
            cash('#group_type').val('')
            cash('#tot_adults').val('0')
            cash('#tot_children').val('0')
            cash('#tot_babies').val('0')
            cash('#group-rows').html(res.data.updatedGroups);
        }else {
            console.log(res.data.message)
            let msgs = res.data.message
            msgs.forEach(element => cash('#show-group-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
        }
            feather.replace();
        }).catch(err => {
            cash('#save_group').html('Save')
            console.log(err);
        })
    }

    const visitorForm = cash('#visitor_form')[0]
    visitorForm.onsubmit = event =>{
        if(visitorForm.checkValidity()) {
            addUpdateVisitor()
        }else console.log("invalid form");
    }

    async function addUpdateVisitor() {
        let count = cash('#input-count').val();

        let visitorForm = cash('#visitor_form')[0];
        var formData = new FormData(visitorForm);
        formData.append('reservation', cash('#reservation').val());
        formData.append('count', count);

        cash('#btn-save-visitor').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/reservations/add-visitor')}}", formData, config).then(res => {
        cash('#btn-save-visitor').html('Send')
        if (res.data.success == true) {
            //showSuccessToast(res.data.message);
            cash('#add-visitor-name').modal('hide');
            cash('#input-search').val('');
            cash('#input-count').val(count);
            cash('#visitor_names').removeClass('hidden')
            cash('#visitor-names-table').html(res.data.updatedVisitors);
        }else {
            console.log(res.data.message)
            let msgs = res.data.message
            msgs.forEach(element =>
            cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
        }
        feather.replace();
        }).catch(err => {
            cash('#btn-save-visitor').html('Save')
            console.log(err);
        })
    }

    const reservationForm = cash('#reservation_form')[0]
    reservationForm.onsubmit = event =>{
        console.log("Submiting");
        if(reservationForm.checkValidity()) {
            addUpdateReservation()
        }else console.log("invalid form");
    }


    async function addUpdateReservation() {

        let visitorForm = cash('#reservation_form')[0];
        var formData = new FormData(visitorForm);

        cash('#btn-save-reservation').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{route('reservations.add')}}", formData, config).then(res => {
        cash('#btn-save-reservation').html('Save')
        if (res.data.success == true) {
            cash('#reservation_form')[0].reset();
            //showSuccessToast(res.data.message);
            cash('#reservation').val(res.data.reservationId);
            cash('#general_info').addClass('hidden');
            cash('#visitor_info').removeClass('hidden');
        }else {
            console.log(res.data.message)
            let msgs = res.data.message
            // msgs.forEach(element =>
            // cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
        }
        feather.replace();
        }).catch(err => {
            cash('#btn-save-reservation').html('Save')
            console.log(err);
        })
    }

    cash('#start_date-').on('change', event => {
        console.log('Changed');
        let start_date = cash('#start_date').val()
        let end_date = cash('#end_date').val()

        if(start_date != '' && end_date != ''){
            let days = Date.parse(end_date) - Date.parse(start_date)
            console.log(days);
            cash('#days').val(days)
        }
    })

    cash('#days').on('keyup change paste', event => {
        let days = cash('#days').val() - 1

        var start_date = new Date(cash('#start_date').val());
        //console.log(start_date);
        var end_date = new Date(start_date);
        //console.log(end_date);

        end_date.setDate(end_date.getDate() + parseInt(days));
        //console.log(end_date);

        cash('#end_date').val(end_date.toLocaleDateString())
        //cash('#nights').val(cash('#days').val())
        cash('#nights').attr({
            "max" : parseInt(cash('#days').val()) + 1,
            "min" : 0
        })
    })



    function onEditGroup(groupId) {
        //let groupId = event.target.dataset.groupId;
        console.log(groupId);
        editGroup(groupId)
        cash('#group_inputs').removeClass('hidden')
        cash('#add_group').addClass('hidden')
    }

    async function editGroup(groupId) {
        cash('#save_group').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.get("{{url('/reservations/edit-group')}}"+ '/' + groupId).then(res => {
        console.log(res.data.group[0].id);
        if (res.data.group[0].id > 0) {
            cash('#group_type').val(res.data.group[0].visitor_type_id)
            cash('#tot_adults').val(res.data.group[0].adults)
            cash('#tot_children').val(res.data.group[0].children)
            cash('#tot_babies').val(res.data.group[0].babies)
            cash('#save_group').html('Update')
        }else {
            console.log("Fail to LOAD!");
            cash('#save_group').html('Save')
            cash('#group_inputs').addClass('hidden')
            cash('#add_group').removeClass('hidden')
            cash('#group_type').val('')
            cash('#tot_adults').val('')
            cash('#tot_children').val('')
            cash('#tot_babies').val('')
        }
        feather.replace();
        }).catch(err => {
            cash('#save_group').html('Save')
            cash('#group_inputs').addClass('hidden')
            cash('#add_group').removeClass('hidden')
            cash('#group_type').val('')
            cash('#tot_adults').val('')
            cash('#tot_children').val('')
            cash('#tot_babies').val('')
            console.log(err);
        })
    }

    function onDeleteGroup(groupId) {
        cash('#delete-modal').modal('show');
        cash('#deleting-id').val(groupId);
        cash('#delete-type').val('group');
    }

    cash('#btn-delete').on('click', event => {
        let id = cash('#deleting-id').val();
        let type = cash('#delete-type').val();
        if (type == 'group') {
            deleteGroup(id)
        }else{
            deleteVisitor(id)
        }
        //cash('#deleting-id').val(groupId);
    })


    async function deleteGroup(groupId) {
        cash('#btn-delete').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.post("{{url('/reservations/delete-group')}}", {
            group_id : groupId,
            reservation_id : cash('#reservation').val(),
        }).then(res => {
        //console.log(res.data.group);
        //console.log(res.data.updatedGroups);
        if (res.data.group) {
            cash('#group-rows').html(res.data.updatedGroups);
            cash('#delete-modal').modal('hide');
        }else {
            console.log("Fail to LOAD!");
        }
        cash('#btn-delete').html('Delete')
        feather.replace();
        }).catch(err => {
            cash('#btn-delete').html('Delete')
            cash('#delete-modal').modal('hide');
            console.log(err);
        })
    }


    async function deleteVisitor(visitorId) {
        cash('#btn-delete').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.post("{{url('/reservations/delete-visitor')}}", {
            visitor_id : visitorId,
            reservation_id : cash('#reservation').val(),
        }).then(res => {
        console.log(res.data.visitor);
        //console.log(res.data.updatedGroups);
        if (res.data.visitor) {
            cash('#visitor-names-table').html(res.data.updatedVisitors);
            cash('#delete-modal').modal('hide');
            cash('#visitor_form')[0].reset()
            cash('#add-visitor-name').modal('hide');
        }else {
            console.log("Fail to LOAD!");
            cash('#delete-modal').modal('hide');
        }
        cash('#btn-delete').html('Delete')
        feather.replace();
        }).catch(err => {
            cash('#btn-delete').html('Delete')
            cash('#delete-modal').modal('hide');
            console.log(err);
        })
    }


    function onAddVisitor(groupId) {
        if (!cash('#btn-delete-visitor').hasClass('hidden')) {
            cash('#btn-delete-visitor').addClass('hidden')
        }
        cash('#visitor_id').val('')
        cash('#visitor_form')[0].reset();
        cash('#add-visitor-name').modal('show');
    }

    function onEditVisitor(visitorId) {
        editVisitor(visitorId)
    }

    async function editVisitor(visitorId) {
        cash('#add-visitor-name').modal('show');
        cash('#btn-save-visitor').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.get("{{url('/reservations/edit-visitor')}}"+ '/' + visitorId).then(res => {
        console.log(res.data.visitor[0]);
        if (res.data.visitor[0].id > 0) {
            cash('#visitor_id').val(res.data.visitor[0].id)
            cash('#full_name').val(res.data.visitor[0].full_name)
            cash('#gender').val(res.data.visitor[0].gender)
            cash('#country').val(res.data.visitor[0].country_id)
            cash('#email').val(res.data.visitor[0].email)
            cash('#other_contact').val(res.data.visitor[0].other_contact);
            cash('#btn-delete-visitor').removeClass('hidden')
        }else {
            cash('#add-visitor-name').modal('hide');
            console.log("Fail to LOAD!");
        }
        cash('#btn-save-visitor').html('Update')
        feather.replace();
        }).catch(err => {
            cash('#add-visitor-name').modal('hide');
            cash('#btn-save-visitor').html('Save')
            console.log(err);
        })
    }


    cash('#btn-delete-visitor').on('click', event => {
        cash('#delete-modal').modal('show');
        cash('#deleting-id').val(cash('#visitor_id').val());
        cash('#delete-type').val('visitor');
    })

    cash('#return_main').on('click', event => {
        location.href = "{{url()->previous()}}"
    })


</script>

@endsection
