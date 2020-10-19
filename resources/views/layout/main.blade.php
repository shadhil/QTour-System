@extends('../layout/base')

@section('head')
<title>Dynamic - Midone - Laravel Admin Dashboard Starter Kit</title>
@endsection

@section('body')

<body class="app">
    @include('../layout/components/mobile-menu')
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <nav class="side-nav">
            <a href="" class="intro-x flex items-center pl-5 pt-4">
                <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset('dist/images/logo.svg')}}">
                <span class="hidden xl:block text-white text-lg ml-3"> <span class="font-medium">QTour</span> App
                </span>
            </a>
            <div class="side-nav__devider my-6"></div>
            <ul>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="side-menu {{ request()->routeIs('dashboard*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                        <div class="side-menu__title"> Dashboard </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reservations.new') }}"
                        class="side-menu {{ request()->routeIs('reservations*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Reservations </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('reservations') }}"
                        class="side-menu {{ request()->routeIs('hotels*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Hotels </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users') }}"
                        class="side-menu {{ request()->routeIs('drivers-crews*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Drivers &amp; Crews </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('users') }}"
                        class="side-menu {{ request()->routeIs('parks*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Parks </div>
                    </a>
                </li>
                <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="{{ route('users') }}"
                        class="side-menu {{ request()->routeIs('users*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Users </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="side-menu {{ request()->routeIs('reports*') ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Reports </div>
                    </a>
                </li>
                <li class="side-nav__devider my-6"></li>
                <li>
                    <a href="side-menu-light-inbox.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> FAQs </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-light-inbox.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                        <div class="side-menu__title"> Contact Us </div>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            @include('../layout/components/top-bar')
            @yield('content')
        </div>
        <!-- END: Content -->
    </div>

    <!-- BEGIN: JS Assets-->
    {{-- <script
        src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script> --}}
    <script src="{{ mix('dist/js/app.js') }}"></script>
    <!-- END: JS Assets-->

    @yield('script')
    @livewireScripts
</body>
@endsection
