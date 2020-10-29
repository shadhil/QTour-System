@php
$title = $data['title'];
// $hotels = $data['hotels'];
@endphp

@extends('../layout/main')

@section('content')
<div class="flex items-center mt-8">
    <h2 class="intro-y text-lg font-medium mr-auto">Wizard Layout</h2>
</div>
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-10 sm:py-20 mt-5">
    <div class="flex justify-center">
        <button class="intro-y w-10 h-10 rounded-full button text-white bg-theme-1 mx-2">1</button>
        <button class="intro-y w-10 h-10 rounded-full button bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2"><i
                data-feather="edit-3" class="w-4 h-4 text-gray-600"></i></button>
        <button class="intro-y w-10 h-10 rounded-full button bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2">3</button>
    </div>
    <div class="px-5 mt-8">
        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto align-content-center">
            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">
        </div>
        <div class="font-medium text-center text-lg mt-3">Setup Your Account</div>
        <div class="text-gray-600 text-center mt-2">To start off, please enter your username, email address and
            password.</div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">General Information</div>
        <form id="member_form" class="validate-form" enctype="multipart/form-data">
            <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                <div class="col-span-12 xl:col-span-3">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                                src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">
                            <div title="Remove this profile photo?"
                                class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-5">
                            <button type="button" class="button w-full bg-theme-1 text-white">Change Photo</button>
                            <input type="file" class="w-full h-full top-0 left-0 absolute opacity-0">
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-8 content-center cursor-pointer">
                            <a href="javascript:;"
                                class="w-full text-theme-1 block font-normal cursor-pointer flex align-content-center ml-2"><i
                                    data-feather="file-text" class="w-4 h-4 mr-1"></i> <u class="cursor-pointer"> Upload
                                    Hotel Rates</u> </a>
                            <input id="hotel_doc" name="hotel_doc" type="file"
                                class="w-full h-full top-0 left-0 absolute opacity-0 cursor-pointer">
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-9 xxl:col-span-9 pl-5 pr-5 pb-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Hotel Name</label>
                        <input id="name" name="name" type="text" class="input w-full border mt-2 flex-1"
                            placeholder="Full Name" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Location</label>
                        <input id="location" name="location" type="text" class="input w-full border mt-2 flex-1"
                            placeholder="Office or Residence" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Region</label>
                        <select id="region" name="region" class="input w-full border mt-2 flex-1" required>
                            <option>Select a region the park is located</option>
                            @foreach ($data['regions'] as $region)
                            <option value="{{$region->id}}">{{$region->region}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Phone Number(s)</label>
                        <input id="phones" name="phones" type="text" class="input w-full border mt-2 flex-1"
                            placeholder="0729 ...., 0635 ....">
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Email</label>
                        <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                            placeholder="company@email.com" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Inside a Park?</label>
                        <select id="inside_park" name="inside_park" class="input w-full border mt-2 flex-1">
                            <option>Select a park the hotel is inside</option>
                            @foreach ($data['parks'] as $park)
                            <option value="{{$park->id}}">{{$park->park_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Near Park</label>
                        <select id="near_park" name="near_park" class="input w-full border mt-2 flex-1">
                            <option>Select a park the hotel is near</option>
                            @foreach ($data['parks'] as $park)
                            <option value="{{$park->id}}">{{$park->park_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <button
                            class="button w-24 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Previous</button>
                        <button class="button w-24 justify-center block bg-theme-1 text-white ml-2">Next</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        {{-- <div class="text-lg font-medium text-base">Room Details</div> --}}
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                    <!-- BEGIN: Categories -->
                    <div class="col-span-12 md:col-span-6 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Categories</h2>
                            <a href="javascript:;" data-toggle="modal" data-target="#new-category-modal"
                                class="ml-auto text-theme-1 dark:text-theme-10 truncate flex items-center">
                                <i data-feather="plus" class="w-4 h-4 mr-1"></i> New Category
                            </a>
                        </div>
                        <div class="mt-5">
                            @foreach (array_slice($fakers, 0, 5) as $faker)
                            <div class="intro-x">
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="w-full ml-10 mr-4">
                                        <div class="font-bold text-center capitalize">{{ $faker['users'][0]['name'] }}
                                        </div>
                                    </div>
                                    <div class=" flex">
                                        <i data-feather="edit" class="w-4 h-4 text-theme-9 mr-2"></i>
                                        <i data-feather="trash" class="w-4 h-4 text-theme-6"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- END: Categories -->
                    <!-- BEGIN: Room Types -->
                    <div class="col-span-12 md:col-span-6 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Room Types</h2>
                            <a href="javascript:;" data-toggle="modal" data-target="#new-type-modal"
                                class="ml-auto text-theme-1 dark:text-theme-10 truncate flex items-center">
                                <i data-feather="plus" class="w-4 h-4 mr-1"></i> New Room
                            </a>
                        </div>
                        <div class="mt-5">
                            @foreach (array_slice($fakers, 0, 5) as $faker)
                            <div class="intro-x">
                                <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                                    <div class="w-full ml-10 mr-4">
                                        <div class="font-bold text-center capitalize">{{ $faker['users'][0]['name'] }}
                                        </div>
                                    </div>
                                    <div class=" flex">
                                        <i data-feather="edit" class="w-4 h-4 text-theme-9 mr-2"></i>
                                        <i data-feather="trash" class="w-4 h-4 text-theme-6"></i>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- END: Room Types -->

                    <!-- BEGIN: Important Notes -->
                    <div
                        class="col-span-12 md:col-span-6 xl:col-span-12 xxl:col-span-12 xl:col-start-1 xl:row-start-1 xxl:col-start-auto xxl:row-start-auto mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-auto">Important Notes</h2>
                            <button data-carousel="important-notes" data-target="prev"
                                class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600 mr-2">
                                <i data-feather="chevron-left" class="w-4 h-4"></i>
                            </button>
                            <button data-carousel="important-notes" data-target="next"
                                class="tiny-slider-navigator button px-2 border border-gray-400 dark:border-dark-5 flex items-center text-gray-700 dark:text-gray-600">
                                <i data-feather="chevron-right" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <div class="mt-5 intro-x">
                            <div class="box zoom-in">
                                <div class="tiny-slider" id="important-notes">
                                    <div class="p-5">
                                        <div class="text-base font-medium truncate">What are Categories
                                        </div>
                                        <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of
                                            the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the
                                            1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button"
                                                class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View
                                                Notes</button>
                                            <button type="button"
                                                class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="font-medium truncate">Types of Room</div>
                                        <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of
                                            the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the
                                            1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button"
                                                class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View
                                                Notes</button>
                                            <button type="button"
                                                class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="font-medium truncate">About Meal Plans &amp; Seasons</div>
                                        <div class="text-gray-600 text-justify mt-1">Lorem Ipsum is simply dummy text of
                                            the printing and
                                            typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text ever since the
                                            1500s.</div>
                                        <div class="font-medium flex mt-5">
                                            <button type="button"
                                                class="button button--sm bg-gray-200 dark:bg-dark-5 text-gray-600 dark:text-gray-300">View
                                                Notes</button>
                                            <button type="button"
                                                class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Important Notes -->

                </div>
            </div>
        </div>
    </div>


    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <button class="button text-white bg-theme-1 shadow-md mr-2">Add New Rate</button>

            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700 dark:text-gray-300">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">ROOM TYPE </th>
                        <th class="text-center whitespace-no-wrap">MEAL PLAN</th>
                        <th class="text-center whitespace-no-wrap">STO RATE</th>
                        <th class="text-center whitespace-no-wrap">RACK RATE</th>
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="w-full bg-theme-1">
                        <th class="w-full text-center text-white font-medium whitespace-no-wrap" colspan="5">
                            CATEGORY 1
                        </th>
                    </tr>
                    @foreach (array_slice($fakers, 0, 9) as $faker)
                    <tr class="intro-x">
                        <td>
                            <a href="" class="font-medium whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>
                            <div class="text-gray-600 text-xs whitespace-no-wrap">
                                {{ $faker['products'][0]['category'] }}</div>
                        </td>
                        <td class="w-40">
                            <div
                                class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-theme-9' : 'text-theme-6' }}">
                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i>
                                {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                            </div>
                        </td>
                        <td class="text-center">{{ $faker['stocks'][0] }}</td>
                        <td class="text-center">{{ $faker['stocks'][0] }}</td>

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
                    <tr class="w-full bg-theme-1">
                        <th class="w-full text-center text-white font-medium whitespace-no-wrap" colspan="5">
                            CATEGORY 1
                        </th>
                    </tr>
                    @foreach (array_slice($fakers, 0, 9) as $faker)
                    <tr class="intro-x">
                        <td>
                            <a href="" class="font-medium whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>
                            <div class="text-gray-600 text-xs whitespace-no-wrap">
                                {{ $faker['products'][0]['category'] }}</div>
                        </td>
                        <td class="w-40">
                            <div
                                class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-theme-9' : 'text-theme-6' }}">
                                <i data-feather="check-square" class="w-4 h-4 mr-2"></i>
                                {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                            </div>
                        </td>
                        <td class="text-center">{{ $faker['stocks'][0] }}</td>
                        <td class="text-center">{{ $faker['stocks'][0] }}</td>

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
    </div>
</div>
<!-- END: Wizard Layout -->

<div class="modal" id="new-type-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">New Room Type</h2>
        </div>
        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
            <div class="col-span-12">
                <label>Room Type</label>
                <input id="room_type" name="room_type" type="text" class="input w-full border mt-2 flex-1"
                    placeholder="Type of room in this hotel">
            </div>
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
            <button type="button" data-dismiss="modal"
                class="button w-32 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</button>
            <button id="btn-save" type="button" class="button w-32 bg-theme-1 text-white">Save Now</button>
        </div>
    </div>
</div>

<div class="modal" id="new-category-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">New Room Category</h2>
        </div>
        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
            <div class="col-span-12">
                <label>Room Category</label>
                <input id="room_category" name="room_category" type="text" class="input w-full border mt-2 flex-1"
                    placeholder="Category of rooms in this hotel">
            </div>
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
            <button type="button" data-dismiss="modal"
                class="button w-32 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</button>
            <button id="btn-save" type="button" class="button w-32 bg-theme-1 text-white">Save Now</button>
        </div>
    </div>
</div>
@endsection
