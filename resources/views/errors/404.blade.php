<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png"
        href="https://cdn-ggljj.nitrocdn.com/NqLCUTuufVSCAUtlxNknLoepQIqQMAzY/assets/static/optimized/rev-310a154/wp-content/uploads/2022/06/favicon-32x32-1.png">

    {{-- <title>{{ config('app.name', 'TechSpotDev TimeTracker') }}</title> --}}
    <title>{{ _('TechSpotDev - Error') }}
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
    <div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
        <div class="w-full xl:w-1/2 relative pb-12 lg:pb-0">
            <div class="relative">
                <div class="absolute">
                    <div>
                        <img src="https://i.ibb.co/G9DC8S0/404-2.png" />
                    </div>
                    <div class="">
                        <h1 class="my-2 text-gray-800 font-bold text-2xl dark:text-white">
                            Looks like you've found the
                            doorway to the great nothing
                        </h1>
                        <p class="my-2 text-gray-800 dark:text-white">Sorry about that! Please visit our hompage to get where you need to go.</p>
                        <div class="mt-5">
                            <a href="{{ url('/') }}" class="sm:w-full lg:w-auto my-2 border rounded md py-4 px-8 text-center bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-opacity-50">Take me there!</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="pt-20">
            <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
        </div>
    </div>
    @livewireScripts
</body>
</html>
