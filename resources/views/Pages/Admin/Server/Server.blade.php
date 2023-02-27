@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
    Server
@endsection
@section('subTitle')
Server
@endsection
@section('CSS')
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/cute.css">
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h3 class="text-black font-sans font-medium text-xl dark:text-white">Mail Details</h3>
    </div>
    <div>
        <form method="POST" action="{{ route('admin.mail') }}" name="form">
            <div class="md:flex py-3">
                <div class="w-full md:w-1/2 md:mr-2">
                    <label class="block  text-sm" for="mail_transport">Mail Transport <span class="text-red-500">*</span></label>
                    <input id="mail_transport" type="text" value="{{ $data ? $data->mail_transport : '' }}"
                        class="@error('mail_transport') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_transport" />
                    @error('mail_transport')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 md:ml-2">
                    <label class="block  text-sm" for="mail_host">Mail Host <span class="text-red-500">*</span></label>
                    <input id="mail_host" type="text" value="{{ $data ? $data->mail_host : '' }}"
                        class="@error('mail_host') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_host" />
                    @error('mail_host')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="md:flex py-3">
                <div class="w-full md:w-1/2 md:mr-2">
                    <label class="block  text-sm" for="mail_port">Mail Port <span class="text-red-500">*</span></label>
                    <input id="mail_port" type="text" value="{{ $data ? $data->mail_port : '' }}"
                        class="@error('mail_port') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_port" />
                    @error('mail_port')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 md:ml-2">
                    <label class="block  text-sm" for="mail_username">Mail Username <span class="text-red-500">*</span></label>
                    <input id="mail_username" type="text" value="{{ $data ? $data->mail_username : '' }}"
                        class="@error('mail_username') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_username" />
                    @error('mail_username')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @csrf
            <div class="md:flex py-3">
                <div class="w-full md:w-1/2 md:mr-2">
                    <label class="block  text-sm" for="mail_password">Mail Password <span class="text-red-500">*</span></label>
                    <input id="mail_password" type="text" value="{{ $data ? $data->mail_password : '' }}"
                        class="@error('mail_password') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_password" />
                    @error('mail_password')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 md:ml-2">
                    <label class="block  text-sm" for="mail_encryption">Mail Encryption <span class="text-red-500">*</span></label>
                    <input id="mail_encryption" type="text" value="{{ $data ? $data->mail_encryption : '' }}"
                        class="@error('mail_encryption') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_encryption" />
                    @error('mail_encryption')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="md:flex py-3">
                <div class="w-full md:w-1/2 md:mr-2">
                    <label class="block  text-sm" for="mail_from">Mail From <span class="text-red-500">*</span></label>
                    <input id="mail_from" type="email" value="{{ $data ? $data->mail_from : '' }}"
                        class="@error('mail_from') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_from" />
                    @error('mail_from')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 md:ml-2">
                    <label class="block  text-sm" for="mail_from_name">Mail From Name <span class="text-red-500">*</span></label>
                    <input id="mail_from_name" type="text" value="{{ $data ? $data->mail_from_name : '' }}"
                        class="@error('mail_from_name') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                        name="mail_from_name" />
                    @error('mail_from_name')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="w-1/2 py-2 rounded-2 text-white bg-blue-500 mt-5 submitbutton">Update</button>
            </div>
        </form>
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
