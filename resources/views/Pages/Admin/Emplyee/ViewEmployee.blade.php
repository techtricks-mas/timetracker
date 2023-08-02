@extends('layouts.app')
@section('background')
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('CSS')
    <link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
@endsection
@section('title')
    User
@endsection
@section('subTitle')
    User
@endsection
@section('content')
    <div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
        <div class="flex justify-between">
            <h6 class="text-slate-700 text-xl dark:text-white">View User</h6>
        </div>
        <div>
            <form>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="firstName">First Name</label>
                        <input id="firstName" readonly value="{{ $employee->fname }}" type="text"
                            class="@error('firstname') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="firstname" />
                        @error('firstname')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="lastName">Last Name</label>
                        <input id="lastName" readonly value="{{ $employee->lname }}" type="text"
                            class="@error('lastname') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="lastname" />
                        @error('lastname')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="workemail">Work Email</label>
                        <input id="workemail" readonly value="{{ $employee->workemail }}" type="email"
                            class="@error('workemail') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="workemail" />
                        @error('workemail')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="personalemail">Personal Email</label>
                        <input id="persoanlemail" readonly value="{{ $employee->personalemail }}" type="email"
                            class="@error('personalemail') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                            name="personalemail" />
                        @error('personalemail')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block  text-sm" for="country">Country</label>
                        <select
                            class="@error('country') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            disabled name="country">
                            @foreach ($country as $country)
                            <option value="{{ $country->name }}" @if ($employee->country == $country->name) selected @endif>(+{{ $country->phonecode }}) {{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block  text-sm" for="number">Phone Number</label>
                        <input id="number" value="{{ $employee->phone }}" type="number" name="phone" readonly
                            class="@error('phone') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('phone')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="country">Role</label>
                        <select class="px-3 py-2 w-full border-black focus:outline-none dark:bg-slate-850 dark:border-white dark:text-white rounded-2" disabled name="role">
                            <option @if ($employee->role == 'admin') selected @endif value="admin">Admin</option>
                            <option @if ($employee->role == 'employee') selected @endif value="employee">Employee</option>
                            <option @if ($employee->role == 'candidate') selected @endif value="candidate">Interview Candidate</option>
                        </select>
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="country">Work Type</label>
                        <select
                            class="@error('type') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            disabled name="type">
                            <option @if ($employee->type == 'part') selected @endif value="part">Part-Time</option>
                            <option @if ($employee->type == 'full') selected @endif value="full">Full-Time</option>
                            <option @if ($employee->type == 'contract') selected @endif value="contract">Contract</option>
                        </select>
                        @error('type')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                @if ($employee->role == 'candidate')
                <div id="profile-input" class="py-3" style=""; >
                    <label class="block text-sm" for="profile-name">Profile Name: <span class="text-red-500">*</span></label>
                    <input type="text" readonly name="profileInput" type="profileInput" value="{{ $employee->profileName }}"
                        class="dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                    >
                </div>
                @endif
                <div class="py-3">
                    <div class="md:flex">
                        <div class="w-full md:w-1/2 md:mr-2">
                            <label class="block text-sm">Work Start Time</label>
                            <input
                                class="@error('wstart') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white timepicker px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                                readonly name="wstart" value="{{ $employee->wstart }}" />
                            @error('wstart')
                                <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full md:w-1/2 md:ml-2">
                            <label class="block text-sm">Work End Time</label>
                            <input
                                class="@error('wend') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white timepicker px-3 py-2 rounded-2 border border-black focus:outline-none w-full"
                                readonly name="wend" value="{{ $employee->wend }}" />
                            @error('wend')
                                <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="dhours">Daily Hours</label>
                        <input id="dhours" value="{{ $employee->dhours }}" readonly name="dhours" type="number"
                            class="@error('dhours') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('dhours')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="whours">Weekly Hours</label>
                        <input id="whours" name="whours" readonly value="{{ $employee->whours }}" type="number"
                            class="@error('dhours') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('whours')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="jdate">Joining Date</label>
                        <input id="jdate" name="jdate" readonly value="{{ $employee->jdate }}" type="date"
                            class="@error('jdate') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('jdate')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="Status">Status</label>
                        <select
                            class="@error('status') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2"
                            disabled name="status">
                            <option value="1" @if ($employee->status == '1') selected @endif>Active</option>
                            <option value="2" @if ($employee->status == '2') selected @endif>Inactive</option>
                        </select>
                        @error('status')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="py-3">
                    <div class="w-full">
                        <label class="block text-sm" for="designation">Designation</label>
                        <input id="designation" readonly value="{{ $employee->designation }}" name="designation"
                            type="text"
                            class="@error('designation') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('designation')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection