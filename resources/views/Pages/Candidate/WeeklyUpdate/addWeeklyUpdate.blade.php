@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
Weekly Updates
@endsection
@section('subTitle')
Add Weekly Update
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl dark:text-white">Weekly Update</h6>
        </div>
        <div class="mt-6">
            <form action="{{ route('candidate.postweeklyupdate') }}" method="POST">
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">What are the important things you got done?</label>
                    <textarea name="done" class="@error('done') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"></textarea>
                    @error('done')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                @csrf
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">What are your top priorities?</label>
                    <textarea name="priorities" class="@error('priorities') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"></textarea>
                    @error('priorities')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <input name="id" value="{{ Auth::user()->id }}" hidden readonly/>
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">What concerns should the team be aware of?</label>
                    <textarea name="concerns" class="@error('concerns') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"></textarea>
                    @error('concerns')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full mt-4">
                    <label class="block font-bold text-xl dark:text-slate-200">Summary</label>
                    <textarea name="summary" class="@error('summary') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"></textarea>
                    @error('summary')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="submit" class="w-1/2 py-2 rounded-2 text-white bg-blue-500 mt-5 submitbutton">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection
