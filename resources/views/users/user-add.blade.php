@php
$user = $data['user'];

$permissions = $data['permissions'];
$perm_selected = $data['user_permissions'];

$roles = $data['roles'];
$role_selected = $data['user_roles'];
$action = "new";
$userPhoto = 'dist/images/profile-6.jpg';
if (!empty($data['user'])) {
$action = "edit";
$userPhoto = $user['photo'] ?? 'dist/images/profile-6.jpg';
}

@endphp
@extends('../layout/main')

@section('content')
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-5 sm:py-10 mt-5">
    <div class="px-5 mt-0">
        <div class="font-medium text-center text-lg">{{$action == 'new' ? 'Setup User Account' : 'Edit User Account'}}
        </div>
        <div class="text-gray-600 text-center mt-2">
            {{$action == 'new' ? 'To start off, please enter your full name, email address and password.' : 'To start off, please enter your full name, email address and
            password.'}} </div>
    </div>
    <div class="px-5 sm:px-20 mt-10 pt-0 border-t border-gray-200 dark:border-dark-5">
        <form id="user_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="user_id" name="user_id" value="{{$user['id'] ?? ''}}" />
            {{-- <input type="hidden" id="og_roles" name="og_roles[]" value="{{''}}" />
            <input type="hidden" id="og_permissions" name="og_permissions[]" value="" /> --}}
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="{{$userPhoto}}" />
            <input type="hidden" id="og_pwd" name="og_pwd" value="{{$user['password'] ?? ''}}" />
            <input type="hidden" id="operation" name="operation" value="{{$action}}" />

            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-100 dark:border-dark-5 rounded-md p-1">
                        <div id="img-div" class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img id="user_photo_view" class="rounded-md" alt="Profile Photo"
                                src="{{ asset($userPhoto)}}">
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
                            value="{{$user['first_name'] ?? ''}}" placeholder="John" required>
                    </div>
                    <div class="col-span-12 input-form mt-3">
                        <label>Last Name</label>
                        <input id="last_name" name="last_name" type="text" class="input w-full border mt-2 flex-1"
                            value="{{$user['last_name'] ?? ''}}" placeholder="Doe" required>
                    </div>
                    <div class="col-span-12  input-form mt-3">
                        <label>Gender</label>
                        <select id="gender" name="gender" data-placeholder="Pick a user gender"
                            class="input w-full border mt-2 flex-1" required>
                            <option value=""> -- User's Gender -- </option>
                            <option value="Female" {{$user['gender'] ?? '' == 'female' ? 'selected' : ''}}>Female
                            </option>
                            <option value="Male" {{$user['gender'] ?? '' == 'male' ? 'selected' : ''}}>Male</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 input-form">
                    <label>Location</label>
                    <input id="location" name="location" type="text" class="input w-full border mt-2 flex-1"
                        value="{{$user['location'] ?? ''}}" placeholder="Office/ Resident" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Phone Number</label>
                    <input id="phone_number" name="phone_number" type="text" class="input w-full border mt-2 flex-1"
                        value="{{$user['phone_number'] ?? ''}}" placeholder="0712 234 567" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Email</label>
                    <input id="email" name="email" type="text" class="input w-full border mt-2 flex-1"
                        value="{{$user['email'] ?? ''}}" placeholder="example@email.com" autocomplete="nope" required>
                </div>
                <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Password</label>
                    <input id="password" name="password" type="password" class="input w-full border mt-2 flex-1"
                        placeholder="Password" autocomplete="new-password" minlength="6"
                        {{ $action == 'edit' ? '' :  'required' }}>
                </div>
                <div id="roleView" class="col-span-12 xl:col-span-6 input-form"><label>Role(s)</label>
                    <select id="roles" name="roles[]" data-placeholder="Select user role"
                        class="tail-select w-full pt-2" multiple required>
                        {{-- @include('layout.components.multi-roles-selector') --}}
                        @foreach ($roles as $role)
                        <option value="{{ $role['id']}}" {{ in_array($role['id'], $role_selected) ? 'selected' : ''}}>
                            {{$role['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="permissionView" class="col-span-12 input-form">
                    <label>Permissions <span class="text-xs text-gray-600">(Option)</span></label>
                    <select id="permissions" name="permissions[]" data-placeholder="Select task permitted to user"
                        data-search="true" class="tail-select w-full" multiple>
                        {{-- @include('layout.components.multi-selector')  --}}
                        @foreach ($permissions as $permission)
                        <option value="{{ $permission['id']}}"
                            {{ in_array($permission['id'], $perm_selected) ? 'selected' : ''}}>{{$permission['name']}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5"></div>
                <button id="btn-cancel" type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-send" name="btn-send" type="submit"
                    class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- END: Wizard Layout -->
<div class="modal" id="success-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Good job!</div>
            <div class="text-gray-600 mt-2">User is added successfully!</div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Ok</button>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    async function addUpdateUser() {

        let userForm = cash('#user_form')[0];
        var formData = new FormData(userForm);

        cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/users/save-user')}}", formData, config).then(res => {
            cash('#btn-send').html('Send')
            if (res.data.success == true) {
                if (cash('#operation').val() == 'new') {
                    userForm.reset()
                    cash('#permissions').val([])
                    cash('#roles').val([])
                    cash('#user_photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                }
                cash('#success-modal').modal('show');
                cash('#show-error').html('');
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


    const userForm = document.getElementById("user_form")
    userForm.onsubmit = event =>{
        if(userForm.checkValidity()) {
            let pwd = cash('#operation').val()
            let ogpwd = cash('#og_pwd').val()
            if (cash('#operation').val() == 'editUser' && (pwd != 'PASSWORD' || pwd != ogpwd)) {
                var r = confirm("You are about to change this user's password, Are you sure?");
                if (r == true) {
                    addUpdateUser()
                } else {
                    cash('#password').val('PASSWORD')
                }
            }else{
                addUpdateUser()
            }
            //console.log('SUBMITED!');
        }else console.log("invalid form");
    }

    cash("#user_photo").on('change', function(e){
        readURL(this);
    });

    cash('#remove-photo').on('click', function (e) {
        if ((cash('#og_photo_name').val()).includes("/images/")) {
            let img_url = cash('#og_photo_name').val();
            cash('#user_photo_view').attr('src', img_url);
        }else{
            cash('#user_photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
        }
        cash('#user_photo_name').val(cash('#og_photo_name').val());
        cash('#user_photo').val('');
        cash('#remove-photo').removeClass('tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2')
        cash('#remove-photo').addClass('xl:hidden')
    })

    function readURL(input) {
        if (input.files && input.files[0]){
            if (input.files[0].size < 2000000){
                var reader=new FileReader();
                reader.onload=function (e){
                //$('#img_area').prepend($(' <img>',{id:'cat_img',src: e.target.result}))
                    cash('#user_photo_view').attr('src', e.target.result);
                    cash('#user_photo_name').val(e.target.result);
                    cash('#remove-photo').removeClass('xl:hidden')
                    cash('#remove-photo').addClass('tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2')
                }
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            //showToast('error', 'File Too Large');
            cash('#user_photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            cash('#user_photo_name').val('');
            //cash('#user_photo_view').val('');
        }
    }



</script>
@endsection
