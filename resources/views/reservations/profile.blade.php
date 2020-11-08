@php
$reservations = [];
$reservation = $data['reservation'];
$dayParks = $data['day_parks'];
$rsrvActivities = $data['rsrv_activities'];
$visitorTypes = array();
foreach ($data['visitor_types'] as $type) {
$visitorTypes[] = $type;
}
// if(is_array($data['visitor_types'])){
// $visitorTypes = $data['visitor_types'];
// }
$a = empty($reservation->tot_adults) ? 0 : (int)$reservation->tot_adults;
$b = empty($reservation->tot_babies) ? 0 : (int)$reservation->tot_babies;
$c = empty($reservation->tot_children) ? 0 : (int)$reservation->tot_children;
$sd = date_create($reservation->start_date);
$ed = date_create($reservation->end_date);
$touringDays=(date_diff($sd,$ed)->format("%a") + 1);

@endphp
@extends('../layout/main')

@section('content')
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
        <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
            <div class="ml-5">
                <div class="w-64 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                    {{ $reservation->group_name }}</div>
                <div class="text-gray-600">{{'#'. $reservation->code }}</div>
            </div>
        </div>
        <div
            class="flex mt-6 lg:mt-0 items-center lg:items-start flex-1 flex-col justify-center text-gray-600 dark:text-gray-300 px-5 border-l border-r border-gray-200 dark:border-dark-5 border-t lg:border-t-0 pt-5 lg:pt-0">
            <div class="truncate sm:whitespace-normal flex items-center">
                <i data-feather="truck" class="w-4 h-4 mr-2 tooltip" title="Driver/Permit Holder"></i>
                {{ $reservation->cr_fname.' '.$reservation->cr_lname }}
            </div>
            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                <i data-feather="briefcase" class="w-4 h-4 mr-2 tooltip" title="Booked By"></i>
                {{ $reservation->u_fname.' '.$reservation->u_lname }}
            </div>
            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                <i data-feather="calendar" class="w-4 h-4 mr-2 tooltip" title="Tour Dates"></i>
                {{date_format($sd,"m/d/Y").' - '.date_format($ed,"m/d/Y")}}
            </div>
        </div>
        <div
            class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">{{ $touringDays }}</div>
                <div class="text-gray-600">Day(s)</div>
            </div>
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">{{ $reservation->nights }}</div>
                <div class="text-gray-600">Night(s)</div>
            </div>
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">{{ ($a + $b + $c) }}</div>
                <div class="text-gray-600">Visitor(s)</div>
            </div>
        </div>
    </div>
    <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start">
        <a data-toggle="tab" data-target="#activities" href="javascript:;"
            class="py-4 sm:mr-8 flex items-center active">
            <i class="w-4 h-4 mr-2" data-feather="user"></i> Activities
        </a>
        <a data-toggle="tab" data-target="#accomodations" href="javascript:;" class="py-4 sm:mr-8 flex items-center">
            <i class="w-4 h-4 mr-2" data-feather="shield"></i> Accomodations
        </a>
    </div>
