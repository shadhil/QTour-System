@php
$title = $data['title'];
$hotel = $data['hotel'];
$roomTypes = $data['room_types'];
$roomCategories = $data['room_categories'];
$action = "new";
$hotelPhoto = 'dist/images/profile-6.jpg';
if (!empty($data['hotel'])) {
$action = "edit";
$hotelPhoto = $hotel->photo ?? 'dist/images/profile-6.jpg';
}
@endphp

@extends('../layout/main')

@section('content')
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-10 sm:py-20 mt-5">
    <div id="icon-btn" class="flex justify-center {{ $action == 'new' ? 'hidden' : ''}}">
        <button class="intro-y w-10 h-10 rounded-full button text-white bg-theme-1 mx-2"><i data-feather="home"
                class="w-4 h-4 text-white"></i></button>
        <button class="intro-y w-10 h-10 rounded-full button bg-gray-200 dark:bg-dark-1 text-gray-600 mx-2"><i
                data-feather="list" class="w-4 h-4 text-gray-600"></i></button>
    </div>
    <div id="div-intro" class="px-5 {{ $action == 'new' ? '' : 'mt-5'}}">
        <div id="div_header" class="font-medium text-center text-lg mt-3">Setup Hotel's Details</div>
        <div id="div_sub_header" class="text-gray-600 text-center mt-2">Please don't forget to enter hotel's name,
            location, email address and phone numbers.</div>
    </div>
    <div id="hotel_details" class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="font-medium text-base">General Information</div>
        <form id="hotel_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="hotel_id" name="hotel_id" value="{{ $hotel->id ?? ''}}" />
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="{{$hotel->photo ?? ''}}" /><input
                type="hidden" id="og_rate_doc" name="og_rate_doc" value="{{$hotel->rate_doc ?? ''}}" />
            <input type="hidden" id="operation" name="operation" value="{{$action}}" />
            <div class="grid grid-cols-12 gap-4 row-gap-5 mt-5">
                <div class="col-span-12 xl:col-span-3">
                    <div class="border border-gray-200 dark:border-dark-5 rounded-md p-5">
                        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                            <img id="hotel_photo_view" class="rounded-md" alt="Hotel Photo"
                                src="{{ asset($hotelPhoto) }}">
                            <div id="remove_photo" title="Remove this hotel photo?"
                                class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2 {{ ($hotel->photo ?? '') == '' ? 'hidden' : ''}}">
                                <i data-feather="x" class="w-4 h-4"></i>
                            </div>
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-5">
                            <button type="button" class="button w-full bg-theme-1 text-white cursor-pointer">Change
                                Photo</button>
                            <input id="hotel_photo" name="hotel_photo" type="file" accept="image/*"
                                class="w-full h-full top-0 left-0 absolute opacity-0 cursor-pointer">
                            <input class="hidden opacity-0" type="text" id="hotel_photo_name" name="hotel_photo_name"
                                value="" />
                        </div>
                        <div class="w-40 mx-auto cursor-pointer relative mt-8 content-center cursor-pointer">
                            <a href="javascript:;"
                                class="w-full text-theme-1 block font-normal cursor-pointer flex align-content-center ml-2 cursor-pointer"><i
                                    data-feather="file-text" class="w-4 h-4 mr-1"></i> <u class="cursor-pointer"> Upload
                                    Hotel Rates</u>
                            </a>
                            <input id="rate_doc" name="rate_doc" type="file" accept=".pdf"
                                class="w-full h-full top-0 left-0 absolute opacity-0 cursor-pointer">
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-9 xxl:col-span-9 pl-5 pr-5 pb-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Hotel Name</label>
                        <input id="name" name="name" type="text" class="input w-full border mt-2 flex-1"
                            value="{{$hotel->name ?? ''}}" placeholder="Full Name" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Location</label>
                        <input id="location" name="location" type="text" class="input w-full border mt-2 flex-1"
                            value="{{$hotel->location ?? ''}}" placeholder="Office or Residence" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Region</label>
                        <select id="region" name="region" class="input w-full border mt-2 flex-1" required>
                            <option value="">Select a region the park is located</option>
                            @foreach ($data['regions'] as $region)
                            <option value="{{$region->id}}"
                                {{ ($hotel->region_id ?? '') == $region->id ? 'selected' : ''}}>{{$region->region}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Phone Number(s)</label>
                        <input id="phones" name="phones" type="text" class="input w-full border mt-2 flex-1"
                            value="{{ $hotel->phones ?? '' }}" placeholder="0729 ...., 0635 ....">
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Email</label>
                        <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                            value="{{ $hotel->email ?? '' }}" placeholder="company@email.com" required>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Inside a Park?</label>
                        <select id="inside_park" name="inside_park" class="input w-full border mt-2 flex-1">
                            <option value="">Select a park the hotel is inside</option>
                            @foreach ($data['parks'] as $park)
                            <option value="{{$park->id}}"
                                {{ ($hotel->inside_park_id ?? 'xx') == $park->id ? 'selected' : ''}}>
                                {{$park->park_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6 mt-3">
                        <label>Near Park</label>
                        <select id="near_park" name="near_park" class="input w-full border mt-2 flex-1">
                            <option value="">Select a park the hotel is near</option>
                            @foreach ($data['parks'] as $park)
                            <option value="{{$park->id}}"
                                {{ ($hotel->near_park_id ?? 'xx') == $park->id ? 'selected' : ''}}>
                                {{$park->park_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                        <button id="btn-close-hotel"
                            class="button w-24 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300 {{ $action == 'new' ? '' : 'hidden'}}">Close</button>
                        <button id="btn-save-hotel"
                            class="button w-24 justify-center block bg-theme-1 text-white ml-2">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="hotel_cat_type"
        class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5 {{ $action == 'new' ? 'hidden' : ''}}">
        {{-- <div class="text-lg font-medium text-base">Room Details</div> --}}
        <div class="grid grid-cols-12 gap-6">
            <input type="hidden" id="hotel_id" name="hotel_id" value="{{$hotel->id ?? ''}}" />
            <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
                <div class="xxl:pl-6 grid grid-cols-12 gap-6">
                    <!-- BEGIN: Categories -->
                    <div class="col-span-12 md:col-span-6 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Categories</h2>
                            <a href="javascript:;" data-toggle="modal" data-target="#category-modal"
                                class="ml-auto text-theme-1 dark:text-theme-10 truncate flex items-center">
                                <i data-feather="plus" class="w-4 h-4 mr-1"></i> New Category
                            </a>
                        </div>
                        <div id="category_list" class="mt-5">
                            @include('hotels.room-category')
                        </div>
                    </div>
                    <!-- END: Categories -->
                    <!-- BEGIN: Room Types -->
                    <div class="col-span-12 md:col-span-6 mt-3">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Room Types</h2>
                            <a href="javascript:;" data-toggle="modal" data-target="#type-modal"
                                class="ml-auto text-theme-1 dark:text-theme-10 truncate flex items-center">
                                <i data-feather="plus" class="w-4 h-4 mr-1"></i> New Room
                            </a>
                        </div>
                        <div id="type_list" class="mt-5">
                            @include('hotels.room-type')
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
                        <div class="mt-5 intro-x {{ $action == 'new' ? '' : 'hidden'}}">
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
                                                class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto note-dismiss">Dismiss</button>
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
                                                class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto note-dismiss">Dismiss</button>
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
                                                class="button button--sm border border-gray-300 dark:border-dark-5 text-gray-600 ml-auto note-dismiss">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Important Notes -->

                </div>
            </div>
            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                <button id="btn-close-hotel"
                    class="button w-24 justify-center block bg-gray-200 text-gray-600 dark:bg-dark-1 dark:text-gray-300">Close</button>
            </div>
        </div>
    </div>

</div>
<!-- END: Wizard Layout -->

<div class="modal" id="type-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">New Room Type</h2>
        </div>
        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
            <div class="col-span-12">
                <label>Room Type</label>
                <input id="room_type" name="room_type" type="text" class="input w-full border mt-2 flex-1"
                    placeholder="Type of room in this hotel">
                <input type="hidden" id="room_type_id" name="room_type_id">
            </div>
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
            <button type="button" data-dismiss="modal"
                class="button w-32 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</button>
            <button id="btn-save-type" type="button" class="button w-32 bg-theme-1 text-white">Save</button>
        </div>
    </div>
</div>

<div class="modal" id="category-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">New Room Category</h2>
        </div>
        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
            <div class="col-span-12">
                <label>Room Category</label>
                <input id="room_category" name="room_category" type="text" class="input w-full border mt-2 flex-1"
                    placeholder="Category of rooms in this hotel">
                <input type="hidden" id="room_category_id" name="room_category_id">
            </div>
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
            <button type="button" data-dismiss="modal"
                class="button w-32 border dark:border-dark-5 text-gray-700 dark:text-gray-300 mr-1">Cancel</button>
            <button id="btn-save-category" type="button" class="button w-32 bg-theme-1 text-white">Save</button>
        </div>
    </div>
</div>

<div class="modal" id="success-modal">
    <div class="modal__content">
        <div class="p-5 text-center">
            <i data-feather="check-circle" class="w-16 h-16 text-theme-9 mx-auto mt-3"></i>
            <div class="text-3xl mt-5">Good job!</div>
            <div class="text-gray-600 mt-2">Hotel is added successfully!</div>
        </div>
        <div class="px-5 pb-8 text-center">
            <button type="button" data-dismiss="modal" class="button w-24 bg-theme-1 text-white">Ok</button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    cash("#hotel_photo").on('change', function(e){
        console.log(e.target);
        readURL(this);
    });

    cash('#remove-photo').on('click', function (e) {
        if ((cash('#og_photo_name').val()).includes("/images/")) {
            let img_url = cash('#og_photo_name').val();
            cash('#hotel_photo_view').attr('src', img_url);
        }else{
            cash('#hotel_photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
        }
        cash('#hotel_photo_name').val(cash('#og_photo_name').val());
        cash('#hotel_photo').val('');
        cash('#remove-photo').removeClass('tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2')
        cash('#remove-photo').addClass('xl:hidden')
    })

    function readURL(input) {
        if (input.files && input.files[0]){
            if (input.files[0].size < 2000000){
                var reader=new FileReader();
                reader.onload=function (e){
                //$('#img_area').prepend($(' <img>',{id:'cat_img',src: e.target.result}))
                    cash('#hotel_photo_view').attr('src', e.target.result);
                    cash('#hotel_photo_name').val(e.target.result);
                    cash('#remove-photo').removeClass('xl:hidden')
                    cash('#remove-photo').addClass('tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2')
                }
                reader.readAsDataURL(input.files[0]);
            }else{
                alert('Photo is bigger than 2MB')
            }
        }else{
            //showToast('error', 'File Too Large');
            cash('#hotel_photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            cash('#hotel_photo_name').val('');
            //cash('#hotel_photo_view').val('');
        }
    }


    const hotelForm = cash("#hotel_form")[0]
    hotelForm.onsubmit = event =>{
        if(hotelForm.checkValidity()) {
            addUpdateHotel()
            //console.log('SUBMITED!');
        }else console.log("invalid form");
    }

    async function addUpdateHotel() {
        let hotelForm = cash('#hotel_form')[0];
        var formData = new FormData(hotelForm);

        cash('#btn-save-hotel').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/hotels/save-hotel')}}", formData, config).then(res => {
            cash('#btn-save-hotel').html('Save')
            if (res.data.success == true) {
                if (cash('#operation').val() == 'new') {
                    hotelForm.reset()
                    cash('#hotel_details').addClass('hidden')
                    cash('#hotel_cat_type').removeClass('hidden')
                    console.log('HOTEL ID -> '+res.data.hotel_id);
                    cash('#hotel_id').val(res.data.hotel_id);
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
            cash('#btn-save-hotel').html('Save')
            console.log(err);
        })
    }


    async function addUpdateCategory() {
        cash('#btn-save-category').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.post("{{url('/hotels/save-hotel-category')}}", {
            category_id : cash('#room_category_id').val(),
            category : cash('#room_category').val(),
            hotel_id : cash('#hotel_id').val(),
        }).then(res => {
            cash('#btn-save-category').html('Save')
            if (res.data.success == true) {
                cash('#category_list').html(res.data.categories)
                cash('#category-modal').modal('hide');
                cash('#show-error').html('');
            }else {
                console.log(res.data.message)
                let msgs = res.data.message
                msgs.forEach(element =>
                    cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
            }
            feather.replace();
        }).catch(err => {
            cash('#btn-save-category').html('Save')
            console.log(err);
        })
    }


    async function addUpdateType() {
        cash('#btn-save-type').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.post("{{url('/hotels/save-hotel-type')}}", {
            type_id : cash('#room_type_id').val(),
            type : cash('#room_type').val(),
            hotel_id : cash('#hotel_id').val(),
        }).then(res => {
            cash('#btn-save-type').html('Save')
            if (res.data.success == true) {
                cash('#type_list').html(res.data.types)
                cash('#type-modal').modal('hide');
                cash('#show-error').html('');
            }else {
                console.log(res.data.message)
                let msgs = res.data.message
                msgs.forEach(element =>
                    cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
            }
            feather.replace();
        }).catch(err => {
            cash('#btn-save-type').html('Save')
            console.log(err);
        })
    }

    async function deleteRoomType(typeId, type) {
        await helper.delay(500)
        axios.get("{{url('/hotels/delete-type')}}" + '/' + typeId).then(res => {
        if (res.data.deleted_type) {
            cash('#type_list').html(res.data.types)
            //cash('#activity-rows').html(res.data.rsrv_activities)
            //cash('#day_park_links').html(res.data.day_park_links)
            //cash('#delete-modal').modal('hide');
        }else {
            alert('Fail to Delete')
            console.log(res.data.message)
        }
        //cash('#btn-delete').html('Delete')
        feather.replace();
        }).catch(err => {
            console.log(err);
            //cash('#btn-delete').html('Delete')
        })
    }

    async function deleteRoomCategory(categoryId, category) {
        await helper.delay(500)
        axios.get("{{url('/hotels/delete-category')}}" + '/' + categoryId).then(res => {
        if (res.data.deleted_category) {
            cash('#category_list').html(res.data.categories)
            //cash('#day_park_links').html(res.data.day_park_links)
            //cash('#delete-modal').modal('hide');
        }else {
            alert('Fail to Delete')
            console.log(res.data.message)
        }
        //cash('#btn-delete').html('Delete')
        feather.replace();
        }).catch(err => {
            console.log(err);
            //cash('#btn-delete').html('Delete')
        })
    }


    function editRoomType(id, type) {
        cash('#type-modal').modal('show');
        cash('#room_type').val(type);
        cash('#room_type_id').val(id);
    }


    function editRoomCategory(id, category) {
        cash('#category-modal').modal('show');
        cash('#room_category').val(category);
        cash('#room_category_id').val(id);
    }

    cash('#btn-save-category').on('click', e=>{
        addUpdateCategory()
    })

    cash('#btn-save-type').on('click', e=>{
        addUpdateType()
    })

</script>


@endsection
