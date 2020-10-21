@php
$title = $data['title'];
$users = $data['users'];
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
            <a href="javascript:void(0);" class="button inline-block bg-theme-1 text-white" id="add-user">Add
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
            <input type="hidden" id="user_id" name="user_id" value="" />
            <input type="hidden" id="og_roles" name="og_roles[]" value="" />
            <input type="hidden" id="og_permissions" name="og_permissions[]" value="" />
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="" />
            <input type="hidden" id="ogp_data" name="ogp_data" value="" class="xl:hidden opacity-0" />
            <input type="password" value="" class="xl:hidden opacity-0" />

            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-1">
                        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img id="user_photo_view" class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                                src="{{ asset('dist/images/profile-6.jpg')}}">
                            {{-- <div title="Remove this profile photo?"
                                class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                <i data-feather="x" class="w-4 h-4"></i> </div> --}}
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
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Role(s)</label>
                    <select id="roles" name="roles[]" data-placeholder="Select user role"
                        class="tail-select w-full pt-2 flex-1" multiple required>
                        @foreach ($data['roles'] as $role)
                        <option value="{{ $role['id']}}">{{$role['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 input-form">
                    <label>Permissions <span class="text-xs text-gray-600">(Option)</span></label>
                    <select id="permissions" name="permissions[]" data-placeholder="Select task permitted to user"
                        data-search="true" class="tail-select w-full mt-2 " multiple>
                        @foreach ($data['permissions'] as $permission)
                        <option value="{{ $permission['id']}}">{{$permission['name']}}</option>
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
    <!-- END: Header & Footer Modal -->
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

    // function filterName() {
    //     var search = document.getElementById("input-search");
    //     //console.log(search.value);
    //     //renderUsers();
    // }

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
    // (END) Page Navgation & Filter JS //

    // Modal manipulation JS //
    const btnNewUser = document.getElementById("add-user");
    const btnEdit1 = document.getElementById("btn-edit1");
    const btnEdit2 = document.getElementById("btn-edit2");
    const btnCancel = document.getElementById("btn-cancel");
    const btnSend = document.getElementById("btn-send");

    // Non sticky version
    cash("#add-user").on("click", function() {
        Toastify({ text: "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic, consequuntur doloremque eveniet eius eaque dict", duration: 3000, newWindow: true, close: true, gravity: "bottom", position: "left", backgroundColor: "#0e2c88" stopOnFocus: true }).showToast();
    })


    btnNewUser.onclick = event => {
        //showSuccessToast("Imekubaaali!")
        // console.log('Clicked!');
        // //e.preventDefault();
        // cash('#user-modal').modal('show');
        // cash('.modal-title').text("Add User");
        // cash('#send').val("Send");
        // cash('#operation').val("addUser");
        // cash('#contact_uploaded_logo').html('');
        // cash('#img_name0').val('');
        // cash('#roles').val('');
        // cash('#permissions').val('');
    }

    btnEdit1.onclick = event => {
        console.log('Quotation - 1');
        //alert('Clicked');
    }
    btnEdit2.onclick = event => {
        console.log('Quotation - 2!');
    //alert('Clicked');
    }


    const first_name = document.getElementById("first_name")
    const last_name = document.getElementById("last_name")
    const user_location = document.getElementById("location")
    const gender = document.getElementById("gender")
    const phone = document.getElementById("phone")
    const email = document.getElementById("email")
    const passowrd = document.getElementById("passowrd")
    const roles = document.getElementById("roles")
    const permissions = document.getElementById("permissions")
    const userForm = document.getElementById("user_form")

    async function addNewUser() {
        let count = cash('#input-count').val();

        let userForm = cash('#user_form')[0];
        var formData = new FormData(userForm);
        formData.append('count', count);
        formData.append('date', 'date');

        cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/users/new')}}", formData, config).then(res => {
            cash('#btn-send').html('Send')
            if (res.data.success == true) {
                //showSuccessToast(res.data.message);
                cash('#user-modal').modal('hide');
                cash('#input-search').val('');
                cash('#input-count').val(count);
                cash('#table-data').html(res.data.updatedUsers);
            }else {
                console.log(res.data.message)
                let msgs = res.data.message
                msgs.forEach(element =>
                    cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
            }
            feather.replace();
        }).catch(err => {
            cash('#btn-send').html('Send')
            console.log(err);
        })
    }
    //var form = document.querySelector("form");

    // userForm.addEventListener("submit", function (event) {
    //     // This WILL run because the submit event IS cancelable
    //     if (userForm.checkValidity()) {
    //         event.preventDefault();
    //         console.log('SUBMITED!');
    //     }
    // });

    userForm.onsubmit = event =>{
        if(userForm.checkValidity()) {
            console.log('SUBMITED!');
            addNewUser()
        //your form execution code
        }else console.log("invalid form");
    }

    cash("#user_photo").on('change', function(e){
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]){
            if (input.files[0].size < 2000000){
                var reader=new FileReader();
                reader.onload=function (e){
                //$('#img_area').prepend($(' <img>',{id:'cat_img',src: e.target.result}))
                    cash('#user_photo_view').attr('src', e.target.result);
                    cash('#user_photo_name').val(e.target.result);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            //showToast('error', 'File Too Large');
            cash('#user_photo_name').val('');
            cash('#user_photo_view').val('');
        }
    }

    function showSuccessToast(msg) {
        Toastify({ text: msg, duration: 3000, newWindow: true, close: true, gravity: "bottom", position: "left", backgroundColor: "#91C714", stopOnFocus: true}).showToast();
    }


    btnCancel.onclick = event => {
        console.log('Cancel!');
        //alert('Clicked');
    }

    // btnSend.onclick = event => {
    //     //addNewUser();
    // }

    //document.querySelectorAll('.my #awesome selector');
    // cash('a').on ( 'click', '.pagination__link', event => {
    //     //event.preventDefault();
    //     let page = event.target.dataset.pageNum;
    //     console.log(page);
    //     renderUsers(true, page);
    // })

    </script>
    @endsection
