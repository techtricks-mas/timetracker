@extends('layouts.app')
@section('background')
<div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
@endsection
@section('CSS')
<link href="{{ url('/') }}/assets/css/jquery.timepicker.min.css" rel="stylesheet" />
@endsection
@section('title')
    Financial
@endsection
@section('subTitle')
View Financial
@endsection
@section('content')
<div class="px-10 bg-white py-5 rounded-3 shadow-lg dark:bg-slate-850 dark:shadow-dark-xl">
    <div class="flex justify-between">
        <h6 class="text-slate-700 text-xl dark:text-white">View Financial</h6>
    </div>
    <div>
        <form method="POST" action="{{ route('admin.updatefinancial') }}" name="form">
            <div class="w-full">
                   <label class="block  text-sm" for="employee">User <span class="text-red-500">*</span></label>
                   <select disabled id="employee_id" name="employee_id"
                       class="@error('employee')  border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 w-full border-black focus:outline-none rounded-2">
                       <option value="">{{ $employee->fname }}  {{ $employee->lname}}</option> 
                    </select>
            </div>
            </div>
               

            <div class="md:flex py-3">
                <div class="w-full md:w-1/2 md:mr-2">
                    <label class="block  text-sm" for="paymentmethod">Payment Method <span class="text-red-500">*</span></label>
                    <input readonly id="paymentmethod" value="{{ $financial->paymentmethod }}" type="text" class="@error('paymentmethod') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" name="paymentmethod"/>
                    @error('paymentmethod')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full md:w-1/2 md:ml-2">
                    <label class="block  text-sm" for="paymentprice">Payment Price <span class="text-red-500">*</span></label>
                    <input readonly id="paymentprice" value="{{ $financial->paymentprice }}" type="text" class="@error('paymentprice') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" name="paymentprice"/>
                    @error('paymentprice')
                        <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @csrf
                <div class="md:flex py-3">
                    <div class="w-full md:w-1/2 md:mr-2">
                        <label class="block text-sm" for="paymentaddress">payment address  <span class="text-red-500">*</span></label>
                        <input readonly id="paymentaddress" name="paymentaddress" type="text" value="{{ $financial->paymentaddress }}"
                            class="@error('paymentaddress') border-red-500 @enderror dark:bg-slate-850 dark:border-white dark:text-white px-3 py-2 rounded-2 border border-black focus:outline-none w-full" />
                        @error('paymentaddress')
                            <p class="alert alert-danger text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="w-full md:w-1/2 md:ml-2">
                        <label class="block text-sm" for="Status">Status <span class="text-red-500">*</span></label>
                        <select disabled value="{{ $financial->status }}" id="status" 
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
                
                <div>
       
            
        </form>
    </div>
</div>
@endsection

