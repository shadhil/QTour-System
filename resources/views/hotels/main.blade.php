@php
$title = $data['title'];
$hotels = $data['hotels'];
@endphp

@extends('../layout/main')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">Point of Sale</h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" data-toggle="modal" data-target="#new-order-modal"
            class="button text-white bg-theme-1 shadow-md mr-2">New Order</a>
        <div class="pos-dropdown dropdown ml-auto sm:ml-0">
            <button class="dropdown-toggle button px-2 box text-gray-700 dark:text-gray-300">
                <span class="w-5 h-5 flex items-center justify-center">
                    <i class="w-4 h-4" data-feather="chevron-down"></i>
                </span>
            </button>
            <div class="pos-dropdown__dropdown-box dropdown-box">
                <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                        <span class="truncate">INV-0206020 - {{ $fakers[3]['users'][0]['name'] }}</span>
                    </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                        <span class="truncate">INV-0206022 - {{ $fakers[4]['users'][0]['name'] }}</span>
                    </a>
                    <a href=""
                        class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                        <i data-feather="activity" class="w-4 h-4 mr-2"></i>
                        <span class="truncate">INV-0206021 - {{ $fakers[5]['users'][0]['name'] }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y col-span-12">
        <div class="lg:flex intro-y">
            <div class="relative text-gray-700 dark:text-gray-300">
                <input type="text" class="input input--lg w-full lg:w-64 box pr-10 placeholder-theme-13"
                    placeholder="Search item...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
            <select class="input input--lg box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
                <option>Sort By</option>
                <option>A to Z</option>
                <option>Z to A</option>
                <option>Lowest Price</option>
                <option>Highest Price</option>
            </select>
        </div>
        <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">
            @include('hotels.hotels-table')
        </div>
    </div>
    <!-- END: Item List -->
</div>
@endsection
