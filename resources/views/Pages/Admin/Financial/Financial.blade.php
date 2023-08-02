@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Financial
@endsection
@section('subTitle')
Finacial List
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black dark:text-white font-sans font-medium text-xl">Financial List</h3>
        <a href="{{ route('admin.addfinancial') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
            Add Financial
        </a>

    </div>
    <div class="flex px-2 py-1  flex-wrap gap-4 mt-6">
    <div class="bg-white  shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none  inline font-medium">Total Record: 
        <span class="border-b-solid text-black dark:text-white font-sans font-semibold">
            {{ $financials->count() < 10 ? '0'.$financials->count() : $financials->count() }}
        </span>
        </p>
        </div>
        <div class="bg-white  shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none  inline font-medium">Total Active: 
        <span class="border-b-solid text-black dark:text-white font-sans font-semibold">
            {{ $financials->where('status', 1)->count() < 10 ? '0'.$financials->where('status', 1)->count() : $financials->where('status', 1)->count() }}
        </span>
        </p>
        </div>
        <div class="bg-white  shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none  inline font-medium">Total Inactive:
        <span class="border-b-solid text-black dark:text-white font-sans font-semibold">
            {{ $financials->where('status', 2)->count() < 10 ? '0'.$financials->where('status', 2)->count() : $financials->where('status', 2)->count() }}

    </div>
</div>
    <div>
        <div class="flex-auto px-0 pt-0 pb-2 mt-10">
            <div class="p-0 overflow-x-auto">
                <table id="financeTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Payment Method</th>
                            <th>Payment Price</th>
                            <th>Payment Address</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($financials as $financial)
                        <tr>
                            <td>
                                <span class="dark:text-white">{{ strlen($financial->id) == 1 ? 'TSF00'.$financial->id : (strlen($financial->id) == 2 ? 'TSF0'.$financial->id : 'TSF'.$financial->id) }}</span>
                            </td>
                            <td>
                                <span class="dark:text-white">{{ $financial->employee? $financial->employee->fname : '' }} {{ $financial->employee? $financial->employee->lname : ''}}</span>
                            </td>
                            <td><span class="dark:text-white">{{ $financial->paymentmethod }}</span></td>
                            <td><span class="dark:text-white">{{ $financial->paymentprice }}</span></td>
                            <td><span class="dark:text-white">{{ $financial->paymentaddress }}</span></td>
                            <td>
                                <select 
                                    onchange="statusHandler(this, {{ $financial->id }})" 
                                    class="px-3 py-2 border-0 w-full text-white border-black focus:outline-none rounded-2 @if ($financial->status == 1) bg-emerald-500 @else bg-red-600 @endif"
                                >
                                    <option {{ $financial->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $financial->status == 2 ? 'selected' : '' }} value="2">Inactive</option>
                                </select>
                            </td>
                            <td>
                                <div class="align-middle bg-transparent whitespace-nowrap flex justify-evenly">
                                    <a href="{{ route('admin.viewfinancial', $financial->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.financialedit', $financial->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url="{{ route('admin.deletefinancial', $financial->id) }}" onclick="confirm(this)" class="py-2.5 px-3 bg-red-500 rounded-1 text-white cursor-pointer">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
            $.toaster('{{ session('error') }}', '', 'danger bg-red-500 py-3 px-2 rounded-2 text-white');
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
                url: "{{ url('admin/financialstatus') }}",
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
    <script>
        $(document).ready(function() {
            $('#financeTable').DataTable();
        });
    </script>
@endsection
