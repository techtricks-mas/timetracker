@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Job
@endsection
@section('subTitle')
    Job List
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black font-sans font-medium text-xl dark:text-white">Job List</h3>
    </div>

    <div class="flex justify-between py-5">
        <!-- Search Input for Employess -->
        <form >
          <input type="text" name="jobSearch" placeholder="Search Job Title" class="bg-gray-200 dark:bg-slate-800 dark:text-white dark:placeholder-white dark:border-transparent dark:focus:ring-0 dark:focus:border-transparent dark:focus:outline-none dark:shadow-none focus:outline-none focus:ring-0 focus:border-transparent focus:shadow-none border-transparent border-0 rounded-2xl px-4 py-2 w-">
          <button class="px-3">
              <i class="fa-solid fa-search"></i>
          </button>
        </form>

        <!-- Search Input to Filter By Status -->
        <form >
            <select name="statusSearch" placeholder="Search By Status">
                <option value="" disabled selected>Search By Status</option>
                <option value="approved">Approved</option>
                <option value="reject">Reject</option>
                <option value="waiting">Waiting for review</option>
            </select> 
            <button type="submit" class="px-3">
                  <i class="fa-solid fa-search"></i>
            </button>
        </form>

        <!-- Search Input to Filter By Date -->
        <form>
            <input type="date" name="dateSearch" name="dateSearch" class="py-2 rounded">
            <button type="submit" class="px-3">
                <i class="fa-solid fa-search"></i>
            </button>
        </form>

        <a href="{{ route('candidate.addjob') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
            Add Job
        </a>
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
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Plateform</th>
                            <th
                                class="px-6 dark:text-white py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Company</th>
                            <th
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Job Title</th>
                            <th
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Job Url</th>
                            <th
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Salary</th>
                            <th
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Comment</th>
                            <th
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Status</th>                            
                            <th
                                class="px-6 dark:text-white py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr class="parent">
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ strlen($item->user_id) == 1 ? 'TSC00'.$item->user_id : (strlen($item->user_id) == 2 ? 'TSC0'.$item->user_id : 'TSC'.$item->user_id) }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal  dark:text-white">{{ $item->plateform }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ $item->company_name }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ $item->title }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ $item->url }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ $item->salary }}</p>
                            </td>                            
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ $item->comment }}</p>
                            </td>
                            <td
                                class="p-2 text-sm leading-normal align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <span
                                    class="bg-gradient-to-tl capitalize @if ($item->status == 'done') from-emerald-500 to-teal-400 @elseif($item->status == 'selected') from-emerald-500 to-teal-400 @elseif($item->status == 'scheduled') from-yellow-500 to-yellow-400  @elseif($item->status == 'rejected') from-rose-500 to-red-400 @else from-yellow-500 to-yellow-400 @endif px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    {{ $item->status == 'assessment' ? 'Recieved Assessment' : $item->status }}
                                </span>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent flex justify-evenly">
                                <a href="{{ route('candidate.viewjob', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('candidate.jobedit', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a data-url="{{ route('candidate.deletjob', $item->id) }}" onclick="confirm(this)" class="py-2.5 px-3 bg-red-500 rounded-1 text-white cursor-pointer">
                                    <i class="fa-solid fa-trash"></i>
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
                            e.closest('.parent').remove();
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
