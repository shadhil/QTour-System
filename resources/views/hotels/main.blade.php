@php
$title = $data['title'];
$hotels = $data['hotels'];
@endphp

@extends('../layout/main')

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">List of Hotels</h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" data-toggle="modal" id="add-hotel"
            class="button text-white bg-theme-1 shadow-md mr-2">New Hotel</a>
    </div>
</div>
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <!-- BEGIN: Item List -->
    <div class="intro-y col-span-12">
        <div class="lg:flex intro-y">
            <div class="relative text-gray-700 dark:text-gray-300">
                <input id="input-search" type="text"
                    class="input input--lg w-full lg:w-64 box pr-10 placeholder-theme-13" placeholder="Search item...">
                <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
            </div>
            <select id="input-sort" class="input input--lg box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
                <option>Sort By</option>
                <option>A to Z</option>
                <option>Z to A</option>
                <option>Lowest Price</option>
                <option>Highest Price</option>
            </select>
        </div>
        <div id="table-data" class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t border-theme-5">
            @include('hotels.hotels-table')
        </div>
    </div>
    <!-- END: Item List -->
</div>

<div class="modal" id="hotel-modal">
    <div class="modal__content modal__content--lg">
        <form id="hotel_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="hotel_id" name="hotel_id" value="" />
            <input type="hidden" id="og_photo_name" name="og_photo_name" value="" />
            <input type="hidden" id="og_email" name="og_email" value="" />
            <input type="hidden" id="og_phones" name="og_phones" value="" />
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto modal-title">Hotel Details</h2>
                <div id="photo_layout" class="dropdown">
                    <a class="dropdown-toggle block" href="javascript:;">
                        <div id="img-div"
                            class="w-10 h-10 relative image-fit cursor-pointer zoom-in align-content-end mr-2">
                            <img id="photo_view" class="rounded-md" alt="Hotel Photo"
                                src="{{ asset('dist/images/profile-6.jpg')}}">
                        </div>
                    </a>
                    <div class="dropdown-box w-40">
                        <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                            <a id="remove-photo" href="javascript:;"
                                class="flex items-center p-0 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i data-feather="file" class="w-4 h-4 mr-2"></i> Remove Photo
                            </a>
                        </div>
                    </div>
                </div>
                <div class="cursor-pointer relative align-content-end">
                    <button
                        class="button border items-center text-gray-700 dark:border-dark-5 dark:text-gray-300 hidden sm:flex">
                        <i data-feather="file" class="w-4 h-4 mr-2"></i> Upload Photo
                    </button>
                    <input id="hotel_photo" name="hotel_photo" type="file" accept="image/*"
                        class="w-40 h-full top-0 left-0 absolute opacity-0 cursor-pointer">
                    <input class="hidden" type="text" id="photo_name" name="photo_name" value="">
                </div>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12">
                    <label>Hotel's Name</label>
                    <input id="name" name="name" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Full Name" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Location</label>
                    <input id="location" name="location" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Office or Residence" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Region</label>
                    <select id="region" name="region" class="input w-full border mt-2 flex-1" required>
                        <option>Select a region the park is located</option>
                        @foreach ($data['regions'] as $region)
                        <option value="{{$region->id}}">{{$region->region}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Phone Number(s)</label>
                    <input id="phones" name="phones" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="0729 ...., 0635 ....">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Email</label>
                    <input id="email" name="email" type="email" class="input w-full border mt-2 flex-1"
                        placeholder="company@email.com" required>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Inside a Park?</label>
                    <select id="inside_park" name="inside_park" class="input w-full border mt-2 flex-1">
                        <option>Select a park the hotel is inside</option>
                        @foreach ($data['parks'] as $park)
                        <option value="{{$park->id}}">{{$park->park_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Near Park</label>
                    <select id="near_park" name="near_park" class="input w-full border mt-2 flex-1">
                        <option>Select a park the hotel is near</option>
                        @foreach ($data['parks'] as $park)
                        <option value="{{$park->id}}">{{$park->park_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
                <button type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-send" type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    cash('#input-count').val('20');
    cash("#add-hotel").on('click', function(e){
        cash('#hotel-modal').modal('show');
        cash('.modal-title').text("Add New Hotel");
        cash('#btn-send').val("Save");
        cash('#hotel_form')[0].reset();
        cash('#photo_layout').addClass("hidden");
    });

    async function addUpdateUser() {
        let count = cash('#input-count').val();

        let hotelForm = cash('#hotel_form')[0];
        var formData = new FormData(hotelForm);
        formData.append('count', count);

        cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        cash('#show-error').html('');
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/hotels/new')}}", formData, config).then(res => {
            cash('#btn-send').html('Save')
            if (res.data.success == true) {
                //showSuccessToast(res.data.message);
                cash('#hotel-modal').modal('hide');
                cash('#input-search').val('');
                cash('#input-count').val(count);
                cash('#table-data').html(res.data.updatedHotels);
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

    const hotelForm = cash('#hotel_form')[0];
    hotelForm.onsubmit = event =>{
        console.log("IS IT!");
        if(hotelForm.checkValidity()) {
            addUpdateUser()
            //console.log('SUBMITED!');
        }else console.log("invalid form");
    }

    async function renderHotels(isNav = false, page = '1') {
        // Filter Details
        let count = cash('#input-count').val();
        let search = cash('#input-search').val();

        let url = '/hotels/filter';
        if (isNav) {
            url = '/hotels/navigate';
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
            renderHotels()
        }else {
            renderHotels()
        }
        console.log(search)
    }, 500))

    function filterPages(page) {
        console.log(page);
        renderHotels(true, page)
    }

    function filterCount() {
        var count = document.getElementById("input-count");
        console.log(count.value);
        renderHotels();
    }

    cash("#hotel_photo").on('change', function(e){
        readURL(this);
    });

    cash('#remove-photo').on('click', function (e) {
        if ((cash('#og_photo_name').val()).includes("/images/")) {
            let img_url = cash('#og_photo_name').val();
            cash('#photo_view').attr('src', img_url);
        }else{
            cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            cash('#photo_layout').addClass('hidden')
        }
        cash('#photo_name').val(cash('#og_photo_name').val());
        cash('#hotel_photo').val('');
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
                    cash('#photo_layout').removeClass('hidden')
                }
            }
            reader.readAsDataURL(input.files[0]);
        }else{
            //showToast('error', 'File Too Large');
            cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
            cash('#photo_name').val('');
            cash('#photo_layout').addClass('hidden')
        }
    }

    // cash('a').on ( 'dblclick', '.view__profile', event => {
    //     let hotelId = event.target.dataset.hotelId;
    //     //location.href = '/users/'+hotelId+'/profile'
    //     //editHotel(hotelId);
    // })

    function hotelClick(hotelId) {
        console.log(hotelId);
        location.href = '/hotels/'+hotelId+'/profile'
    }

    async function editHotel(hotelId) {
        cash('#btn-send').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.get("{{url('/hotels/edit')}}"+ '/' + hotelId).then(res => {
        //console.log(res.data);
        //console.log(res.data.member);
        console.log(res.data.hotel.id);
        if (res.data.hotel.id > 0) {
            cash('#hotel-modal').modal('show');
            cash('.modal-title').text("Edit Hotel");
            cash('#btn-send').html('Update')
            cash('#operation').val("editHotel");

            cash('#hotel_id').val(res.data.hotel.id);
            cash('#name').val(res.data.hotel.first_name);
            cash('#email').val(res.data.hotel.email);
            cash('#phones').val(res.data.hotel.phones);
            cash('#og_email').val(res.data.hotel.email);
            cash('#og_phones').val(res.data.hotel.phone);
            cash('#region').val(res.data.hotel.region_id);
            cash('#inside_park').val(res.data.hotel.inside_park_id);
            cash('#near_park').val(res.data.hotel.near_park_id);
            cash('#location').val(res.data.hotel.location);
            if(res.data.hotel.photo != null){
                cash('#og_photo_name').val(res.data.hotel.photo);
                if (res.data.hotel.photo.includes("/images/")) {
                    cash('#photo_view').attr('src', res.data.hotel.photo);
                }else{
                    cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                }
            }else{
                cash('#og_photo_name').val('');
                cash('#photo_view').attr('src', "{{ asset('dist/images/profile-6.jpg')}}");
                cash('#photo_layout').addClass('hidden');
            }
        }else {
            console.log("Fail to LOAD!");
        }
        feather.replace();
        }).catch(err => {
            cash('#btn-send').html('Update')
            console.log(err);
        })
    }

    function toggleFormElements(bDisabled) {
        cash('#first_name').disabled = bDisabled
        cash('#last_name').disabled = bDisabled
        cash('#location').disabled = bDisabled
        cash('#gender').disabled = bDisabled
        cash('#phone_number').disabled = bDisabled
        cash('#email').disabled = bDisabled
        cash('#btnSend').disabled = bDisabled
        cash('#hotel_photo').disabled = bDisabled
    }

    function form_reset() {
        cash('#hotel_form').trigger("reset");
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
