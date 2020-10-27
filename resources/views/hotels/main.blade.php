@php
$title = $data['title'];
$users = $data['users'];

@endphp

@extends('../layout/main')


@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center">
            <a href="javascript:void(0);" class="button inline-block bg-theme-1 text-white" id="add-user">
                New Hotel
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
<div id="table-data" class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">
    @include('hotels.hotels-table')
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
            <input type="hidden" id="user_id" name="user_id" value="" />
            <input type="hidden" id="og_roles" name="og_roles[]" value="" />
            <input type="hidden" id="og_permissions" name="og_permissions[]" value="" />
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="" />
            <input type="hidden" id="og_pwd" name="og_pwd" value="" class="xl:hidden opacity-0" />
            <input type="password" value="" class="xl:hidden opacity-0" />
            <input type="hidden" id="operation" name="operation" value="" />

            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-1">
                        <div id="img-div" class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img id="user_photo_view" class="rounded-md" alt="Crew Member Photo"
                                src="{{ asset('dist/images/profile-6.jpg')}}">
                            <div id="remove-photo" title="Remove this profile photo?" class="xl:hidden">
                                <i data-feather="x" class="w-4 h-4"></i> </div>
                        </div>
                        <div class="w-35 mx-auto cursor-pointer relative mt-5">
                            <button type="button" class="button w-full bg-theme-1 text-white">Change Photo</button>
                            <input id="user_photo" name="user_photo" type="file" accept="image/*"
                                class="w-full h-full top-0 left-0 absolute opacity-0 cursor-pointer">
                            <input class="xl:hidden opacity-0" type="text" id="user_photo_name" name="user_photo_name"
                                value="" />
                        </div>
                    </div>
                </div>
                <div class="col-span-12 xl:col-span-8">
                    <div class="col-span-12 input-form">
                        <label>First Name</label>
                        <input id="first_name" name="first_name" type="text" class="input w-full border mt-2 flex-1"
                            placeholder="John" required disabled>
                    </div>
                    <div class="col-span-12 input-form mt-3">
                        <label>Last Name</label>
                        <input id="last_name" name="last_name" type="text" class="input w-full border mt-2 flex-1"
                            placeholder="Doe" required>
                    </div>
                    <div class="col-span-12  input-form mt-3">
                        <label>Gender</label>
                        <select id="gender" name="gender" data-placeholder="Pick a user gender"
                            class="input w-full border mt-2 flex-1" required>
                            <option value=""> -- User's Gender -- </option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 input-form">
                    <label>Location</label>
                    <input id="location" name="location" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Office/ Resident" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Phone Number</label>
                    <input id="phone_number" name="phone_number" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="0712 234 567" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Email</label>
                    <input id="email" name="email" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="example@email.com" autocomplete="nope" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Password</label>
                    <input id="password" name="password" type="password" class="input w-full border mt-2 flex-1"
                        placeholder="Password" autocomplete="new-password" minlength="6" required>
                </div>
                <div id="roleView" class="col-span-12 xl:col-span-6 input-form"><label>Role(s)</label>
                    <select id="roles" name="roles[]" data-placeholder="Select user role"
                        class="tail-select w-full pt-2" multiple required>
                        @include('layout.components.multi-roles-selector')
                        {{-- @foreach ($data['roles'] as $role)
                                <option value="{{ $role['id']}}">{{$role['name']}}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div id="permissionView" class="col-span-12 input-form">
                    <label>Permissions <span class="text-xs text-gray-600">(Option)</span></label>
                    <select id="permissions" name="permissions[]" data-placeholder="Select task permitted to user"
                        data-search="true" class="tail-select w-full" multiple>
                        @include('layout.components.multi-selector')
                        {{-- @foreach ($data['permissions'] as $permission)
                                <option value="{{ $permission['id']}}">{{$permission['name']}}</option>
                        @endforeach --}}
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
