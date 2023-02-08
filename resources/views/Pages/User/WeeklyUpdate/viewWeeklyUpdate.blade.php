@extends('layouts.app')
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
            <h6 class="text-slate-700 text-xl dark:text-white">{{ strlen($data->employee_id) == 1 ? 'TSD00' . $data->employee_id : (strlen($data->employee_id) == 2 ? 'TSD0' . $data->employee_id : 'TSD' . $data->employee_id) }}  Weekly Update</h6>
        </div>
        <div class="mt-6">
            <form>
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">What are the important things you got done?</label>
                    <p class="dark:text-white">{!! $data->done !!}</p>
                </div>
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">What are your top priorities?</label>
                    <p class="dark:text-white">{!! $data->priorities !!}</p>
                </div>
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">What concerns should the team be aware of?</label>
                    <p class="dark:text-white">{!! $data->concerns !!}</p>
                </div>
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">Summary</label>
                    <p class="dark:text-white">{!! $data->summary !!}</p>
                </div>
            </form>
        </div>

    </div>
@endsection
