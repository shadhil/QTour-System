@php
$title = $data['title'];
$members = $data['members'];
@endphp

@extends('../layout/main')

@section('content')
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center">
            <a href="javascript:void(0);" class="button inline-block bg-theme-1 text-white" id="add-member">
                New Crew Member
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
<div id="table-data" class="grid grid-cols-12 gap-6 mt-5">
    @include('drivers_crew.members-table')
</div>

<!-- BEGIN: Header & Footer Modal -->
<div class="modal" id="member-modal">
    <div class="modal__content modal__content--lg">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto modal-title">
                Member Profile
            </h2>
            <button id="btn-edit1"
                class="button border items-center text-gray-700 dark:border-dark-5 dark:text-gray-300 hidden sm:flex">
                <i data-feather="edit" class="w-4 h-4 mr-2"></i> Edit </button>
            <div class="dropdown sm:hidden">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal"
                        class="w-5 h-5 text-gray-700 dark:text-gray-600"></i>
                </a>
            </div>
        </div>
        <form id="member_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="member_id" name="member_id" value="" />
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="" />
            <input type="hidden" id="og_email" name="og_email" value="" />
            <input type="hidden" id="og_phone" name="og_phone" value="" />
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 xl:col-span-4">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-1">
                        <div id="img-div" class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img id="photo_view" class="rounded-md" alt="Crew Member Photo"
                                src="{{ asset('dist/images/profile-6.jpg')}}">
                            <div id="remove-photo" title="Remove this profile photo?" class="xl:hidden">
                                <i data-feather="x" class="w-4 h-4"></i> </div>
                        </div>
                        <div class="w-35 mx-auto cursor-pointer relative mt-5">
                            <button type="button" class="button w-full bg-theme-1 text-white">Change Photo</button>
                            <input id="member_photo" name="member_photo" type="file" accept="image/*"
                                class="w-full h-full top-0 left-0 absolute opacity-0 cursor-pointer">
                            <input class="xl:hidden opacity-0" type="text" id="photo_name" name="photo_name" value="" />
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
                        <select id="gender" name="gender" data-placeholder="Pick a gender"
                            class="input w-full border mt-2 flex-1" required>
                            <option value=""> -- Select a Member's Gender -- </option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12  input-form mt-3">
                    <label>Job Title</label>
                    <select id="job_title" name="job_title" data-placeholder="Pick a job title"
                        class="input w-full border mt-2 flex-1" required>
                        <option value=""> -- Select a Job Title -- </option>
                        @foreach ($data['job_titles'] as $job)
                        <option value="{{$job['id']}}">{{$job['job_title']}}</option>
                        @endforeach
                    </select>
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
                        placeholder="example@email.com" autocomplete="nope">
                </div>
                {{-- <div class="col-span-12 xl:col-span-6 input-form">
                    <label>Extra Contact Info</label>
                    <input id="extra_info" name="extra_info" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Extra Info ...">
                </div> --}}
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                </div>
                <button id="btn-cancel" type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-send" name="btn-send" type="submit"
                    class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- BEGIN: Delete Confirmation Modal -->
<div class="modal" id="profile-modal">
    <div class="modal__content">
        <div class="pl-5 pt-5 pr-5 pb-2 text-center">
            <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 image-fit mx-auto mt-2">
                <img id="pr-photo" alt="Crew member Photo" class="rounded-full" src="dist/images/profile-13.jpg">
            </div>
            <div id="pr-name" class="text-black font-medium mt-2">Shadhil Othman</div>
            <div id="pr-role-gender" class="text-gray-600 text-sm italic">Driver Cook - male</div>
            <input id="deleting-id" type="hidden">
            <input id="delete-type" type="hidden">
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
            <div id="pr-other-contact" class="col-span-12 xl:col-span-6 flex items-center truncate mt-2">
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
<!-- END: Delete Confirmation Modal -->
@endsection

