@php
$title = $data['title'];
$users = $data['users'];

$permissions['all'] = $data['permissions'];
$permissions['selected'] = [1,5,9];

$roles['all'] = $data['roles'];
$roles['selected'] = [];

@endphp

@extends('../layout/main')


@section('content')
{{--
<h2 class="intro-y text-lg font-medium mt-10">
    Sytem Admins &amp; Users
</h2> --}}
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center">
            <a href="{{ route('users.new') }}" class="button inline-block bg-theme-1 text-white">Add
                New User</a>
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
<div id="table-data" class="grid grid-cols-12 gap-6 mt-5">
    @include('users.users-table')
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
                            <img id="user_photo_view" class="rounded-md" alt="Midone Tailwind HTML Admin Template"
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
                            placeholder="John" required>
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
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5"></div>
                <button id="btn-cancel" type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-send" name="btn-send" type="submit"
                    class="button w-20 bg-theme-1 text-white">Send</button>
            </div>
        </form>
    </div>
</div>
<!-- END: Header & Footer Modal -->

<!-- BEGIN: Profile Modal -->
<div class="modal" id="profile-modal">
    <div class="modal__content">
        <div class="pl-5 pt-5 pr-5 pb-2 text-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit mx-auto mt-2">
                <img id="pr-photo" alt="Crew member Photo" class="rounded-full" src="dist/images/profile-13.jpg">
            </div>
            <div id="pr-name" class="text-black font-medium mt-2">Shadhil Othman</div>
            <div id="pr-role-gender" class="text-gray-600 text-sm italic">Driver Cook - male</div>
            <input id="url_string" name="url_string" type="hidden">
            <input type="hidden" id="user_id" name="user_id" />
        </div>
        <div class="pl-5 pr-5 grid grid-cols-12 gap-4 row-gap-3 text-center">
            <div class="col-span-12 xl:col-span-6 flex items-center truncate mt-2">
                <i data-feather="map-pin" class="w-4 h-4 mr-2 text-blue-400"></i> <span id="pr-location"></span>
            </div>
            <div class="col-span-12 xl:col-span-6 flex items-center truncate text-dark mt-2">
                <i data-feather="phone" class="w-4 h-4 mr-2 text-blue-400"></i> <span id="pr-phone"></span>
            </div>
            <div class="col-span-12 xl:col-span-6 flex items-center truncate mt-2">
                <i data-feather="mail" class="w-4 h-4 mr-2 text-blue-400"></i> <span id="pr-mail"></span>
            </div>
            <div id="pr-other-contact" class="col-span-12 xl:col-span-6 flex items-center mt-2">
                <i data-feather="message-circle" class="w-4 h-4 mr-2 text-blue-400"></i> -
            </div>
        </div>

        <div class="px-5 pb-8 text-center mt-5">
            <button id="btn-pr-cancel" type="button" data-dismiss="modal"
                class="button w-24 border text-gray-700 mr-1">Cancel</button>
            <button id="btn-pr-edit" type="button" class="button w-24 bg-theme-1 text-white hidden">Edit</button>
            <button id="btn-pr-delete" type="button" class="button w-24 bg-theme-6 text-white hidden">Delete</button>
        </div>
    </div>
</div>
<!-- END: Profile Modal -->
@endsection

@section('script')

