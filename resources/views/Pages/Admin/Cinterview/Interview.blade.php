@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Interview
@endsection
@section('subTitle')
    Candidate Interview List
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black font-sans font-medium text-xl dark:text-white">Interview List</h3>

        <!-- Search Input to Filter By Status -->
        <form >
            <select name="statusSearch" placeholder="Search By Status">
                <option value="" disabled selected>Search By Status</option>
                <option value="done">Done</option>
                <option value="selected">Selected</option>
                <option value="rejected">Rejected</option>
                <option value="assign">Assign to JAKE</option>
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

        <a href="{{ route('admin.addcandidateinterview') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
            Add Interview
        </a>
    </div>

    <div class="flex px-2 py-1 justify-between flex-wrap gap-4 mt-6">
        <div class="bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none w-1/2 inline font-medium">Total Record:
            <span class="font-bold">{{ $data->count() < 10 ? '0'.$data->count() : $data->count() }}</span>
       
        </p>
        </div>
        <div class="bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none w-1/2 inline font-medium"> Total Assign to Jake:
            <span class="font-bold">{{ $data->where('status', 'assign')->count() < 10 ? '0'.$data->where('status', 'assign')->count() : $data->where('status', 'assign')->count() }}</span>
        </p>
        </div>
        <div class="bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none w-1/2 inline font-medium"> Total Done:
            <span class="font-bold">{{ $data->where('status', 'done')->count() < 10 ? '0'.$data->where('status', 'done')->count() : $data->where('status', 'done')->count() }}</span>
        </p>
        </div>
        <div class="bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none w-1/2 inline font-medium"> Total Selected:
            <span class="font-bold">{{ $data->where('status', 'selected')->count() < 10 ? '0'.$data->where('status', 'selected')->count() : $data->where('status', 'selected')->count() }}</span>
        </p>
        </div>
        <div class="bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-xl bg-clip-border px-6 py-2">
        <p class="flex-none w-1/2 inline font-medium"> Total Rejected:
            <span class="font-bold">{{ $data->where('status', 'rejected')->count() < 10 ? '0'.$data->where('status', 'rejected')->count() : $data->where('status', 'rejected')->count() }}</span>
        </p>
        </div>
    </div>


    <div>
        <div class="flex-auto px-0 pt-0 pb-2 mt-10">
            <div class="p-0 overflow-x-auto">
                <table id="interviewTable" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Candidate Name</th>
                            <th>Date</th>
                            <th>Candidate Email</th>
                            <th>Role</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                        <tr>
                            <td>
                                <span>{{$item->name}}</span>
                            </td>
                            <td>
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</span>
                            </td>
                            <td>
                                <span>{{ $item->email }}</span>
                            </td>
                            <td>
                                <span>{{ $item->role }}</span>
                            </td>
                            <td>
                                <span>{{ $item->time }}</span>
                            </td>
                            <td>
                                <span>{{ $item->status == 'assign' ? 'Assign to JAKE' : $item->status }}</span>
                            </td>
                            <td>
                                <div class="align-middle bg-transparent whitespace-nowrap flex justify-evenly">
                                    <a href="{{ route('admin.viewcandidateinterview', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.editcandidateinterview', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a data-url="{{ route('admin.deletecandidateinterview', $item->id) }}" onclick="confirm(this)" class="py-2.5 px-3 bg-red-500 rounded-1 text-white cursor-pointer">
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
    </script>
    <script>
        $(document).ready(function() {
            $('#interviewTable').DataTable();
        });
    </script>
@endsection
