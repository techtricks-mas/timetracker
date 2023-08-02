<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    {{-- <title>{{ config('app.name', 'TechSpotDev TimeTracker') }}</title> --}}
    <title>{{ _('TechSpotDev - ') }}
        @if ($page == 'dashboard')
            Dashboard
        @elseif ($page == 'employee')
            Manage User
        @elseif ($page == 'financial')
            Financial Management
        @elseif ($page == 'dailywork')
            Daily Work Update
        @elseif ($page == 'weeklyupdate')
            Weekly Update
        @elseif ($page == 'interview')
            Manage Company Interview
        @elseif ($page == 'candidate_interview')
            Manage Candidate Interview
        @elseif ($page == 'holidays')
            Holidays
        @elseif ($page == 'login')
            Login
        @elseif ($page == 'database')
            Database
        @elseif ($page == 'server')
            Server
        @elseif ($page == 'profile')
            Profile
        @elseif ($page == 'job')
            Manage Job
        @endif
    </title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ url('/') }}/assets/css/all.min.css" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ url('/') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="{{ url('/') }}/assets/css/custom.css" rel="stylesheet" />
    <!-- DataTables styles -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />

    {{-- CSS YIELD --}}
    @yield('CSS')
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        if (window.localStorage.getItem("dark-mode") === 'true') {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <!-- Styles -->
    @livewireStyles
</head>

<body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500 relative">
    @yield('background')

    <!-- sidenav  -->
    @auth
        <livewire:common.sidenav :page="$page" />
    @endauth
    <main class="relative h-full min-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        @auth
            <!-- Navbar -->
            <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start"
                navbar-main navbar-scroll="false">
                <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                    <nav>
                        <!-- breadcrumb -->
                        <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                            <li class="text-sm leading-normal">
                                <a class="text-white opacity-50" href="javascript:;">Dashboard</a>
                            </li>
                            <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']"
                                aria-current="page">
                                @yield('title', 'Dashboard')
                            </li>
                        </ol>
                        <h6 class="mb-0 font-bold text-white capitalize">@yield('subTitle', 'Dashboard')</h6>
                    </nav>
                    <div class="flex items-center justify-end mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                        <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">
                            <li class="flex items-center relative mr-3">
                                <a href="{{ url('/profile') }}"
                                    class="dd-btn block px-0 py-2 text-sm font-semibold text-white transition-all ease-nav-brand">
                                    <i class="fa fa-user sm:mr-1"></i>
                                    @auth
                                        <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                    @endauth
                                </a>
                            </li>
                            <li class="flex items-center pl-4 xl:hidden mr-3">
                                <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand"
                                    sidenav-trigger>
                                    <div class="w-4.5 overflow-hidden">
                                        <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                        <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                        <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="flex items-center mr-3">
                                <label class="inline-flex relative items-center cursor-pointer">
                                    <input dark-toggle type="checkbox" value="" class="sr-only peer">
                                    <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                    <div
                                        class="absolute text-center w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition peer-checked:translate-x-full peer-checked:bg-black">
                                        <i class="toggleicon fa-regular fa-moon text-black dark:text-white"></i>
                                    </div>
                                </label>
                            </li>
                            <li class="flex items-center mr-3 text-white">
                                <span>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf
                                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            <i class="fa-solid fa-right-from-bracket"></i> {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endauth

        <!-- end Navbar -->
        <div class="mx-10">
            @yield('content')

        </div>
        @stack('modals')
    </main>
    @livewireScripts
</body>
<!-- plugin for charts  -->
<script src="{{ url('/') }}/assets/js/jquery-3.6.1.min.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.validate.min.js"></script>
@yield('TopJS')
<script src="{{ url('/') }}/assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="{{ url('/') }}/assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="{{ url('/') }}/assets/js/dropdown.js" async></script>
<script src="{{ url('/') }}/assets/js/fixed-plugin.js" async></script>
<script src="{{ url('/') }}/assets/js/navbar-sticky.js" async></script>
<script src="{{ url('/') }}/assets/js/sidenav-burger.js" async></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
@yield('JS')

</html>
