@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Database
@endsection
@section('subTitle')
    Database
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black font-sans font-medium text-xl dark:text-white">Database List</h3>
        <a href="{{ route('admin.addDatabase') }}" class="bg-blue-500 px-5 py-2 text-[14px] text-white rounded-2 cursor-pointer">
            Export
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
                                Name</th>
                            <th
                                class="px-6 dark:text-white py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none  text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Date</th>
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
                                    {{ $loop->iteration }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ $item->name }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                <p class="mb-0 text-xs font-semibold leading-tight  dark:text-white ">
                                    {{ \Carbon\Carbon::parse($item->created_at) }}</p>
                            </td>
                            <td
                                class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent flex justify-end gap-x-5">
                                <a href="{{ route('admin.importDatabase', $item->id) }}" class="py-2.5 px-3 bg-blue-500 rounded-1 text-white">
                                    Import
                                </a>
                                <a data-url="{{ route('admin.deletDatabase', $item->id) }}" onclick="confirm(this)" class="py-2.5 px-3 bg-red-500 rounded-1 text-white cursor-pointer">
                                    Delete
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
                    window.location.href= e.dataset.url
                }
            })
        }
    </script>
@endsection
