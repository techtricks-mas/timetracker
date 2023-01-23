@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Employee
@endsection
@section('subTitle')
Employee List
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black dark:text-white font-sans font-medium text-xl">Employee List</h3>
        <a href="{{ url('/addemployee') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
            Add Employee
        </a>
    </div>
    <div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th
                                class="px-6 py-3 dark:text-white font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                ID</th>
                            <th
                                class="px-6 py-3 dark:text-white font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Full Name</th>
                            <th
                                class="px-6 py-3 dark:text-white pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Work Email</th>
                            <th
                                class="px-6 py-3 dark:text-white font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Phone</th>
                            <th
                                class="px-6 py-3 dark:text-white font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Role</th>
                            <th
                                class="px-6 py-3 dark:text-white font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Status</th>
                            <th
                                class="px-6 py-3 dark:text-white font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Designation</th>
                            <th
                                class="px-6 py-3 dark:text-white font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none  tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                        <tr class="parent">
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white ">
                                    {{ strlen($employee->id) == 1 ? 'TSD00'.$employee->id : (strlen($employee->id) == 2 ? 'TSD0'.$employee->id : 'TSD'.$employee->id) }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $employee->fname }} {{ $employee->lname }}</h6>

                                    </div>
                                </div>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white ">
                                    {{ $employee->workemail }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white ">
                                    {{ $employee->phone }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight dark:text-white ">
                                    {{ $employee->role }}</p>
                            </td>
                            <td
                                class="p-2 text-sm leading-normal align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <select onchange="statusHandler(this, {{ $employee->id }})" class="px-3 py-2 border-0 w-full text-white border-black focus:outline-none rounded-2 @if ($employee->status == 1)
                                    bg-emerald-500
                                    @else
                                    bg-red-600
                                @endif">
                                    <option {{ $employee->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $employee->status == 2 ? 'selected' : '' }} value="2">Inactive</option>
                                </select>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <span
                                    class="text-xs dark:text-white font-semibold leading-tight text-slate-400">{{ $employee->designation }}</span>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent flex justify-evenly">
                                <a href="{{ url('/employee') }}/{{ $employee->id }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ url('/employeeedit') }}/{{ $employee->id }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a data-url="{{ url('/deleteemployee') }}/{{ $employee->id }}" onclick="confirm(this)" class="py-2.5 px-3 bg-red-500 rounded-1 text-white cursor-pointer">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $employees->links() }}
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

        const statusHandler = (elm, id) => {
            const value = elm.value;
            const userId = id;
            const token = document.getElementsByTagName("meta")[0].content;
            $.ajax({
                type: "POST",
                url: "{{ url('/employeeStatus') }}",
                data: {
                    status: value,
                    id: userId,
                    _token: token
                },
                success: function (response) {
                    if (elm.classList.contains('bg-emerald-500')) {
                        elm.classList.remove('bg-emerald-500');
                        elm.classList.add('bg-red-600');
                    }
                    else{
                        elm.classList.remove('bg-red-600');
                        elm.classList.add('bg-emerald-500');
                    }
                    $.toaster(response.message, '', 'danger bg-green-500 py-3 px-2 rounded-2 text-white');
                },
                error: function (error) {
                    $.toaster(error.statusText, '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white');
                }
            });
        }
    </script>
@endsection
