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
    View Interview
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl dark:text-white">View Interview</h6>
        </div>
        <div>
            <form>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="firstName">Select Employee <span class="text-red-500">*</span></label>
                        <select value="{{ $data->employee }}"
                            class="@error('employee') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="employee" disabled>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" @if ($data->employee == $employee->id) selected @endif>
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
                        <label class="block  text-sm" for="firstName">Select Candidate Name <span class="text-red-500">*</span></label>
                        <select value="{{ old('candidate') }}" disabled
                            class="@error('candidate') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="candidate">
                            @foreach ($candidates as $candidate)
                                <option @if ( $candidate->user->name == $data->candidate) selected @endif value="{{ $candidate->user->name }}">
                                    {{ $candidate->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('candidate')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="company">Company name <span class="text-red-500">*</span></label>
                        <input id="company" type="text"  value="{{ $data->company }}" disabled
                            class="@error('company') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="company" />
                        @error('company')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="interviewer">Interviewer name <span class="text-red-500">*</span></label>
                        <input id="interviewer" type="text" value="{{ $data->interviewer }}" disabled
                            class="@error('interviewer') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="interviewer" />
                        @error('interviewer')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="role">Role <span class="text-red-500">*</span></label>
                        <input id="role" type="text" value="{{ $data->role }}" disabled
                            class="@error('role') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="role" />
                        @error('role')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="time">Interviewer Timing <span class="text-red-500">*</span></label>
                        <input id="time" type="datetime-local" value="{{ \Carbon\Carbon::parse($data->time)->format('Y-m-d\TH:i') }}" disabled
                            class="@error('time') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="time" />
                        @error('time')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="description">Job Description <span class="text-red-500">*</span></label>
                        <textarea id="description" type="text" disabled
                            class="@error('description') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="description">{{ $data->job }}</textarea>
                        @error('description')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="Url">Url <span class="text-red-500">*</span></label>
                        <input id="Url" name="url" type="text" value="{{ $data->url }}" disabled
                            class="@error('Url') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('Url')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="status">Status <span class="text-red-500">*</span></label>
                        <select disabled
                            class="@error('status') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="status">
                            <option @if ($data->status == 'scheduled') selected @endif value="scheduled" selected>Scheduled</option>
                            <option @if ($data->status == 'done') selected @endif value="done">Done</option>
                            <option @if ($data->status == 'selected') selected @endif value="selected">Selected</option>
                            <option @if ($data->status == 'rejected') selected @endif value="rejected">Rejected</option>
                            <option @if ($data->status == 'assessment') selected @endif value="assessment">Recieved Assessment</option>
                        </select>
                        @error('status')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="reply">Company Reply</label>
                        <input id="reply" name="reply" type="text" value="{{ $data->reply }}" disabled
                            class="@error('reply') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('reply')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="reason">Reason for Rejection </label>
                        <input id="reason" name="reason" type="text" value="{{ $data->reason }}" disabled
                            class="@error('reason') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('reason')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="comment">Additional Comments</label>
                        <textarea id="comment" disabled
                            class="@error('comment') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="comment">{{ $data->comment }}</textarea>
                        @error('comment')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
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