@section('script')
<script>
    cash('#input-count').val('20');
    cash("#add-member").on('click', function(e){
        cash('#member-modal').modal('show');
        cash('.modal-title').text("Add New Member");
        cash('#btn-send').val("Save");
        cash('#operation').val("addMember");
        cash('#btn-edit1').hide();
        cash('#btn-edit2').hide();
        cash('#member_form')[0].reset();
    });

    async function addUpdateUser() {
        let count = cash('#input-count').val();

        let userForm = cash('#member_form')[0];
        var formData = new FormData(memberForm);
        formData.append('count', count);

        cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        cash('#show-error').html('');
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/drivers-crew/new')}}", formData, config).then(res => {
            cash('#btn-send').html('Save')
            if (res.data.success == true) {
                //showSuccessToast(res.data.message);
                cash('#member-modal').modal('hide');
                cash('#input-search').val('');
                cash('#input-count').val(count);
                cash('#table-data').html(res.data.updatedMembers);
            }else {
                console.log(res.data.message)
                let msgs = res.data.message
                msgs.forEach(element =>
                cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
            }
            feather.replace();
        }).catch(err => {
            cash('#btn-send').html('Save')
            console.log(err);
        })
    }

    const memberForm = cash('#member_form')[0];
    memberForm.onsubmit = event =>{
        console.log("IS IT!");
        if(memberForm.checkValidity()) {
            addUpdateUser()
            //console.log('SUBMITED!');
        }else console.log("invalid form");
    }

    async function renderUsers(isNav = false, page = '1') {
        // Filter Details
        let count = cash('#input-count').val();
        let search = cash('#input-search').val();

        let url = '/drivers-crew/filter';
        if (isNav) {
            url = '/drivers-crew/navigate';
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
    }

    function filterPages(page) {
        console.log(page);
        renderUsers(true, page)
    }

    function filterCount() {
        var count = document.getElementById("input-count");
        console.log(count.value);
        renderUsers();
    }

    cash("#input-count0").on(' change ', function(e){
        var count = cash("#input-count").val();
        console.log(count);
        renderUsers();
    });

    cash("#member_photo").on('change', function(e){
        readURL(this);
    });

    cash('#remove-photo').on('click', function (e) {
        if ((cash('#og_photo_name').val()).includes("/images/")) {
            let img_url = cash('#og_photo_name').val();
            cash('#photo_view').attr('src', img_url);
        }else{
            cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
        }
        cash('#photo_name').val(cash('#og_photo_name').val());
        cash('#member_photo').val('');
        cash('#remove-photo').removeClass('tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2')
        cash('#remove-photo').addClass('xl:hidden')
    })

    function readURL(input) {
        if (input.files && input.files[0]){
            if (input.files[0].size < 2000000){
                var reader=new FileReader(); reader.onload=function(e){
                    //$('#img_area').prepend($(' <img>',{id:'cat_img',src: e.target.result}))
                    cash('#photo_view').attr('src', e.target.result);
                    cash('#photo_name').val(e.target.result);
                    cash('#remove-photo').removeClass('xl:hidden')
                    cash('#remove-photo').addClass('tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2')
                }
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            //showToast('error', 'File Too Large');
            cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            cash('#photo_name').val('');
            //cash('#photo_view').val('');
        }
    }

    function memberProfile(memberId) {
        cash('#pr-photo').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
        cash('#pr-name').text('')
        cash('#pr-mail').text('');
        cash('#pr-phone').text('');
        cash('#pr-location').text('');
        cash('#pr-role-gender').text('');
        cash('#profile-modal').modal('show');
        editUser(memberId)
    }

    cash('#btn-pr-edit').on('click', function (e) {
        cash('#profile-modal').modal('hide');
        cash('#member-modal').modal('show');
    })

    cash('#btn-pr-delete').on('click', function (e) {
        deleteUser()
    })


    async function editUser(memberId) {
        cash('#btn-pr-cancel').html('<i data-loading-icon="oval" data-color="blue" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.get("{{url('/drivers-crew/edit')}}"+ '/' + memberId).then(res => {
        //console.log(res.data);
        //console.log(res.data.member);
        console.log('IS THIS -> ' + res.data.member.id);
        if (res.data.member.id > 0) {
            //cash('#member-modal').modal('show');
            cash('.modal-title').text("Edit Member");
            cash('#btn-send').html('Update')
            cash('#operation').val("editUser");
            cash('#btn-edit1').show();
            //toggleFormElements(true)
            cash('#member_id').val(res.data.member.id);
            cash('#first_name').val(res.data.member.first_name);
            cash('#last_name').val(res.data.member.last_name);
            cash('#pr-name').text(res.data.member.first_name+' '+res.data.member.last_name)
            cash('#email').val(res.data.member.email);
            cash('#pr-mail').text(res.data.member.email);
            cash('#phone_number').val(res.data.member.phone_number);
            cash('#pr-phone').text(res.data.member.phone_number);
            cash('#og_email').val(res.data.member.email);
            cash('#og_phone').val(res.data.member.phone_number);
            cash('#gender').val(res.data.member.gender);
            cash('#job_title').val(res.data.member.job_title_id);
            cash('#pr-role-gender').text(res.data.member.job_title+' - '+res.data.member.gender);
            //cash('#gender').trigger('change');
            cash('#location').val(res.data.member.location);
            cash('#pr-location').text(res.data.member.location);
            if(res.data.member.photo != null){
                cash('#og_photo_name').val(res.data.member.photo);
                if (res.data.member.photo.includes("/images/")) {
                    cash('#photo_view').attr('src', res.data.member.photo);
                    cash('#pr-photo').attr('src', res.data.member.photo);
                }else{
                    cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                    cash('#pr-photo').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                }
            }else{
                cash('#og_photo_name').val('');
                cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                cash('#pr-photo').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            }
            //cash('#btn-edit1').show();
            //cash('#btn-edit2').show();
        }else {
            cash('#profile-modal').modal('hide');
            alert('Fail to load Crew Member Details')
            console.log("Fail to LOAD!");
        }
        cash('#btn-pr-cancel').html('Cancel')
        cash('#btn-pr-delete').removeClass('hidden')
        cash('#btn-pr-edit').removeClass('hidden')
        feather.replace();
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
        axios.get("{{url('/drivers-crew/delete')}}"+ '/' + cash('#member_id').val()).then(res => {
        //console.log(res.data);
        //console.log(res.data.member);
        if (res.data.deleted_member) {
            cash('#table-data').html(res.data.members);
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

    function form_reset() {
        cash('#member_form').trigger("reset");
        // $('#img_area').removeClass('m-3');
        // $('#img_area').hide();
        // $('#categories').val(null).trigger('change');
        // $('#tags').val(null).trigger('change');
        // $('#post').val('');
        // $('#title').val('');
        // $('#meta_description').val('');
        // $('#show_slug').text('');
        // $('#slug').val('');
        // $('#featured_image_name').val('');
        // $('#post_img').attr('src', "{{ asset('/images/web-img/placeholder.png')}}");
    }

</script>
@endsection
