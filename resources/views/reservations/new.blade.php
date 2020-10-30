@php
$groups = $data['groups'];
$names = $data['names'];
@endphp
@extends('../layout/main')

@section('content')
{{-- <div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Wizard Layout</h2>
</div> --}}
<!-- BEGIN: Wizard Layout -->
<div id="general_info" class="intro-y box py-5 sm:py-10 mt-5 hidden">
    <div class="px-5 mt-1">
        <div class="font-medium text-center text-lg">Register New Reservartion</div>
        <div id="step-info" class="text-gray-600 text-center mt-2">To start off, please enter group/family name, email
            address and password.</div>
    </div>
    <form id="reservation_form" class="validate-form" enctype="multipart/form-data">
        <input type="hidden" id="reservation_id" name="reservation_id" value="" />
        <input type="hidden" id="og_start_date" name="og_start_date0" value="" />
        <input type="hidden" id="og_days" name="og_days" value="" />
        <input type="hidden" id="og_nights" name="og_nights" value="" />
        <div class="px-5 sm:px-20 mt-5 pt-10 border-t border-gray-200 dark:border-dark-5">
            <div class="font-medium text-base">General Details</div>
            <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="mb-2">Group/Family Name</div>
                    <input id="group_name" name="group_name" type="text" class="input w-full border flex-1"
                        placeholder="ie. John Doe Family" required>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="mb-2">Permit Holder</div>
                    <select id="permit_holder" name="permit_holder" class="input w-full border flex-1" required>
                        <option>-- Select a Driver --</option>
                        @foreach ($data['drivers'] as $driver)
                        @if (empty($driver->reservation_id))
                        <option value="{{$driver->id}}">{{$driver->first_name.' '.$driver->last_name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Start Date</div>
                    <div class="relative">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                            <i data-feather="calendar" class="w-4 h-4"></i> </div>
                        <input id="start_date" name="start_date" type="text"
                            class="datepicker input pl-12 w-full border flex-1" data-single-mode="true" required>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-2">
                    <div class="mb-2">Day(s)</div>
                    <input id="days" name="days" type="number" class="input w-24 border flex-1" placeholder="1 ..."
                        required>
                </div>
                <div class="intro-y col-span-12 sm:col-span-2">
                    <div class="mb-2">Night(s)</div>
                    <input id="nights" name="nights" type="number" class="input w-24 border flex-1" placeholder="1...."
                        value="0">
                </div>
                <div class="intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">End Date</div>
                    <div class="relative">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                            <i data-feather="calendar" class="w-4 h-4"></i> </div>
                        <input id="end_date" name="end_date" type="text"
                            class="input pl-12 w-full border flex-1 bg-gray-100 cursor-not-allowed"
                            data-single-mode="true" readonly>
                    </div>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="mb-2">Reservation Code</div>
                    <input id="code" name="code" type="text"
                        class="input w-full border flex-1 bg-gray-100 cursor-not-allowed" placeholder="" readonly>
                </div>
                <div class="intro-y col-span-12 sm:col-span-6">
                    <div class="mb-2">Booked By</div>
                    <select id="booked_by" name="booked_by"
                        class="input w-full border flex-1 bg-gray-100 cursor-not-allowed" readonly>
                        <option>-- Select a Driver --</option>
                        @foreach ($data['bookers'] as $booker)
                        <option value="{{$booker->id}}" {{$booker->id == Auth::user()->id ? 'selected' : ''}}>
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
<div id="visitor_info" class="intro-y box py-5 sm:py-10 mt-5">
    <div class="px-5 mt-1">
        <div class="font-medium text-center text-lg">Visitors Information</div>
        <div id="step-info" class="text-gray-600 text-center mt-2">To start off, please enter group/family name, email
            address and password.</div>
    </div>
    <div class="px-5 sm:px-20 mt-5 border-t border-gray-200 dark:border-dark-5">
        <div id="group_inputs" class="grid grid-cols-12 gap-4 row-gap-5 mt-5 hidden">
            <input type="hidden" id="reservation" name="reservation" value="2">
            <div class="intro-y col-span-12 sm:col-span-4">
                <div class="mb-2">Group Type</div>
                <select id="group_type" class="input w-full border flex-1">
                    <option value=""> -- Select Nationality of the Group -- </option>
                    <option value="2">Expatriate</option>
                    <option value="3">Non Resident</option>
                    <option value="1">East Africa Citizen</option>
                    <option value="4">Local Citizen</option>
                </select>
            </div>
            <div class="flex gap-4 intro-y col-span-12 sm:col-span-8">
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Adult(s)</div>
                    <input id="tot_adults" type="number" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Children</div>
                    <input id="tot_children" type="number" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Baby</div>
                    <input id="tot_babies" type="number" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-start mt-5">
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
                    <tbody>
                        @include('reservations.group-table-row')
                    </tbody>
                </table>
            </div>
            <div id="visitor_names" class="intro-y col-span-12 grid grid-cols-12 gap-6 mt-5 hidden">
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
                    <input id="fullname" name="fullname" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Full Name" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Gender</label>
                    <select id="gender" name="gender" class="input w-full border mt-2 flex-1" required>
                        <option>Select a region the park is located</option>
                        {{-- @foreach ($data['regions'] as $region)
                                        <option value="{{$region->id}}">{{$region->region}}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Country</label>
                    <select id="country" name="country" class="input w-full border mt-2 flex-1" required>
                        <option>Select a country he/she is from</option>
                        {{-- @foreach ($data['regions'] as $region)
                        <option value="{{$region->id}}">{{$region->region}}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Email</label>
                    <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                        placeholder="company@email.com" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Other Contact</label>
                    <input id="other_contact" name="other_contact" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="phone number etc. ....">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5"></div>
                <button type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-save-visitor" type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
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
        cash('#group_inputs').addClass('hidden')
        let type = cash('#group_type').val()
        let adults = cash('#tot_adults').val()
        let children = cash('#tot_children').val()
        let babies = cash('#tot_babies').val()

        if (type == '' || (adult == '0' && children == '0' && babies == '0')) {
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
        if (res.data.success == true) {
            cash('#group_type').val('')
            cash('#tot_adults').val('0')
            cash('#tot_children').va('0')
            cash('#tot_babies').val('0')
            cash('#table-group').html(res.data.updatedGroups);
        }else {
            console.log(res.data.message)
            let msgs = res.data.message
            msgs.forEach(element => cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
        }
            feather.replace();
        }).catch(err => {
            cash('#save_group').html('Save')
            console.log(err);
        })
    }

    const visitorForm = cash('#visitor_form')
    visitorForm.onsubmit = event =>{
        if(userForm.checkValidity()) {
            addUpdateVisitor()
        }else console.log("invalid form");
    }


    async function addUpdateVisitor() {
        let count = cash('#input-count').val();

        let visitorForm = cash('#visitor_form')[0];
        var formData = new FormData(visitorForm);
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
        let days = cash('#days').val()

        var start_date = new Date(cash('#start_date').val());
        //console.log(start_date);
        var end_date = new Date(start_date);
        //console.log(end_date);

        end_date.setDate(end_date.getDate() + parseInt(days));
        //console.log(end_date);

        cash('#end_date').val(end_date.toLocaleDateString())
        // let sd = Date.parse()
        // // let end_date = cash('#end_date').val()
        // let new_date = sd + 10;
        // console.log(new_date);
        // cash('#end_date').val(new Date())
        // if(start_date != '' && end_date != ''){
        //     let days = Date.parse(end_date) - Date.parse(start_date)
        //     console.log(days);
        //     cash('#days').val(days)
        // }
    })




</script>

@endsection
