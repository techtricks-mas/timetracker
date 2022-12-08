@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('CSS')
    <link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
@endsection
@section('title')
    Interview
@endsection
@section('subTitle')
    View Candidate Interview
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl">View Candidate Interview</h6>
        </div>
        <div>
            <form>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="name">Candidate name <span class="text-red-500">*</span></label>
                        <input id="name" type="text"  value="{{ $data->name }}" disabled
                            class="px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="name" />
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="email">Candidate email ID <span class="text-red-500">*</span></label>
                        <input id="email" type="email"  value="{{ $data->email }}" disabled
                            class="px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="email" />
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="role">Role <span class="text-red-500">*</span></label>
                        <input id="role" type="text"  value="{{ $data->role }}" disabled
                            class="@error('role') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="role" />
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="time">Interviewer Timing <span class="text-red-500">*</span></label>
                        <input id="time" type="datetime-local" value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d\TH:i') }}" disabled
                            class="@error('time') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="time" />
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="description">Job Description <span class="text-red-500">*</span></label>
                        <textarea id="description" type="text" disabled
                            class="@error('description') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="description">{{ $data->description }}</textarea>
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="url">URL <span class="text-red-500">*</span></label>
                        <input id="url" type="text" value="{{ $data->url }}" disabled
                            class="@error('url') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="url" />
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="status">Status <span class="text-red-500">*</span></label>
                        <select value="{{ $data->status }}" disabled
                            class="px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="status">
                            <option value="done">Done</option>
                            <option value="selected">Selected</option>
                            <option value="rejected">Rejected</option>
                            <option value="assign">Assign to JAKE</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="reason">Reason for Rejection </label>
                        <input id="reason" name="reason" type="text" value="{{ $data->reason }}" disabled
                            class="@error('reason') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                    </div>

                </div>
                <div class="flex py-3">
                    <div class="w-full">
                        <label class="block  text-sm" for="comment">Additional Comments</label>
                        <textarea id="comment" disabled
                            class="@error('comment') border-red-500 @enderror px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="comment">{{ $data->comment }}</textarea>
                    </div>
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
                    candidate: "required",
                    company: "required",
                    interviewer: "required",
                    role: "required",
                    time: "required",
                    description: "required",
                    url: "required",
                },
                messages: {
                    employee: "Select An Employee",
                    candidate: "Select A Candidate",
                    company: "Company Field Required",
                    interviewer: "Interviewer Field Required",
                    role: "Role Field Required",
                    time: "Interview Timing Required",
                    description: "Job Description Required",
                    url: "URL Field Required",
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
