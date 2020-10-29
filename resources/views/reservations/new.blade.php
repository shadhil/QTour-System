@extends('../layout/main')

@section('content')
{{-- <div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Wizard Layout</h2>
</div> --}}
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-5 sm:py-10 mt-5">
    <div class="px-5 mt-1">
        <div class="font-medium text-center text-lg">Register Your Reservartion</div>
        <div id="step-info" class="text-gray-600 text-center mt-2">To start off, please enter group/family name, email
            address and password.</div>
    </div>
    <div class="px-5 sm:px-20 mt-5 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">General Details</div>
        <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Group/Family Name</div>
                <input type="text" class="input w-full border flex-1" placeholder="example@gmail.com">
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Driver/Guide Name</div>
                <input id="demo" type="text" class="input w-full border flex-1" placeholder="example@gmail.com">
            </div>
            <div class="intro-y col-span-12 sm:col-span-4">
                <div class="mb-2">Start Dates</div>
                <div class="relative">
                    <div
                        class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                        <i data-feather="calendar" class="w-4 h-4"></i> </div>
                    <input type="text" class="datepicker input pl-12 w-full border flex-1" data-single-mode="true">
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-4">
                <div class="mb-2">End Dates</div>
                <div class="relative">
                    <div
                        class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 border text-gray-600 dark:bg-dark-1 dark:border-dark-4">
                        <i data-feather="calendar" class="w-4 h-4"></i> </div>
                    <input type="text" class="datepicker input pl-12 w-full border flex-1" data-single-mode="true">
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-2">
                <div class="mb-2">Day(s)</div>
                <input type="text" class="input w-24 border flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="intro-y col-span-12 sm:col-span-2">
                <div class="mb-2">Night(s)</div>
                <input type="text" class="input w-24 border flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Reservation Code</div>
                <input type="text" class="input w-full border flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="intro-y col-span-12 sm:col-span-6">
                <div class="mb-2">Booked By:</div>
                <select class="input w-full border flex-1">
                    <option>10</option>
                    <option>25</option>
                    <option>35</option>
                    <option>50</option>
                </select>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="intro-y box py-5 sm:py-10 mt-5">
    <div class="px-5 mt-1">
        <div class="font-medium text-center text-lg">Visitors Information</div>
        <div id="step-info" class="text-gray-600 text-center mt-2">To start off, please enter group/family name, email
            address and password.</div>
    </div>
    <div class="px-5 sm:px-20 mt-5 border-t border-gray-200 dark:border-dark-5">

        <div id="group_inputs" class="grid grid-cols-12 gap-4 row-gap-5 mt-5 hidden">
            <div class="intro-y col-span-12 sm:col-span-4">
                <div class="mb-2">Visitor's Group(s)</div>
                <select class="input w-full border flex-1">
                    <option>10</option>
                    <option>25</option>
                    <option>35</option>
                    <option>50</option>
                </select>
            </div>
            <div class="flex gap-4 intro-y col-span-12 sm:col-span-8">
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Adult(s)</div>
                    <input type="text" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Children</div>
                    <input type="text" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
                <div class="flex-1 intro-y col-span-12 sm:col-span-4">
                    <div class="mb-2">Baby</div>
                    <input type="text" class="input w-full border flex-1" placeholder="eg. 2">
                </div>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-start mt-5">
                <button class="button w-24 justify-center block bg-theme-1 text-white ">Submit</button>
                <button
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
                        <tr>
                            <td class="border-b dark:border-dark-5">1</td>
                            <td class="text-center border-b dark:border-dark-5">Expatriate</td>
                            <td class="text-center border-b dark:border-dark-5">4</td>
                            <td class="text-center border-b dark:border-dark-5">1</td>
                            <td class="text-center border-b dark:border-dark-5">0</td>
                            <td class="border-b dark:border-dark-5">
                                <div class="flex justify-center items-center">
                                    <a class="flex items-center mr-5 text-theme-1 tooltip" title="Add Visitor"
                                        href="javascript:;" data-toggle="modal" data-target="#add-visitor-name-modal">
                                        <i data-feather="user-plus" class="w-4 h-4 mr-1"></i> Names
                                    </a>
                                    <a class="flex items-center mr-5 tooltip" title="Edit" href="javascript:;"> <i
                                            data-feather="check-square" class="w-4 h-4 mr-1"></i>
                                    </a>
                                    <a class="flex items-center text-theme-6 tooltip" title="Delete" href="javascript:;"
                                        data-toggle="modal" data-target="#delete-confirmation-modal"> <i
                                            data-feather="trash-2" class="w-4 h-4 mr-1"></i></a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="intro-y col-span-12 grid grid-cols-12 gap-6 mt-5">
                <div class="font-medium text-base intro-y col-span-12 mt-5">Visitors'
                    Name(s)</div>
                <!-- BEGIN: Users Layout -->
                @foreach ($fakers as $faker)
                <div class="intro-y col-span-12 md:col-span-6">
                    <div class="box">
                        <div class="flex flex-col lg:flex-row items-center p-5">
                            <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full"
                                    src="{{ asset('dist/images/' . $faker['photos'][0]) }}">
                            </div>
                            <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                                <a href="" class="font-medium">{{ $faker['users'][0]['name'] }}</a>
                                <div class="text-gray-600 text-xs">{{ $faker['jobs'][0] }}</div>
                            </div>
                            <div class="flex mt-4 lg:mt-0">
                                <button
                                    class="button button--sm text-gray-700 border border-gray-300 dark:border-dark-5 dark:text-gray-300">Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- BEGIN: Users Layout -->
                <!-- END: Pagination -->
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
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button
                    class="button w-24 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Close</button>
                <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END: Wizard Layout -->
@endsection

@section('script')
<script>
    // cash('#demo').daterangepicker({
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
</script>

@endsection
