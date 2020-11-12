@php
$hotel = $data['hotel'];
$hotelRates = $data['hotel_rates'];
$roomCategories = $data['room_categories'];
$roomTypes = $data['room_types'];
$mealPlans = $data['meal_plans'];
@endphp

@extends('../layout/main')

@section('content')
<!-- BEGIN: Wizard Layout -->
<div class="intro-y box py-10 sm:py-20 mt-5">
    <div class="flex justify-center">
        <button class="intro-y w-10 h-10 rounded-full button dark:bg-dark-1 text-white bg-theme-1 mx-2"
            data-hotel-id={{$hotel->id}} onclick="goEdit(cash(this).attr('data-hotel-id'))"><i data-feather="edit-3"
                class="w-4 h-4 text-white"></i></button>
    </div>
    <div class="px-5 mt-8">
        <div class="w-40 h-40 relative image-fit cursor-pointer zoom-in mx-auto align-content-center">
            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template"
                src="{{ asset(($hotel->photo ?? 'dist/images/profile-6.jpg')) }}">
        </div>
        <div class="font-medium text-center text-lg mt-3">{{ $hotel->name ?? '' }}</div>
        <div class="text-gray-600 text-center mt-2"> {{ ($hotel->location ?? '') . ', '. ($hotel->region ?? '') }}</div>
    </div>

    <div class="px-5 sm:px-20 mt-10 pt-10 border-t border-gray-200 dark:border-dark-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <button id="new-rates" class="button text-white bg-theme-1 shadow-md mr-2">New Room Rates</button>

            <div class="hidden md:block mx-auto text-gray-600"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <button id="download_rates"
                    class="button w-32 border border-gray-400 dark:border-dark-5 text-gray-600 dark:text-gray-300">Download
                    Rates</button>
            </div>
        </div>
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">ROOM TYPE </th>
                        <th class="text-center whitespace-no-wrap">SEASONS</th>
                        <th class="text-center whitespace-no-wrap">STO RATE</th>
                        <th class="text-center whitespace-no-wrap">RACK RATE</th>
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="rates-rows">
                    @include('hotels.room-rates-table')
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END: Wizard Layout -->

<div class="modal" id="rates-modal">
    <div class="modal__content modal__content--lg">
        <form id="hotel_rates_form" class="validate-form" enctype="multipart/form-data">
            <input type="hidden" id="hotel_id" name="hotel_id" value="{{$hotel->id}}" />
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto modal-title">Hotel's Room Rates</h2>
            </div>
            <div id="activity_section" class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-6 input-form">
                    <label>Category</label>
                    <select id="category" name="category" class="input w-full border mt-2 flex-1 input-form" required>
                        <option value="">Select room category</option>
                        @foreach ($roomCategories as $category)
                        <option value="{{$category->id}}">
                            {{$category->room_category}}
                        </option>
                        @endforeach
                    </select>

                </div>
                <div class="col-span-12 sm:col-span-6 input-form">
                    <label>Room Type</label>
                    <select id="room_type" name="room_type" class="input w-full border mt-2 flex-1 input-form" required>
                        <option value="">Select room type</option>
                        @foreach ($roomTypes as $type)
                        <option value="{{$type->id}}">
                            {{$type->room_type}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 input-form">
                    <label>Meal Plan</label>
                    <select id="meal_plan" name="meal_plan" class="input w-full border mt-2 flex-1 input-form" required>
                        <option value="">Select a meal plan</option>
                        @foreach ($mealPlans as $plan)
                        <option value="{{$plan->id}}">
                            {{$plan->meal_plan}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>High Seson <span id="ea_currency"
                            class="text-xs italic text-blue-600 text-right"></span></label>
                    <div class="relative mt-2 input-form">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            $
                        </div>
                        <input id="hs_sto_rate" name="hs_sto_rate" type="text"
                            class="input px-12 w-full border col-span-4" placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            STO
                        </div>
                    </div>
                    <div class="relative mt-2 input-form">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            $
                        </div>
                        <input id="hs_rack_rate" name="hs_rack_rate" type="text"
                            class="input px-12 w-full border col-span-4" placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            RCK
                        </div>
                    </div>
                    <input type="hidden" id="hs_rate_id" name="hs_rate_id">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>Mid Season<span id="ex_currency"
                            class="text-xs italic text-blue-600 text-right"></span></label>
                    <div class="relative mt-2 input-form">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            $
                        </div>
                        <input id="ms_sto_rate" name="ms_sto_rate" type="text"
                            class="input px-12 w-full border col-span-4 input-form" placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            STO
                        </div>
                    </div>
                    <div class="relative mt-2">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            $
                        </div>
                        <input id="ms_rack_rate" name="ms_rack_rate" type="text"
                            class="input px-12 w-full border col-span-4 input-form" placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            RCK
                        </div>
                    </div>
                    <input type="hidden" id="ms_rate_id" name="ms_rate_id">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label>Low Season<span id="nr_currency"
                            class="text-xs italic text-blue-600 text-right"></span></label>
                    <div class="relative mt-2">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            $
                        </div>
                        <input id="ls_sto_rate" name="ls_sto_rate" type="text"
                            class="input px-12 w-full border col-span-4" placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            STO
                        </div>
                    </div>
                    <div class="relative mt-2">
                        <div
                            class="absolute rounded-l w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            $
                        </div>
                        <input id="ls_rack_rate" name="ls_rack_rate" type="text"
                            class="input px-12 w-full border col-span-4" placeholder="Price">
                        <div
                            class="absolute top-0 right-0 rounded-r w-10 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">
                            RCK
                        </div>
                    </div>
                    <input type="hidden" id="ls_rate_id" name="ls_rate_id">
                </div>
            </div>
            <div class="px-5 py-3 text-right ">
                <div id="show-error" class="px-5 py-3 text-right hidden">
                </div>
                <button id="btn-cancel" type="button" data-dismiss="modal"
                    class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                <button id="btn-delete" type="button" class="button w-20 bg-theme-6 text-white">Delete</button>
                <button id="btn-save" type="submit" class="button w-20 bg-theme-1 text-white">Save</button>
            </div>
        </form>
        <div class="px-5 py-3 text-right ">
            <button id="btn-activity-loading" class="button w-full bg-theme-1 text-white hidden"><i
                    data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i></button>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function goEdit(hotelId){
        location.href = '/hotels/edit/'+hotelId
    }

    cash('#new-rates').on('click', e=>{
        cash('#btn-delete').addClass('hidden')
        cash('#category').val('');
        cash('#room_type').val('');
        cash('#meal_plan').val('');
        cash('#hs_sto_rate').val('');
        cash('#hs_rack_rate').val('');
        cash('#ms_sto_rate').val('');
        cash('#ms_rack_rate').val('');
        cash('#ls_sto_rate').val('');
        cash('#ls_rack_rate').val('');
        cash('#hs_rate_id').val('');
        cash('#ms_rate_id').val('');
        cash('#ls_rate_id').val('');
        cash('#rates-modal').modal('show')
        cash('#hotel_rates_form')[0].reset();
    })


    const ratesForm = cash('#hotel_rates_form')[0];
    ratesForm.onsubmit = event =>{
        console.log("IS IT!");
        if(ratesForm.checkValidity()) {
            addUpdateRates()
            //console.log('SUBMITED!');
        }else console.log("invalid form");
    }


    async function addUpdateRates() {

        let parkForm = cash('#hotel_rates_form')[0];
        var formData = new FormData(parkForm);

        cash('#btn-save').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        cash('#show-error').html('');
        await helper.delay(1500)
        let config = { headers: { 'Content-Type': 'multipart/form-data' } }
        axios.post("{{url('/hotels/save-hotel-rates')}}", formData, config).then(res => {
            cash('#btn-save').html('Save')
            if (res.data.success == true) {
                //showSuccessToast(res.data.message);
                cash('#rates-modal').modal('hide');
                cash('#rates-rows').html(res.data.updatedRates);
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


    function editRates(cat, type, meal, hSto, hRack, mSto, mRack, lSto, lRack,hRateId, mRateId, lRateId){
        cash('#category').val(cat);
        cash('#room_type').val(type);
        cash('#meal_plan').val(meal);
        cash('#hs_sto_rate').val(hSto);
        cash('#hs_rack_rate').val(hRack);
        cash('#ms_sto_rate').val(mSto);
        cash('#ms_rack_rate').val(mRack);
        cash('#ls_sto_rate').val(lSto);
        cash('#ls_rack_rate').val(lRack);
        cash('#hs_rate_id').val(hRateId);
        cash('#ms_rate_id').val(mRateId);
        cash('#ls_rate_id').val(lRateId);

        cash('#btn-delete').removeClass('hidden')

        cash('#rates-modal').modal('show');
        cash('.modal-title').text("Edit Hotel Rates");
        cash('#btn-save').html('Update')
        //toggleFormElements(true)
    }


    cash("#btn-delete").on('click', function(e){
        deleteRates(cash('#hotel_id').val(), cash('#category').val(), cash('#room_type').val(), cash('#meal_plan').val())
        cash('#btn-save').addClass('hidden')
        cash('#btn-cancel').addClass('hidden')
    });

    async function deleteRates(hotelId, categoryId, typeId, mealId) {
        //console.log(parkId+' -> -> '+categoryId);
        cash('#btn-delete').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
        await helper.delay(1500)
        axios.post("{{url('/hotels/delete-hotel-rates')}}",{
            hotel_id: hotelId,
            category_id: categoryId,
            type_id: typeId,
            meal_id: mealId
        }).then(res => {
            cash('#btn-save').html('Save')
            if (res.data.deleted_rates) {
                cash('#rates-rows').html(res.data.updated_rates);
                cash('#rates-modal').modal('hide');
            }else {
                alert('Fail to Delete Activities')
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