</div>
<!-- BEGIN: HTML Tab Content Data -->
<div class="tab-content mt-5">
    <div class="tab-content__pane active" id="activities">
        <div id="day_park_links" class="grid grid-cols-12 gap-5 mt-5">
            @include('reservations.day-park')
        </div>
        <div class="grid grid-cols-12 gap-3 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                <div class="w-64 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">List of
                    Activities
                </div>
                <div class="hidden md:block mx-auto text-gray-600"></div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="text-center whitespace-no-wrap">DAY</th>
                            <th class="whitespace-no-wrap">ACTIVITY</th>
                            <th class="text-center whitespace-no-wrap">PAX</th>
                            <th class="text-center whitespace-no-wrap">TOTAL PRICE</th>
                            <th class="text-center whitespace-no-wrap"> VAT </th>
                            <th class="text-center whitespace-no-wrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody id="activity-rows">
                        @include('reservations.activity-table')
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div id="table-pagination" class="grid grid-cols-12 gap-6">
                @include('reservations.main-table-pagination')
            </div>
            <!-- END: Pagination -->
        </div>
    </div>
    <div class="tab-content__pane" id="accomodations">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                <button class="button text-white bg-theme-1 shadow-md mr-2">Add New Hotel</button>
                <div class="dropdown">
                    <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                        <span class="w-5 h-5 flex items-center justify-center">
                            <i class="w-4 h-4" data-feather="plus"></i>
                        </span>
                    </button>
                    <div class="dropdown-box w-40">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            <a href=""
                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="printer" class="w-4 h-4 mr-2"></i> Print
                            </a>
                            <a href=""
                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to Excel
                            </a>
                            <a href=""
                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Export to PDF
                            </a>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-no-wrap">IMAGES</th>
                            <th class="whitespace-no-wrap">PRODUCT NAME</th>
                            <th class="text-center whitespace-no-wrap">STOCK</th>
                            <th class="text-center whitespace-no-wrap">STATUS</th>
                            <th class="text-center whitespace-no-wrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (array_slice($fakers, 0, 9) as $faker)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in">
                                        <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                            src="{{ asset('dist/images/' . $faker['images'][0]) }}"
                                            title="Uploaded at {{ $faker['dates'][0] }}">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                            src="{{ asset('dist/images/' . $faker['images'][1]) }}"
                                            title="Uploaded at {{ $faker['dates'][0] }}">
                                    </div>
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                            src="{{ asset('dist/images/' . $faker['images'][2]) }}"
                                            title="Uploaded at {{ $faker['dates'][0] }}">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href=""
                                    class="font-medium whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">
                                    {{ $faker['products'][0]['category'] }}
                                </div>
                            </td>
                            <td class="text-center">{{ $faker['stocks'][0] }}</td>
                            <td class="w-40">
                                <div
                                    class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-theme-9' : 'text-theme-6' }}">
                                    <i data-feather="check-square" class="w-4 h-4 mr-2"></i>
                                    {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                                </div>
                            </td>
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
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
                <ul class="pagination">
                    <li>
                        <a class="pagination__link" href="">
                            <i class="w-4 h-4" data-feather="chevrons-left"></i>
                        </a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">
                            <i class="w-4 h-4" data-feather="chevron-left"></i>
                        </a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">...</a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">1</a>
                    </li>
                    <li>
                        <a class="pagination__link pagination__link--active" href="">2</a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">3</a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">...</a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">
                            <i class="w-4 h-4" data-feather="chevron-right"></i>
                        </a>
                    </li>
                    <li>
                        <a class="pagination__link" href="">
                            <i class="w-4 h-4" data-feather="chevrons-right"></i>
                        </a>
                    </li>
                </ul>
                <select class="w-20 input box mt-3 sm:mt-0">
                    <option>10</option>
                    <option>25</option>
                    <option>35</option>
                    <option>50</option>
                </select>
            </div>
            <!-- END: Pagination -->
        </div>
    </div>
</div>
<!-- END: HTML Tab Content Data -->

<div class="modal" id="activity-modal">
    <div class="modal__content modal__content--lg">
        <form id="activity_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="reservation_id" name="reservation_id" value="{{ $reservation->id }}" />
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto modal-title">Reservation Activity</h2>
                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                    <div class="mr-3">TZS</div>
                    <input id="currency" name="currency" class="input input--switch border" type="checkbox">
                </div>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-6">
                    <label>Day</label>
                    <select id="day" name="day" class="input w-full border mt-2 flex-1 input-form" required>
                        <option>Select a tour day</option>
                        @for ($i = 1; $i <= $touringDays; $i++) <option value="{{$i}}">{{$i}}
                            </option>
                            @endfor
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Parks</label>
                    <select id="park" name="park" class="input w-full border mt-2 flex-1 input-form" required>
                        <option>Select a park's name</option>
                        @foreach ($data['parks'] as $park)
                        <option value="{{$park->id}}">{{$park->park_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="loading" class="col-span-12 flex flex-col justify-end items-center hidden">
                <i data-loading-icon="three-dots" class="w-8 h-8"></i>
            </div>
            <div id="activity_section" class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-6">
                    <label>Activity</label>
                    <select id="activity" name="activity" class="input w-full border mt-2 flex-1 input-form" required>
                    </select>

                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Category</label>
                    <select id="category" name="category" class="input w-full border mt-2 flex-1 input-form" required>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>East Africa <span id="ea_currency"
                            class="text-xs italic text-blue-600 text-right"></span></label>
                    <input id="east_african" name="east_african" type="number" min="0"
                        class="input w-full border mt-2 flex-1" placeholder="0" value="0"
                        {{ in_array('1', $visitorTypes) ? 'required' : 'readonly' }}>
                    <input id="ea_park_activity_id" name="ea_park_activity_id" type="hidden">
                    <input id="ea_activity_id" name="ea_activity_id" type="hidden">
                    <input id="ea_price" name="ea_price" type="hidden">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>Expatriate<span id="ex_currency"
                            class="text-xs italic text-blue-600 text-right"></span></label>
                    <input id="expatriate" name="expatriate" type="number" min="0"
                        class="input w-full border mt-2 flex-1" placeholder="company@email.com" value="0"
                        {{ in_array('2', $visitorTypes) ? 'required' : 'readonly' }}>
                    <input id="ex_park_activity_id" name="ex_park_activity_id" type="hidden">
                    <input id="ex_activity_id" name="ex_activity_id" type="hidden">
                    <input id="ex_price" name="ex_price" type="hidden">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>Non Resident<span id="nr_currency"
                            class="text-xs italic text-blue-600 text-right"></span></label>
                    <input id="non_resident" name="non_resident" type="number" min="0"
                        class="input w-full border mt-2 flex-1" placeholder="0" value="0"
                        {{ in_array('3', $visitorTypes) ? 'required' : 'readonly' }}>
                    <input id="nr_park_activity_id" name="nr_park_activity_id" type="hidden">
                    <input id="nr_activity_id" name="nr_activity_id" type="hidden">
                    <input id="nr_price" name="nr_price" type="hidden">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <button type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-save" type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
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
            <input id="deleting-park" name="deleting-park" type="hidden">
            <input id="deleting-category" name="deleting-category" type="hidden">
            <input id="deleting-day" name="deleting-day" type="hidden">
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
    let parkActivities = ""
    let selectedActivity = ""
    let selectedCategory = ""
    let selectedDay = ""
    let selectedPark = ""
    let forEditing = false

    // cash("#add_activity").on('click', function(e){
    //     cash('#activity-modal').modal('show');
    //     cash('.modal-title').text("Add New Park");
    //     cash('#btn-send').val("Send");
    //     //cash('#park_form')[0].reset();
    // });

    function onDayActivity(day, parkId) {
        if (!cash('#activity_section').hasClass('hidden')) {
            cash('#activity_section').addClass('hidden');
        }
        if (!cash('#loading').hasClass('hidden')) {
            cash('#loading').addClass('hidden');
        }

        cash('#currency').prop("checked", false);
        cash('#activity_form')[0].reset()
        forEditing = false
        //console.log(cash('#currency').prop('checked'));

        if (day == '0') {
            cash('#activity-modal').modal('show');
        }else{
            cash('#activity-modal').modal('show');
            cash('#day').val(day);
            cash('#park').val(parkId);
            cash('#loading').removeClass('hidden');
            loadParkActivities(parkId)
        }
    }

    cash('#park').on('change', event => {
        if (cash('#loading').hasClass('hidden')) {
            cash('#loading').removeClass('hidden');
        }
        if (!cash('#activity_section').hasClass('hidden')) {
            cash('#activity_section').addClass('hidden');
        }
        cash('#activity-modal').modal('show');
        cash('#activity').val('')
        cash('#category').val('')
        cash('#east_african').val('0')
        cash('#expatriate').val('0')
        cash('#non_resident').val('0')
        loadParkActivities(cash('#park').val());
    })


    cash('#activity').on('change', event => {
        setCategories(cash('#activity').val())
    })

    cash('#category').on('change', event => {
        setVisitorsNumber(cash('#category').val())
    })

    cash('#currency').on('change', event => {
        console.log('checked');
        let catId = cash('#category').val()
        if (catId != '' && parkActivities != '') {
            if (event.target.checked) {
                setVisitorsNumber(catId)
            } else {
                setVisitorsNumber(catId)
            }
        }
    })

    async function loadParkActivities(parkId) {
        await helper.delay(500)
        axios.get("{{url('/reservations/load-park-activities')}}"+ '/' + parkId).then(res => {
        if (res.data.success == true) {
            parkActivities = res.data.park_activities;
            //console.log(parkActivities);
            if (forEditing) {
                setActivities()
                loadActivityInfo(selectedDay, selectedPark, selectedCategory)
                console.log('Called - '.selectedActivity);
            }else{
                setActivities()
                cash('#activity_section').removeClass('hidden');
                cash('#loading').addClass('hidden');
            }
        }else {
            console.log(res.data.message)
            alert('Fail to Load')
            cash('#loading').addClass('hidden');
        }
        feather.replace();
        }).catch(err => {
            console.log(err);
        })
    }


    function setActivities(){
        let inputHTML = '<option value="">Select the Activity</option>'
        let arr = []
        let singleValue = ''

        for(let i = 0, l = parkActivities.length; i < l; i++) {
            let activity=parkActivities[i];

            if(arr.indexOf(activity.activity_id) == -1){
                inputHTML = inputHTML + '<option value="'+activity.activity_id+'">'+activity.activity+'</option>'
                arr.push(activity.activity_id);
                singleValue = activity.activity_id
            }
        }
        cash('#activity').html(inputHTML)

        if (forEditing) {
            cash('#activity').val(selectedActivity);
            setCategories(selectedActivity)
        }else{
            if (arr.length == 1) {
                cash('#activity').val(singleValue)
                console.log('Activity ID: '+singleValue);
                setCategories(singleValue)
            }else{
                cash('#category').html('<option value="">Pick Activity First</option>')
            }
        }

    }

    function setCategories(activityId){
        let inputHTML = '<option value="">Select Category of the Activity</option>'
        let arr = []
        let singleValue = ''
        // console.log('From Activity -> ID: '+activityId);

        for(let i = 0, l = parkActivities.length; i < l; i++) {
            let activity=parkActivities[i];

            if (activity.activity_id == activityId) {
                // console.log('ThersIsActivity '+ i);
                if(arr.indexOf(activity.category_id) == -1){
                    inputHTML = inputHTML + '<option value="'+activity.category_id+'">'+activity.category+'</option>'
                    arr.push(activity.category_id);
                    // console.log('isCategory '+ activity.category);
                    singleValue = activity.category_id
                }
            }
        }
        cash('#category').html(inputHTML)

        if (forEditing) {
            cash('#category').val(selectedCategory);
            setVisitorsNumber(selectedCategory)
        }else{
            if (arr.length == 1) {
                cash('#category').val(singleValue)
                setVisitorsNumber(singleValue)
            }
        }
    }


    function setVisitorsNumber(categoryId){
        let isTZS = cash('#currency').prop('checked')
        for(let i = 0, l = parkActivities.length; i < l; i++) {
            let activity=parkActivities[i];
            console.log('Category ID: '+categoryId);
            console.log(activity.category_id);
            if (activity.category_id == categoryId) {
                if(activity.type_id == '1'){
                    if (isTZS) {
                        cash('#ea_currency').text('(@'+activity.price_tzs+' TZS)')
                        cash('#ea_price').val(activity.price_tzs)
                    }else{
                        cash('#ea_currency').text('(@'+activity.price_usd+' USD)')
                        cash('#ea_price').val(activity.price_usd)
                    }
                    console.log(activity.price_tzs);
                    cash('#ea_park_activity_id').val(activity.id)
                }else if (activity.type_id == '2') {
                    if (isTZS) {
                        cash('#ex_currency').text('(@'+activity.price_tzs+' TZS)')
                        cash('#ex_price').val(activity.price_tzs)
                    }else{
                        cash('#ex_currency').text('(@'+activity.price_usd+' USD)')
                        cash('#ex_price').val(activity.price_usd)
                    }
                    console.log(activity.price_tzs);
                    cash('#ex_park_activity_id').val(activity.id)
                }else if (activity.type_id == '3') {
                    if (isTZS) {
                        cash('#nr_currency').text('(@'+activity.price_tzs+' TZS)')
                        cash('#nr_price').val(activity.price_tzs)
                    }else{
                        cash('#nr_currency').text('(@'+activity.price_usd+' USD)')
                        cash('#nr_price').val(activity.price_usd)
                    }
                    console.log(activity.price_tzs);
                    cash('#nr_park_activity_id').val(activity.id)
                }
            }
        }
    }

    const activityForm = cash('#activity_form')[0]
    activityForm.onsubmit = event =>{
        // let ea = cash('#east_african').val() == '' ? '0' : cash('#east_african').val()
        // let ex = cash('#expatriate').val() == '' ? '0' : cash('#expatriate').val()
        // let nr = cash('#non_resident').val() == '' ? '0' : cash('#non_resident').val()
        if(activityForm.checkValidity()) {
            addUpdateActivity()
        }else console.log("invalid form");
    }

    async function addUpdateActivity() {
        let count = cash('#input-count').val();
        let currency = 'USD'
        if (cash('#currency').prop('checked')) {
            currency = 'TZS'
        }
        let action = 'add-new'
        if (forEditing) {
            action = 'update'
        }

        let activityForm = cash('#activity_form')[0];
        var formData = new FormData(activityForm);
        formData.append('count', count);
        formData.append('currency', currency);
        formData.append('action', action);

        cash('#btn-save').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/reservations/add-activity')}}", formData, config).then(res => {
        cash('#btn-save').html('Save')
        if (res.data.success == true) {
            cash('#activity-modal').modal('hide');
            cash('#input-search').val('');
            cash('#input-count').val(count);
            cash('#activity-rows').html(res.data.reservationActivities)
            cash('#day_park_links').html(res.data.dayParkLinks)
        }else {
            console.log(res.data.message)
            //alert()
            let msgs = res.data.message
            msgs.forEach(element =>
            cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
        }
        feather.replace();
        }).catch(err => {
            cash('#btn-save').html('Save')
            console.log(err);
        })
    }


    function onActivityEdit(day, parkId, activityId, categoryId) {
        forEditing = true
        selectedCategory = categoryId
        selectedActivity = activityId
        selectedPark = parkId
        selectedDay = day

        // console.log('cat - '+categoryId);
        // console.log('sel_cat - '+selectedCategory);
        // console.log('act - '+activityId);
        // console.log('sel_act - '+selectedActivity);
        // console.log('park - '+parkId);
        // console.log('sel_park - '+selectedPark);
        // console.log('day - '+day);
        // console.log('sel_day - '+selectedDay);

        if (!cash('#activity_section').hasClass('hidden')) {
            cash('#activity_section').addClass('hidden');
        }
        if (!cash('#loading').hasClass('hidden')) {
            cash('#loading').addClass('hidden');
        }

        cash('#currency').prop("checked", false);
        cash('#activity_form')[0].reset()

        cash('#activity-modal').modal('show');
        cash('#loading').removeClass('hidden');
        cash('#day').val(day);
        cash('#park').val(parkId);
        loadParkActivities(parkId)
        //cash('#activity').val(activityId);
        //cash('#category').val(categoryId);

        //loadActivityInfo(day, parkId, categoryId)
    }

    async function loadActivityInfo(day, parkId, categoryId) {
        console.log(day+' - ' + parkId + ' - ' + categoryId);
        await helper.delay(500)
        axios.post("{{url('/reservations/load-activity-info')}}", {
            reservation_id : cash('#reservation_id').val(),
            day: day,
            park_id: parkId,
            category_id: categoryId
        }).then(res => {
        if (res.data.success == true) {
            setVisitorsInfo(res.data.activities)
            cash('#activity_section').removeClass('hidden');
            cash('#loading').addClass('hidden');
            cash('#activity-rows').html(res.data.reservationActivities)
            cash('#day_park_links').html(res.data.dayParkLinks)
        }else {
            console.log(res.data.message)
        }
        feather.replace();
        }).catch(err => {
            console.log(err);
        })
    }


    function setVisitorsInfo(activities){
        let isTZS = false
        if (activities[0].currency == 'TZS') {
            cash('#currency').prop("checked", true);
            isTZS = true
        }

        for(let i = 0, l = activities.length; i < l; i++) {
            let activity=activities[i];
            console.log(activity.category_id);
            if(activity.type_id == '1'){
                if (isTZS) {
                    cash('#ea_currency').text('(@'+activity.price_tzs+' TZS)')
                    cash('#ea_price').val(activity.price_tzs)
                }else{
                    cash('#ea_currency').text('(@'+activity.price_usd+' USD)')
                    cash('#ea_price').val(activity.price_usd)
                }
                console.log(activity.price_tzs);
                cash('#east_african').val(activity.pax)
                cash('#ea_park_activity_id').val(activity.park_activity_id)
                cash('#ea_activity_id').val(activity.id)
            }else if (activity.type_id == '2') {
                if (isTZS) {
                    cash('#ex_currency').text('(@'+activity.price_tzs+' TZS)')
                    cash('#ex_price').val(activity.price_tzs)
                }else{
                    cash('#ex_currency').text('(@'+activity.price_usd+' USD)')
                    cash('#ex_price').val(activity.price_usd)
                }
                console.log(activity.price_tzs);
                cash('#expatriate').val(activity.pax)
                cash('#ex_park_activity_id').val(activity.park_activity_id)
                cash('#ex_activity_id').val(activity.id)
            }else if (activity.type_id == '3') {
                if (isTZS) {
                    cash('#nr_currency').text('(@'+activity.price_tzs+' TZS)')
                    cash('#nr_price').val(activity.price_tzs)
                }else{
                    cash('#nr_currency').text('(@'+activity.price_usd+' USD)')
                    cash('#nr_price').val(activity.price_usd)
                }
                console.log(activity.price_tzs);
                cash('#non_resident').val(activity.pax)
                cash('#nr_park_activity_id').val(activity.park_activity_id)
                cash('#nr_activity_id').val(activity.id)
            }
        }
    }

    function onActivityDelete(day, parkId, categoryId) {
        cash('#deleting-day').val(day)
        cash('#deleting-park').val(parkId)
        cash('#deleting-category').val(categoryId)
        cash('#delete-modal').modal('show');
    }


    cash('#btn-delete').on('click', event => {
        let day = cash('#deleting-day').val();
        let park = cash('#deleting-park').val();
        let category = cash('#deleting-category').val();
        console.log(day+' - ' + park + ' - ' + category);
        deleteActivity(day, park, category)
    })


    async function deleteActivity(day, parkId, categoryId) {
        cash('#btn-delete').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        console.log(day+' - ' + parkId + ' - ' + categoryId);
        await helper.delay(500)
        axios.post("{{url('/reservations/delete-activity')}}", {
            reservation_id : cash('#reservation_id').val(),
            day: day,
            park_id: parkId,
            category_id: categoryId
        }).then(res => {
        if (res.data.activity) {
            cash('#activity-rows').html(res.data.rsrv_activities)
            cash('#day_park_links').html(res.data.day_park_links)
            cash('#delete-modal').modal('hide');
        }else {
            alert('Fail to Delete')
            console.log(res.data.message)
        }
        cash('#btn-delete').html('Delete')
        feather.replace();
        }).catch(err => {
            console.log(err);
            cash('#btn-delete').html('Delete')
        })
    }


</script>
@endsection
