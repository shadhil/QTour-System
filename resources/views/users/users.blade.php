@extends('../layout/main')

@section('content')

<h2 class="intro-y text-lg font-medium mt-10">
    Users Layout
</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="text-center">
            <a href="javascript:;" data-toggle="modal" data-target="#add-user"
                class="button inline-block bg-theme-1 text-white">Add New User</a>
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
<div class="modal" id="add-user">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
            <h2 class="font-medium text-base mr-auto">
                Broadcast Message
            </h2>
            <button
                class="button border items-center text-gray-700 dark:border-dark-5 dark:text-gray-300 hidden sm:flex">
                <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </button>
            <div class="dropdown sm:hidden">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal"
                        class="w-5 h-5 text-gray-700 dark:text-gray-600"></i>
                </a>
                <div class="dropdown-box w-40">
                    <div class="dropdown-box__content box dark:bg-dark-1 p-2">
                        <a href="javascript:;"
                            class="flex items-center p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
            <div class="col-span-12 sm:col-span-6">
                <label>From</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="example@gmail.com">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>To</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="example@gmail.com">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Subject</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Important Meeting">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Has the Words</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Doesn't Have</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Size</label>
                <select class="input w-full border mt-2 flex-1">
                    <option>10</option>
                    <option>25</option>
                    <option>35</option>
                    <option>50</option>
                </select>
            </div>
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200 dark:border-dark-5">
            <button type="button" data-dismiss="modal"
                class="button w-20 border text-gray-700 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
            <button type="button" class="button w-20 bg-theme-1 text-white">Send</button>
        </div>
    </div>
</div>
<!-- END: Header & Footer Modal -->
@endsection

@section('script')

<script>
    cash('#input-count').val('20');
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
        //var page = document.getElementsByClassName("pagination__link");
        console.log(page);
        renderUsers(true, page)
    }


    cash('#input-count0').on('change', function(e) {
        let count = cash('#input-count').val()
        console.log(count)
        renderUsers()
    })

    //document.querySelectorAll('.my #awesome selector');
    // cash('a').on ( 'click', '.pagination__link', event => {
    //     //event.preventDefault();
    //     let page = event.target.dataset.pageNum;
    //     console.log(page);
    //     renderUsers(true, page);
    // })

    cash(function () {
        feather.replace();
        //const axios = require('axios').default;




            cash('#input-search0').on('keyup', function(e) {
                let search = cash('#input-search').val()
                if (e.keyCode === 13) {
                    renderUsers()
                }else if (search.length > 2 || search.length == 0) {
                    renderUsers()
                }
                console.log(search);
            })

            cash('#login-form').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    login()
                }
            })

            cash('#btn-login').on('click', function() {
                login()
            })

            async function login() {
                // Reset state
                //cash('#login-form').find('.input').removeClass('border-theme-6')
                //cash('#login-form').find('.login__input-error').html('')

                // Post form
                let email = cash('#input-email').val()
                let password = cash('#input-password').val()
                let rememberMe = cash('#input-remember-me').val()

                // Loading state
                cash('#btn-login').html('<i data-loading-icon="oval" data-color="white" class="w-5 h-5 mx-auto"></i>').svgLoader()
                await helper.delay(1500)

                axios.post(`sign-in`, {
                    email: email,
                    password: password,
                    remember_me: rememberMe
                }).then(res => {
                    location.href = '/dashboard'
                }).catch(err => {
                    cash('#btn-login').html('Login')
                    if (err.response.data.message != 'Wrong email or password.') {
                        for (const [key, val] of Object.entries(err.response.data.errors)) {
                            cash(`#input-${key}`).addClass('border-theme-6')
                            cash(`#error-${key}`).html(val)
                        }
                    } else {
                        cash(`#input-password`).addClass('border-theme-6')
                        cash(`#error-password`).html(err.response.data.message)
                    }
                })
            }


        })
</script>
@endsection