<script>
    //** Page Navgation & Filter JS **//
    cash('#input-count').val('10');
    async function renderUsers(isNav = false, page = '1') {
        // Filter Details
        let count = cash('#input-count').val();
        let search = cash('#input-search').val();

        let url = '/users/filter';
        if (isNav) {
            url = '/users/navigate';
        }

        await helper.delay(500)

        axios.post(url, {
            count: count,
            search: search,
            page: page
        }).then(res => {
            cash('#table-data').html(res.data);
            cash('#input-search').val(search);
            cash('#input-count').val(count);
            feather.replace();
        //console.log(res);
        }).catch(err => {
            console.log('Error!!!');
        })
    }

    function delay(callback, ms) {
        var timer = 0;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback.apply(context, args);
            }, ms || 0);
        };
    }

    cash('#input-search').on('keyup', delay(function (e) {
        let search = cash('#input-search').val()
        if (e.keyCode === 13) {
            renderUsers()
        }else {
            renderUsers()
        }
        console.log(search)
    }, 500))

    function filterCount() {
        var count = document.getElementById("input-count");
        console.log(count.value);
        renderUsers();
    }

    function filterPages(page) {
        console.log(page);
        renderUsers(true, page)
    }


    function userProfile(userId) {
        cash('#pr-photo').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
        cash('#pr-name').text('')
        cash('#pr-mail').text('');
        cash('#pr-phone').text('');
        cash('#pr-location').text('');
        cash('#pr-role-gender').text('');
        if (!cash('#btn-pr-edit').hasClass('hidden')) {
            cash('#btn-pr-edit').addClass('hidden')
        }
        if (!cash('#btn-pr-cancel').hasClass('hidden')) {
            cash('#btn-pr-cancel').addClass('hidden')
        }
        cash('#profile-modal').modal('show');
        loadUser(userId)
    }


    cash('#btn-pr-edit').on('click', function (e) {
        cash('#profile-modal').modal('hide');
        let urlString = cash('#url_string').val()
        location.href = "{{url('/users/edit')}}"+ '/' + urlString
    })

    cash('#btn-pr-delete').on('click', function (e) {
        deleteUser()
    })

    // cash('button').on ( 'click', '.view__profile****', event => {
    //     //event.preventDefault();
    //     //console.log(event.target);
    //     //cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').
    //     let userId = event.target.dataset.userId;
    //     location.href = '/users/profile/'+userId
    //     //editUser(userId);
    // })

    async function loadUser(userId) {
        cash('#btn-pr-cancel').html('<i data-loading-icon="oval" data-color="blue" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.get("{{url('/users/profile')}}"+ '/' + userId).then(res => {
        console.log('USER: '+res.data.user.first_name);
        if (res.data.user.id > 0) {
            cash('#url_string').val(res.data.user.url_string);
            cash('#user_id').val(res.data.user.id);
            cash('#pr-name').text(res.data.user.first_name+' '+res.data.user.last_name);
            cash('#pr-mail').text(res.data.user.email);
            cash('#pr-phone').text(res.data.user.phone_number);
            cash('#pr-location').text(res.data.user.location);
            // let perm_array = res.data.user.permissions;
            // let permissions = '';
            // perm_array.forEach(element => {
            //     permissions = permissions + element.name + ', '
            // });
            //cash('#pr-other-contact').text(permissions);
            let roles_array = res.data.user.roles;
            let roles = '';
            roles_array.forEach(element => {
                roles = ((roles == '') ? '' : roles+'/') + element.name
            });
            cash('#pr-role-gender').text(roles+' - '+res.data.user.gender);
            if(res.data.user.photo != null){
                if (res.data.user.photo.includes("/images/")) {
                    cash('#pr-photo').attr('src', res.data.user.photo);
                }else{
                    cash('#pr-photo').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                }
            }else{
                cash('#pr-photo').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            }
        }else {
            cash('#profile-modal').modal('hide');
            alert('Fail to load Crew Member Details')
            console.log("Fail to LOAD!");
        }
        feather.replace();
        cash('#btn-pr-cancel').html('Cancel')
        cash('#btn-pr-delete').removeClass('hidden')
        cash('#btn-pr-edit').removeClass('hidden')
        }).catch(err => {
            cash('#btn-pr-cancel').html('Cancel')
            cash('#profile-modal').modal('hide');
            console.log(err);
        })
    }


    async function deleteUser() {
        cash('#btn-pr-delete').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        cash('#btn-pr-edit').addClass('hidden')
        cash('#btn-pr-cancel').addClass('hidden')
        await helper.delay(1500)
        axios.get("{{url('/users/delete')}}"+ '/' + cash('#user_id').val()).then(res => {
        //console.log(res.data);
        //console.log(res.data.member);
        if (res.data.deleted_member) {
            cash('#table-data').html(res.data.users);
            cash('#profile-modal').modal('hide');
        }else {
            alert('Fail to Delete Crew Member')
            console.log("Fail to LOAD!");
        }
        cash('#btn-pr-delete').html('Delete')
        cash('#btn-pr-edit').removeClass('hidden')
        cash('#btn-pr-cancel').removeClass('hidden')
        feather.replace();
        }).catch(err => {
            cash('#btn-pr-cancel').html('Cancel')
            cash('#btn-pr-delete').html('Delete')
            cash('#btn-pr-edit').removeClass('hidden')
            cash('#btn-pr-cancel').removeClass('hidden')
            console.log(err);
        })
    }
</script>
@endsection
