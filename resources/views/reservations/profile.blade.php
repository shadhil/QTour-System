@php
$reservation = $data['reservation'];
$a = empty($reservation->adults) ? 0 : (int)$reservation->adults;
$b = empty($reservation->babies) ? 0 : (int)$reservation->babies;
$c = empty($reservation->children) ? 0 : (int)$reservation->children;
$sd = date_create($reservation->start_date);
$ed = date_create($reservation->end_date);
$diff=date_diff($sd,$ed);
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
                <i data-feather="users" class="w-4 h-4 mr-2 tooltip" title="Total Visitors"></i>
                {{ ($a + $b + $c).' Visitor(s)' }}
            </div>
            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                <i data-feather="briefcase" class="w-4 h-4 mr-2 tooltip" title="Permit Holder"></i>
                {{ $reservation->cr_fname.' '.$reservation->cr_lname }}
            </div>
            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                <i data-feather="calendar" class="w-4 h-4 mr-2 tooltip" title="Tour Dates"></i>
                {{date_format($sd,"m/d/Y").' - '.date_format($ed,"m/d/Y")}}
            </div>
        </div>
        <div
            class="mt-6 lg:mt-0 flex-1 flex items-center justify-center px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">{{($diff->format("%a") + 1)}}</div>
                <div class="text-gray-600">Day(s)</div>
            </div>
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">{{ $reservation->nights }}</div>
                <div class="text-gray-600">Night(s)</div>
            </div>
            <div class="text-center rounded-md w-20 py-3">
                <div class="font-semibold text-theme-1 dark:text-theme-10 text-lg">12</div>
                <div class="text-gray-600">Activities</div>
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
        <div class="grid grid-cols-12 gap-5 mt-5">
            <div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base">Day 1</div>
                <div class="text-gray-600">Serengeti National Park</div>
            </div>
            <div
                class="col-span-12 sm:col-span-3 xxl:col-span-2 box bg-theme-1 dark:bg-theme-1 p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base text-white">Day 2</div>
                <div class="text-theme-25 dark:text-gray-400">Manyara National Park</div>
            </div>
            <div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base">Pasta</div>
                <div class="text-gray-600">4 Items</div>
            </div>
            <div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base">Waffle</div>
                <div class="text-gray-600">3 Items</div>
            </div>
            <div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base">Snacks</div>
                <div class="text-gray-600">8 Items</div>
            </div>
            <div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base">Deserts</div>
                <div class="text-gray-600">8 Items</div>
            </div>
            <div class="col-span-12 sm:col-span-3 xxl:col-span-2 box p-5 cursor-pointer zoom-in">
                <div class="font-medium text-base">Beverage</div>
                <div class="text-gray-600">9 Items</div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                <button id="add_activity" class="button text-white bg-theme-1 shadow-md mr-2">Add Activity</button>
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
                            <th class="whitespace-no-wrap">DAY</th>
                            <th class="whitespace-no-wrap">ACTIVITY - park</th>
                            <th class="text-center whitespace-no-wrap">PAX - @price</th>
                            <th class="text-center whitespace-no-wrap">TOTAL</th>
                            <th class="text-center whitespace-no-wrap">VAT</th>
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
        <form id="hotel_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="hotel_id" name="hotel_id" value="" />
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="" />
            <input type="hidden" id="og_email" name="og_email" value="" />
            <input type="hidden" id="og_phones" name="og_phones" value="" />
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto modal-title">Reservation Activity</h2>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-6">
                    <label>Day</label>
                    <input id="location" name="location" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Office or Residence" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Parks</label>
                    <select id="region" name="region" class="input w-full border mt-2 flex-1" required>
                        <option>Select a region the park is located</option>
                        {{-- @foreach ($data['regions'] as $region)
                        <option value="{{$region->id}}">{{$region->region}}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Activity</label>
                    <input id="phones" name="phones" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="0">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Category</label>
                    <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                        placeholder="company@email.com" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>EA</label>
                    <input id="phones" name="phones" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="0">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>E</label>
                    <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                        placeholder="company@email.com" required>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>NR</label>
                    <input id="phones" name="phones" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="0">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <button type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-send" type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    cash("#add_activity").on('click', function(e){
        cash('#activity-modal').modal('show');
        cash('.modal-title').text("Add New Park");
        cash('#btn-send').val("Send");
        //cash('#park_form')[0].reset();
    });

</script>
@endsection
