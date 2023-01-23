@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('CSS')
    <link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
@endsection
@section('title')
    Daily Work
@endsection
@section('subTitle')
    Add Daily Work
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl">Add Daily Work</h6>
        </div>
        <div>
            <form method="POST" action="{{ url('/submitdailywork') }}" name="form">
                <div class="py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <div class="flex justify-between">
                            <label for="toggle" class="text-sm">Did You Connect VPN Today? <span
                                    class="text-red-500">*</span></label>
                            <label class="switch">
                                <input type="checkbox" name="vpn">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        @error('turl')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="firstName">Select Employee <span
                                class="text-red-500">*</span></label>
                        <select
                            class="@error('employee') border-red-500 @enderror px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="employee">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->user->name }}
                                    ({{ strlen($employee->id) == 1 ? 'TSD00' . $employee->id : (strlen($employee->id) == 2 ? 'TSD0' . $employee->id : 'TSD' . $employee->id) }})
                                </option>
                            @endforeach
                        </select>
                        @error('employee')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="date">Date <span class="text-red-500">*</span></label>
                        <input id="date" type="date" disabled value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                            class="@error('date') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('date')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="project">Project name <span
                                class="text-red-500">*</span></label>
                        <input id="project" type="text"
                            class="@error('project') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="project" />
                        @error('project')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="turl">Task URL <span class="text-red-500">*</span></label>
                        <input id="turl" type="text"
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
                        <label class="block  text-sm" for="tdescription">Task Description <span
                                class="text-red-500">*</span></label>
                        <textarea id="tdescription" type="text"
                            class="@error('tdescription') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="tdescription"></textarea>
                        @error('tdescription')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <div>
                            <label for="ip">IP Address</label>
                            <input id="ip" type="text"
                                class="@error('ip') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                                name="ip" />
                            @error('ip')
                                <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit"
                        class="w-1/2 py-2 rounded-2 text-white bg-blue-500 mt-5 submitbutton">Submit</button>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('JS')
    <script src="{{ url('/') }}/assets/js/jquery.timepicker.min.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery.toaster.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery.validate.min.js"></script>
    <script>
        $('.timepicker').timepicker({
            defaultTime: 'value'
        });

        $("form[name='form']").validate({
            errorClass: 'text-red-500',
            rules: {
                employee: "required",
                date: "required",
                project: "required",
                turl: "required",
                tdescription: "required",
                tsdate: "required",
                tedate: "required",
                hours: "required",
            },
            messages: {
                employee: "Select An Employee",
                date: "Date Required",
                project: "Project Name Required",
                turl: "Task Url Required",
                tdescription: "Task Description Required",
                tsdate: "Task Start Date Required",
                tedate: "Task End Date Required",
                hours: "Spent Hours Required",
            },
            invalidHandler: function(form, validator) {
                if (!validator.numberOfInvalids())
                    return;
                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).offset().top
                }, 2000);
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endsection
