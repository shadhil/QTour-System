@php
$title = $data['title'];
$parks = $data['parks'];

@endphp

@extends('../layout/main')


@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center">
            <a href="javascript:void(0);" class="button inline-block bg-theme-1 text-white" id="add-user">
                Add Park
            </a>
        </div>
        <div class="hidden md:block mx-auto text-gray-600"></div>
        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
            <div class="w-56 relative text-gray-700 dark:text-gray-300">
                <input id="input-search" type="text" class="input w-56 box pr-10 placeholder-theme-13"
                    placeholder="Search..." value="">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
        </div>
    </div>

</div>
<div id="table-data" class="grid grid-cols-12 gap-5 mt-5">
    @include('parks.parks-table')
</div>

<!-- BEGIN: Header & Footer Modal -->
<div class="modal" id="user-modal">
    <div class="modal__content modal__content--lg">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto modal-title">
                User Profile
            </h2>
            <button id="btn-edit1"
                class="button user-quotation border items-center text-gray-700 dark:border-dark-5 dark:text-gray-300 hidden sm:flex">
                <i data-feather="edit" class="w-4 h-4 mr-2"></i> Edit </button>
            <div class="dropdown sm:hidden">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal"
                        class="w-5 h-5 text-gray-700 dark:text-gray-600"></i>
                </a>
                <div class="dropdown-box w-40">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href="javascript:;" id="btn-edit2"
                            class="user-quotation flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="edit" class="w-4 h-4 mr-2"></i> Edit </a>
                    </div>
                </div>
            </div>
        </div>
        <form id="user_form" class="validate-form" enctype="multipart/form-data">
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 input-form">
                    <label>Park Name</label>
                    <input id="park_name" name="park_name" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Park Name" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Region</label>
                    <select id="region" name="region" data-placeholder="Pick a region"
                        class="input w-full border mt-2 flex-1" required>
                        @foreach ($data['regions'] as $region)
                        <option value="{{ $region->id }}">{{ $region->region }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">

                </div>
                <button id="btn-cancel" type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-send" name="btn-send" type="submit"
                    class="button w-20 bg-theme-1 text-white">Send</button>
            </div>
        </form>
    </div>
</div>
@endsection
