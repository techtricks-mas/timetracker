@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('title')
Daily Work
@endsection
@section('subTitle')
    View Daily Work
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl">{{ strlen($data->employee_id) == 1 ? 'TSD00' . $data->employee_id : (strlen($data->employee_id) == 2 ? 'TSD0' . $data->employee_id : 'TSD' . $data->employee_id) }}  Daily Work</h6>
        </div>
        <div>
            <form>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="">Employee</label>
                        <input readonly disabled value="{{ strlen($data->employee_id) == 1 ? 'TSD00' . $data->employee_id : (strlen($data->employee_id) == 2 ? 'TSD0' . $data->employee_id : 'TSD' . $data->employee_id) }}" name="date" type="text"
                            class="px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="date">Select Date</label>
                        <input id="date" value="{{ $data->date }}" name="date" type="date" disabled
                            class="@error('date') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                    </div>
                </div>
                <input hidden readonly value="{{ $data->id }}" name="id" />
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="project">Project name</label>
                        <input id="project" value="{{ $data->project }}" type="text" disabled
                            class="@error('project') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="project" />
                        @error('project')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="turl">Task URL</label>
                        <input id="turl" value="{{ $data->turl }}" type="text" disabled
                            class="@error('turl') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="turl" />
                        @error('turl')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @csrf
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="tdescription">Task Description</label>
                        <textarea id="tdescription" type="text" disabled
                            class="@error('tdescription') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="tdescription">{{ $data->tdescription }}</textarea>
                        @error('tdescription')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="tsdate">Task Start date</label>
                        <input id="tsdate" value="{{ $data->tsdate }}" name="tsdate" type="date" disabled
                            class="@error('tsdate') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('tsdate')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="tsdate">Task End date</label>
                        <input id="tedate" value="{{ $data->tedate }}" name="tedate" type="date" disabled
                            class="@error('tedate') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('tedate')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="hours">Spent Hours</label>
                        <input id="hours" name="hours" value="{{ $data->hours }}" type="number" disabled
                            class="@error('hours') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('hours')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </form>
        </div>

    </div>
@endsection
