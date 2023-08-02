@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('CSS')
    <link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
@endsection
@section('title')
    Job
@endsection
@section('subTitle')
    Edit Job
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg  dark:bg-slate-850 dark:shadow-dark-xl">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl">Edit Job</h6>
        </div>
        <div>
            <form method="POST" action="{{ route('admin.updatejob') }}" name="form">
                <input value="{{ $data->id }}" name="id" hidden>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="company_name">Company name <span class="text-red-500">*</span></label>
                        <input id="company_name" type="text"  value="{{ $data->company_name }}"
                            class="@error('company_name') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="company_name" />
                        @error('company_name')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="plateform">Plateform <span class="text-red-500">*</span></label>
                        <input id="plateform" type="text" value="{{ $data->plateform }}"
                            class="@error('plateform') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="plateform" />
                        @error('plateform')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="title">Job Title <span class="text-red-500">*</span></label>
                        <input id="title" type="text" value="{{ $data->title }}"
                            class="@error('title') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="title" />
                        @error('title')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="url">Job Url <span class="text-red-500">*</span></label>
                        <input id="url" type="text" value="{{ $data->url }}"
                            class="@error('url') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="url" />
                        @error('url')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @csrf
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                      <label class="block text-sm" for="job_posted_date">Date <span class="text-red-500">*</span></label>
                      <input type="date" 
                              name="job_posted_date" 
                              id="job_posted_date" 
                              class="@error('job_posted_date') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                              value="{{ $data->job_posted_date }}"         
                      />
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="salary">Salary <span class="text-red-500">*</span></label>
                        <input id="salary" type="number" value="{{ $data->salary }}"
                            class="@error('salary') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="salary" />
                        @error('salary')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="status">Status <span class="text-red-500">*</span></label>
                        <select
                            class="@error('status') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="status">
                            <option @if ($data->status == 'approved') selected @endif value="approved">Approved</option>
                            <option @if ($data->status == 'reject') selected @endif value="reject">Reject</option>
                            <option @if ($data->status == 'waiting') selected @endif value="waiting">Waiting for review</option>
                        </select>
                        @error('status')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="comment">Additional Comments</label>
                        <textarea id="comment"
                            class="@error('comment') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="comment">{{ $data->comment }}</textarea>
                        @error('comment')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="w-1/2 py-2 rounded-2 text-white bg-blue-500 mt-5 submitbutton">Submit</button>
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
                    role: "required",
                    remail: "required",
                    rphone: "required",
                },
                messages: {
                    employee: "Select An Employee",
                    candidate: "Select A Candidate",
                    company: "Company Field Required",
                    role: "Role Field Required",
                    remail: "Recruiter Email Required",
                    rphone: "Recruiter Phone Required"
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
