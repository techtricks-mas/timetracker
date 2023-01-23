@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('CSS')
    <link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
@endsection
@section('title')
    Employee
@endsection
@section('subTitle')
    Add Employee
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl dark:text-white">Add Employee</h6>
        </div>
        <div>
            <form method="POST" action="{{ route('admin.addemployee') }}" name="form">
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="firstName">First Name <span class="text-red-500">*</span></label>
                        <input id="firstName" type="text" value="{{ old('firstname') }}"
                            class="@error('firstname') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="firstname" />
                        @error('firstname')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="lastName">Last Name <span class="text-red-500">*</span></label>
                        <input id="lastName" type="text" value="{{ old('lastname') }}"
                            class="@error('lastname') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="lastname" />
                        @error('lastname')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="workemail">Work Email <span class="text-red-500">*</span></label>
                        <input id="workemail" type="email" value="{{ old('workemail') }}"
                            class="@error('workemail') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="workemail" />
                        @error('workemail')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="personalemail">Personal Email <span class="text-red-500">*</span></label>
                        <input id="persoanlemail" type="email" value="{{ old('personalemail') }}"
                            class="@error('personalemail') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="personalemail" />
                        @error('personalemail')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @csrf
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="country">Country <span class="text-red-500">*</span></label>
                        <select value="{{ old('country') }}"
                            class="@error('country') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="country">
                            @foreach ($country as $country)
                                <option value="{{ $country->name }}">(+{{ $country->phonecode }}) {{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="number">Phone Number <span class="text-red-500">*</span></label>
                        <input id="number" type="number" name="phone" value="{{ old('phone') }}"
                            class="@error('phone') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('phone')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="country">Role <span class="text-red-500">*</span></label>
                        <select class="px-3 py-2 w-full border-black dark:bg-slate-850 dark:border-white dark:text-white focus:outline-none rounded-2" name="role" value="{{ old('role') }}">
                            <option value="admin">Admin</option>
                            <option value="employee">Employee</option>
                            <option value="candidate">Interview Candidate</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="country">Work Type <span class="text-red-500">*</span></label>
                        <select value="{{ old('type') }}"
                            class="@error('type') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="type">
                            <option value="part">Part-Time</option>
                            <option value="full">Full-Time</option>
                            <option value="contract">Contract</option>
                        </select>
                        @error('type')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="py-3">
                    <div class="md:flex">
                        <div class="w-full md:w-1/2 md:mr-2">
                            <label class="block text-sm">Work Start Time <span class="text-red-500">*</span></label>
                            <input value="{{ old('wstart') }}"
                                class="@error('wstart') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white timepicker px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                                name="wstart"/>
                            @error('wstart')
                                <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 md:ml-2">
                            <label class="block text-sm">Work End Time <span class="text-red-500">*</span></label>
                            <input value="{{ old('wend') }}"
                                class="@error('wend') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white timepicker px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                                name="wend"/>
                            @error('wend')
                                <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="dhours">Daily Hours <span class="text-red-500">*</span></label>
                        <input id="dhours" name="dhours" type="number" value="{{ old('dhours') }}"
                            class="@error('dhours') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('dhours')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="whours">Weekly Hours <span class="text-red-500">*</span></label>
                        <input id="whours" name="whours" type="number" value="{{ old('whours') }}"
                            class="@error('whours') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('whours')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="password">Password <span class="text-red-500">*</span></label>
                        <input id="password" type="password" name="password" value="{{ old('cpassword') }}"
                            class="@error('dhours') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('password')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="cpassword">Confirm Password <span class="text-red-500">*</span></label>
                        <input id="cpassword" type="password" name="cpassword" value="{{ old('cpassword') }}"
                            class="@error('cpassword') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('cpassword')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="jdate">Joining Date <span class="text-red-500">*</span></label>
                        <input id="jdate" name="jdate" type="date" value="{{ old('jdate') }}"
                            class="@error('jdate') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('jdate')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="Status">Status <span class="text-red-500">*</span></label>
                        <select value="{{ old('status') }}"
                            class="@error('status') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            name="status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                        @error('status')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="py-3">
                    <div class="w-full">
                        <label class="block text-sm" for="designation">Designation <span class="text-red-500">*</span></label>
                        <input id="designation" name="designation" type="text" value="{{ old('designation') }}"
                            class="@error('designation') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('designation')
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
                firstname: "required",
                lastname: "required",
                workemail: "required",
                personalemail: "required",
                country: "required",
                phone: "required",
                role: "required",
                type: "required",
                wstart: "required",
                wend: "required",
                dhours: "required",
                whours: "required",
                password: "required",
                cpassword: "required",
                designation: "required",
                jdate: "required",
                status: "required",
            },
            messages: {
                firstname: "First Name Required",
                lastname: "Last Name Required",
                workemail: "Work Email Required",
                personalemail: "Personal Email Required",
                country: "Country Required",
                phone: "Mobile Number Required",
                role: "Employee role Required",
                type: "Employee Type Required",
                wstart: "Work Start Time Required",
                wend: "Work End Time Required",
                dhours: "Daily Work Hours Required",
                whours: "Weekly Work Hours Required",
                password: "Password Required",
                cpassword: "Confirm Password Required",
                designation: "Designation Required",
                jdate: "Joining Date Required",
                status: "Status Required",
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
