@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Interview
@endsection
@section('subTitle')
    Company Interview
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black font-sans font-medium text-xl dark:text-white">Interview List</h3>
        <div>
            <input type="date" onchange="dateHandler(this)" value="{{ $currentdate }}" name="dateSearch" name="dateSearch" class="py-2 rounded">
            <a href="{{ route('candidate.addinterview') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
                Add Interview
            </a>
        </div>
    </div>
    <div>
        <div class="flex-auto px-0 pt-0 pb-2 mt-10">
            <div class="p-0 overflow-x-auto">
                <table id="interviewTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Candidate Name</th>
                            <th>Profile Name</th>
                            <th>Company</th>
                            <th>Recruiter Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <span>{{ strlen($item->employee_id) == 1 ? 'TSC00'.$item->employee_id : (strlen($item->employee_id) == 2 ? 'TSC0'.$item->employee_id : 'TSC'.$item->employee_id) }}</span>
                            </td>
                            <td>
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</span>
                            </td>
                            <td>
                                <span>{{ $item->name }}</span>
                            </td>
                            <td>
                                <span>{{ $item->employee? $item->employee->profileName: '' }}</span>
                            </td>
                            <td>
                                <span>{{ $item->company }}</span>
                            </td>
                            <td>
                                <span>{{ $item->remail }}</span>
                            </td>
                            <td>
                                <span>{{ $item->role }}</span>
                            </td>
                            <td>
                                <span>{{ $item->status == 'assessment' ? 'Recieved Assessment' : $item->status }}</span>
                            </td>
                            <td>
                                <div class="align-middle bg-transparent whitespace-nowrap flex justify-evenly">
                                    <a href="{{ route('admin.viewinterview', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.interviewedit', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url="{{ route('admin.deletinterview', $item->id) }}" onclick="confirm(this)" class="py-2.5 px-3 bg-red-500 rounded-1 text-white cursor-pointer">
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
        const dateHandler = (date) => {
            const value = date.value;
            if (value == 0) {
                window.location.href = `{{ url('candidate/interview') }}`;
            }
            else{
                window.location.href = `{{ url('candidate/interview') }}/${value}`;
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#interviewTable').DataTable();
        });
    </script>
@endsection
