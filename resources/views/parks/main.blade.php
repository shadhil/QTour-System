@php
$title = $data['title'];
$parks = $data['parks'];

@endphp

@extends('../layout/main')


@section('content')
<div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
    <div class="col-span-12">
        <div class="intro-y pr-1">
            <div class="box p-2">
                <div class="pos__tabs nav-tabs justify-center flex">
                    <a data-toggle="tab" data-target="#parks" href="javascript:;"
                        class="flex-1 py-2 rounded-md text-center active">Parks</a>
                    <a data-toggle="tab" data-target="#activities" href="javascript:;"
                        class="flex-1 py-2 rounded-md text-center">Activities</a>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-content__pane active" id="parks">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
                    <div class="text-center">
                        <a href="javascript:void(0);" class="button inline-block bg-theme-1 text-white" id="add-park">
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
                <div id="table-data" class="grid grid-cols-12 gap-5 mt-5">
                    @include('parks.parks-table')
                </div>
            </div>
            <div class="tab-content__pane" id="activities">
                <div class="box flex p-5 mt-5">
                    <div class="w-full relative text-gray-700">
                        <input type="text" class="input input--lg w-full bg-gray-200 pr-10 placeholder-theme-13"
                            placeholder="Use coupon code...">
                        <i class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                    <button class="button text-white bg-theme-1 ml-2">Apply</button>
                </div>
                <div class="pos__ticket box p-2 mt-5">
                    @foreach (array_slice($fakers, 0, 5) as $key => $faker)
                    <a href="javascript:;" data-toggle="modal" data-target="#add-item-modal"
                        class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-dark-3 hover:bg-gray-200 dark:hover:bg-dark-1 rounded-md">
                        <div class="pos__ticket__item-name truncate mr-1">{{ $faker['foods'][0]['name'] }}</div>
                        <div class="ml-auto"><i data-feather="trash"
                                class="w-4 h-4 text-gray-600 ml-2 text-theme-1"></i></div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

<!-- BEGIN: Header & Footer Modal -->
<div class="modal" id="park-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto modal-title">
                Park Info
            </h2>
        </div>
        <form id="park_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="park_id" name="park_id" value="" />
            <input type="hidden" id="og_park" name="og_park" value="" />
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 input-form">
                    <label>Park Name</label>
                    <input id="park_name" name="park_name" type="text" class="input w-full border mt-2 flex-1"
                        placeholder="Park Name" required>
                </div>
                <div class="col-span-12 input-form">
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
                <div id="show-error" class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5 hidden">
                </div>
                <button id="btn-cancel" type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-delete" name="btn-delete" type="button"
                    class="button w-20 bg-theme-6 text-white">Delete</button>
                <button id="btn-save" name="btn-save" type="submit"
                    class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    cash("#add-park").on('click', function(e){
        cash('#btn-delete').addClass('hidden')
        cash('#park-modal').modal('show');
        cash('.modal-title').text("Add New Park");
        cash('#btn-save').val("Save");
        cash('#park_form')[0].reset();
    });

    async function addUpdateUser() {

        let parkForm = cash('#park_form')[0];
        var formData = new FormData(parkForm);

        cash('#btn-save').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        cash('#show-error').addClass('hidden');
        cash('#show-error').html('');
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/parks/new')}}", formData, config).then(res => {
            cash('#btn-save').html('Save')
            if (res.data.success == true) {
                //showSuccessToast(res.data.message);
                cash('#park-modal').modal('hide');
                cash('#input-search').val('');
                cash('#table-data').html(res.data.updatedParks);
            }else {
                console.log(res.data.message)
                let msgs = res.data.message
                msgs.forEach(element =>
                cash('#show-error').html('<div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> ' + element + ' </div>'));
                cash('#show-error').removeClass('hidden');
            }
            feather.replace();
        }).catch(err => {
            cash('#btn-save').html('Save')
            console.log(err);
        })
    }

    const parkForm = cash('#park_form')[0];
    parkForm.onsubmit = event =>{
        console.log("IS IT!");
        if(parkForm.checkValidity()) {
            addUpdateUser()
            //console.log('SUBMITED!');
        }else console.log("invalid form");
    }

    async function renderParks(isNav = false, page = '1') {
        // Filter Details
        // let count = cash('#input-count').val();
        let search = cash('#input-search').val();

        let url = '/parks/filter';
        // if (isNav) {
        //     url = '/drivers-crew/navigate';
        // }
        await helper.delay(500)

        axios.post(url, {
        search: search,
        page: page
        }).then(res => {
            cash('#table-data').html(res.data);
            cash('#input-search').val(search);
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
            renderParks()
        }else {
            renderParks()
        }
        console.log(search)
    }, 500))


    function parkEdit(parkId, parkName, parkRegion){
        cash('#park_id').val(parkId);
        cash('#park_name').val(parkName);
        cash('#region').val(parkRegion);

        cash('#btn-save').removeClass('hidden')

        cash('#park-modal').modal('show');
        cash('.modal-title').text("Edit Park");
        cash('#btn-save').html('Update')
        //toggleFormElements(true)
    }


    cash("#btn-delete").on('click', function(e){
        deletePark(cash('#park_id').val())
        cash('#btn-save').addClass('hidden')
        cash('#btn-cancel').addClass('hidden')
    });


    async function deletePark(parkId) {
        cash('#btn-delete').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.get("{{url('/parks/delete')}}" + '/' + parkId).then(res => {
            cash('#btn-save').html('Save')
            if (res.data.deleted_park) {
                cash('#table-data').html(res.data.parks);
                cash('#park-modal').modal('hide');
            }else {
                alert('Fail to Delete Crew Member')
                console.log("Fail to LOAD!");
            }
            cash('#btn-delete').html('Delete')
            cash('#btn-save').removeClass('hidden')
            cash('#btn-cancel').removeClass('hidden')
            feather.replace();
        }).catch(err => {
            cash('#btn-delete').html('Delete')
            cash('#btn-save').removeClass('hidden')
            cash('#btn-cancel').removeClass('hidden')
            console.log(err);
        })
    }


</script>
@endsection
