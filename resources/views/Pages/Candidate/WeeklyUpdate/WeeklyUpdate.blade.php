@extends('layouts.app')
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Weekly Updates
@endsection
@section('subTitle')
    Weekly Update List
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
        <div class="flex justify-between">
            <h3 class="text-black font-sans font-medium text-xl dark:text-white"> Weekly Update List</h3>
            <select class="py-2 rounded" onchange="dateHandler(this)">
                <option value="0">Select Date</option>
                @foreach ($dates as $date)
                    <option {{ $date->date == $currentdate ? 'selected' : '' }} value="{{ str_replace('-', '', $date->date) }}">{{ $date->date }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th
                                    class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    ID</th>
                                <th
                                    class="px-6 dark:text-white py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Date</th>
                                <th
                                    class="px-6 dark:text-white py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Name</th>
                                <th
                                    class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Important</th>
                                <th
                                    class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Priorities</th>
                                <th
                                    class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Concerns</th>
                                <th
                                    class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Summary</th>
                                <th
                                    class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    </th>
                            </tr>
                        </thead>
                        <tbody class="updatedData">
                            @foreach ($data as $item)
                                <tr class="work">
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {{ strlen($item->employee_id) == 1 ? 'TSD00' . $item->employee_id : (strlen($item->employee_id) == 2 ? 'TSD0' . $item->employee_id : 'TSD' . $item->employee_id) }}
                                        </p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {{ \Carbon\Carbon::parse($item->date)->format('M d Y') }}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {!! $item->employee->fname !!} {!! $item->employee->lname !!}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {!! strlen($item->done) >= 20 ? substr($item->done, 0, 20). '...' : $item->done !!}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {!! strlen($item->priorities) >= 20 ? substr($item->priorities, 0, 20). '...' : $item->priorities !!}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {!! strlen($item->concerns) >= 20 ? substr($item->concerns, 0, 20). '...' : $item->concerns !!}</p>
                                    </td>

                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                            {!! strlen($item->summary) >= 20 ? substr($item->summary, 0, 20). '...' : $item->summary !!}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <a href="{{ route('candidate.weekUpdateView', $item->id) }}" class="py-1 px-2 bg-blue-500 rounded-1 text-white">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-5">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('JS')
    <script src="{{ url('/') }}/assets/js/jquery.toaster.js"></script>
    <script src="{{ url('/') }}/assets/js/cute-alert.js"></script>
    <script src="{{ url('/') }}/assets/js/custom.js"></script>
    <script>
        @if (session('message'))
            $.toaster('{{ session('message') }}', '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
        @endif
        @if (session('error'))
            $.toaster('{{ session('message') }}', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white');
        @endif
        function confirm(e) {
            cuteAlert({
                type: "question",
                title: "Are You Sure?",
                message: "You Want To Remove This Data",
                buttonText: "Okay"
            }).then((result) => {
                if (result === 'confirm') {
                    $.ajax({
                        type: "get",
                        url: e.dataset.url,
                        success: function(response) {
                            e.closest('.work').remove();
                            $.toaster(response, '',
                                'danger bg-green-500 py-3 px-2 rounded-2 text-white');
                        },
                        error: function(err) {
                            $.toaster(err.statusText, '',
                                'danger bg-red-500 py-3 px-2 rounded-2 text-white');
                        }
                    });
                }
            })
        }

        const dateHandler = (date) => {
            const value = date.value;
            if (value == 0) {
                window.location.href = `{{ url('candidate/weeklyupdate') }}`;
            }
            else{
                window.location.href = `{{ url('candidate/weeklyupdate') }}/${value}`;
            }
        }
    </script>
@endsection
