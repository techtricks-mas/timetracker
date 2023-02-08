<aside
    class="scrollbar fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
    aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden"
            sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700"
            href="{{ route('admin.dashboard') }}">
            <img src="https://cdn-ggljj.nitrocdn.com/NqLCUTuufVSCAUtlxNknLoepQIqQMAzY/assets/static/optimized/rev-310a154/wp-content/uploads/2021/12/logo-removebg.png"
                class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
        </a>
    </div>

    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <div class="items-center block w-auto min-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a href="{{ route('admin.dashboard') }}"
                    class="py-2.7 @if ($page == 'dashboard') bg-blue-500/13 dark:text-white dark:opacity-80 text-slate-700 @else dark:text-white dark:opacity-80 @endif text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold transition-colors">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role === 'admin')
                <li class="mt-0.5 w-full">
                    <a href="{{ route('admin.employee') }}"
                        class=" @if ($page == 'employee') bg-blue-500/13 dark:text-white dark:opacity-80 text-slate-700 @else dark:text-white dark:opacity-80 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors">
                        <div
                            class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                            <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Manage Employee</span>
                    </a>
                </li>
            @endif

            {{-- <li class="mt-0.5 w-full">
                <a class=" @if ($page == 'dailywork') bg-blue-500/13 dark:text-white dark:opacity-80 text-slate-700 @else dark:text-white dark:opacity-80 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.dailywork') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Daily Work Update</span>
                </a>
            </li> --}}

            <li class="mt-0.5 w-full">
                <a class=" @if ($page == 'weeklyupdate') bg-blue-500/13 dark:text-white dark:opacity-80 text-slate-700 @else dark:text-white dark:opacity-80 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.weeklyupdate') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Weekly Updates</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" @if ($page == 'interview') bg-blue-500/13 dark:text-white dark:opacity-80 text-slate-700 @else dark:text-white dark:opacity-80 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.interview') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-cyan-500 ni ni-app"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Company Interview</span>
                </a>
            </li>
            <li class="mt-0.5 w-full">
                <a class=" @if ($page == 'candidate_interview') bg-blue-500/13 dark:text-white dark:opacity-80 text-slate-700 @else dark:text-white dark:opacity-80 @endif py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ route('admin.candidate_interview') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-violet-500 ni ni-badge"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Candidate Interview</span>
                </a>
            </li>

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase dark:text-white opacity-60">Account pages
                </h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
                    href="{{ url('/profile') }}">
                    <div
                        class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                        <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
                    </div>
                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Profile</span>
                </a>
            </li>
        </ul>
    </div>

</aside>
