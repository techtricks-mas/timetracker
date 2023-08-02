@extends('layouts.app')
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
    <link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
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
            <div>
            <input type="date" onchange="dateHandler(this)" value="{{ $currentdate }}" name="dateSearch" name="dateSearch" class="py-2 rounded">
            <a href="{{ route('candidate.addweeklyupdate') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
                    Add Weekly Update
                </a>
            </div>
        </div>
        <div>
            <div class="flex-auto px-0 pt-0 pb-2 mt-10">
                <div class="p-0 overflow-x-auto">
                    <table id="weeklyUpdateTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Important</th>
                                <th>Priorities</th>
                                <th>Concerns</th>
                                <th>Summary</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>
                                    <span class="dark:text-white">{{ strlen($item->employee_id) == 1 ? 'TSW00' . $item->employee_id : (strlen($item->employee_id) == 2 ? 'TSW 0' . $item->employee_id : 'TSD' . $item->employee_id) }}</span>
                                </td>
                                <td>
                                    <span class="dark:text-white">{{ \Carbon\Carbon::parse($item->created_at)->format('M d Y') }}</p></span>
                                </td>
                                <td>
                                    <span class="dark:text-white">{!! $item->employee->fname !!} {!! $item->employee->lname !!}</p></span>
                                </td>
                                <td>
                                    <span class="dark:text-white">{!! strlen($item->done) >= 20 ? substr($item->done, 0, 20). '...' : $item->done !!}</p></span>
                                </td>
                                <td>
                                    <span class="dark:text-white">{!! strlen($item->priorities) >= 20 ? substr($item->priorities, 0, 20). '...' : $item->priorities !!}</p></span>
                                </td>
                                <td>
                                    <span class="dark:text-white">{!! strlen($item->concerns) >= 20 ? substr($item->concerns, 0, 20). '...' : $item->concerns !!}</p></span>
                                </td>
                                <td>
                                    <span class="dark:text-white">{!! strlen($item->summary) >= 20 ? substr($item->summary, 0, 20). '...' : $item->summary !!}</p></span>
                                </td>
                                <td>
                                    <a href="{{ url('admin/weekUpdate') }}/{{ $item->id }}" class="py-1 px-2 bg-blue-500 rounded-1 text-white">
                                        <i class="fa-solid fa-eye"></i>
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
    <script src="{{ url('/') }}/assets/js/jquery.timepicker.min.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery.toaster.js"></script>
    <script src="{{ url('/') }}/assets/js/cute-alert.js"></script>
    <script src="{{ url('/') }}/assets/js/custom.js"></script>
    <script>

        $('.timepicker').timepicker({
            defaultTime: 'value'
        });

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
    <script>
        $(document).ready(function() {
            $('#weeklyUpdateTable').DataTable();
        });
    </script>
@endsection
