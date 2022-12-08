@extends('layouts.app')
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Daily Work
@endsection
@section('subTitle')
    Daily Work List
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg">
        <div class="flex justify-between">
            <h3 class="text-black font-sans font-medium text-xl">Daily Work List</h3>
            <a href="{{ url('/adddailywork') }}"
                class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
                Add Daily Work Update
            </a>
        </div>
        <div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    ID</th>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Full Name</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Date</th>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Project name</th>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Task URL</th>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Status</th>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Spent Hours</th>
                                <th
                                    class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="work">
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-slate-400 ">
                                            {{ strlen($item->employee_id) == 1 ? 'TSD00' . $item->employee_id : (strlen($item->employee_id) == 2 ? 'TSD0' . $item->employee_id : 'TSD' . $item->employee_id) }}
                                        </p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal dark:text-slate-400">
                                                    @if ($item->employee != null)
                                                        {{ $item->employee->fname . ' ' . $item->employee->lname }}
                                                    @endif
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-slate-400 ">
                                            {{ $item->date }}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 text-xs font-semibold leading-tight dark:text-slate-400 ">
                                            {{ $item->project }}</p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <a href="{{ $item->turl }}" target="_blank"
                                            class="mb-0 text-xs font-semibold leading-tight text-blue-400 dark:text-blue-400 ">
                                            {{ $item->turl }}</a>
                                    </td>
                                    <td
                                        class="p-2 text-sm leading-normal align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        @if (Auth::user()->role == 'employee')
                                            <span
                                                class="bg-gradient-to-tl   @if ($item->status == 'active') from-emerald-500 to-teal-400 @elseif($item->status == 'pending') from-amber-500 to-amber-400 @else from-rose-500 to-red-400 @endif px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                {{ $item->status }}
                                            </span>
                                        @endif
                                        @if (Auth::user()->role == 'admin')
                                            <select class="py-0 rounded-1" statusUpdate data-id="{{ $item->id }}">
                                                <option @if ($item->status == 'approved') selected @endif value="approved">
                                                    Approved</option>
                                                <option @if ($item->status == 'pending') selected @endif value="pending">
                                                    Pending</option>
                                                <option @if ($item->status == 'rejected') selected @endif value="rejected">
                                                    Rejected</option>
                                            </select>
                                        @endif
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                        <span
                                            class="text-xs font-semibold leading-tight dark:text-slate-400  text-slate-400">{{ $item->hours }}</span>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent flex justify-evenly">
                                        <a href="{{ url('/dailywork') }}/{{ $item->id }}"
                                            class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ url('/dailyworkedit') }}/{{ $item->id }}"
                                            class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a data-url="{{ url('/deletework') }}/{{ $item->id }}" onclick="confirm(this)"
                                            class="py-2.5 px-3 bg-red-500 rounded-1 text-white">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        function confirm (e) {
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
                        success: function (response) {
                            e.closest('.work').remove();
                            $.toaster(response, '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
                        },
                        error: function (err) {
                            $.toaster(err.statusText, '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white');
                        }
                    });
                }
            })
        }
    </script>
@endsection
