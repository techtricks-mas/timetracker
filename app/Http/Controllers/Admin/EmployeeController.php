<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Country;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function addemployee()
    {
        $page = 'employee';
        $country = Country::all();
        return view('Pages.Admin.Emplyee.AddEmployee', compact('country', 'page'));
    }

    public function employee()
    {
        $page = 'employee';
        $employees = Employee::paginate(15);
        return view('Pages.Admin.Emplyee.Employee', compact('employees', 'page'));
    }

    public function viewemployee($id)
    {
        $page = 'employee';
        $country = Country::all();
        $employee = Employee::where('id', $id)->first();
        return view('Pages.Admin.Emplyee.ViewEmployee', compact('employee', 'page', 'country'));
    }

    public function submitemployee(Request $request)
    {
        // Validate Employee Fields
        $request->validate(
            [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'workemail' => 'required|email|unique:employees|unique:users,email',
                'personalemail' => 'required|email|unique:employees',
                'country' => 'required|string',
                'phone' => 'required|string',
                'role' => 'required|string',
                'type' => 'required|string',
                'wstart' => 'required|string',
                'wend' => 'required|string',
                'dhours' => 'required|string',
                'whours' => 'required|string',
                'password' => 'required',
                'cpassword' => 'required|same:password',
                'designation' => 'required|string',
                'jdate' => 'required|string',
                'status' => 'required|string',
            ],
            [
                'firstname.required' => 'First Name Required',
                'lastname.required' => 'Last Name Required',
                'workemail.required' => 'Work Email Required',
                'workemail.email' => 'Work Email should be valid',
                'workemail.unique' => 'Work Email already exist',
                'personalemail.required' => 'Personal Email Required',
                'personalemail.email' => 'Personal Email should be valid',
                'personalemail.unique' => 'Personal Email already exist',
                'country.required' => 'Country Required',
                'phone.required' => 'Mobile Number Required',
                'role.required' => 'Employee role Required',
                'type.required' => 'Employee Type Required',
                'wstart.required' => 'Work Start Time Required',
                'wend.required' => 'Work End Time Required',
                'dhours.required' => 'Daily Work Hours Required',
                'whours.required' => 'Weekly Work Hours Required',
                'password.required' => 'Password Required',
                'cpassword.required' => 'Password Required',
                'cpassword.same' => 'Confirm Password Didn\'t Matched',
                'designation.required' => 'Designation Required',
                'jdate.required' => 'Joining Date Required',
                'status.required' => 'Status Required',
            ]
        );
        // Add on User table
        $user = User::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->workemail,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        Employee::insert([
            'user_id' => $user->id,
            'fname' => $request->firstname,
            'lname' => $request->lastname,
            'workemail' => $request->workemail,
            'personalemail' => $request->personalemail,
            'country' => $request->country,
            'phone' => $request->phone,
            'role' => $request->role,
            'type' => $request->type,
            'wstart' => $request->wstart,
            'wend' => $request->wend,
            'dhours' => $request->dhours,
            'whours' => $request->whours,
            'jdate' => $request->jdate,
            'designation' => $request->designation,
            'status' => $request->status,
            'created_at' => Carbon::now(),
        ]);
        $testMailData = [
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->workemail,
            'password' => $request->password
        ];

        Mail::to($request->personalemail)->send(new SendMail($testMailData));
        return redirect()->route('admin.employee')->with('message', 'Employee Inserted Successfully');
    }

    public function employeeedit($id)
    {
        $page = 'employee';
        $country = Country::all();
        $employee = Employee::where('id', $id)->first();
        return view('Pages.Admin.Emplyee.EditEmployee', compact('employee', 'page', 'country'));
    }

    public function employeeStatus(Request $request)
    {
        Employee::findOrFail($request->id)->update([
            'status' => $request->status,
            'Updated_at' => Carbon::now(),
        ]);
        return response()->json(['message' => 'Updated successfully.'], 200);
    }

    public function updateemployee(Request $request)
    {
        $employee_data = Employee::where('id', $request->id)->first();
        $request->validate(
            [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'workemail' => 'required|email|unique:employees,workemail,' . $employee_data->id . '|unique:users,email,' . $employee_data->user_id,
                'personalemail' => 'required|email|unique:employees,personalemail,' . $employee_data->id,
                'country' => 'required|string',
                'phone' => 'required|string',
                'role' => 'required|string',
                'type' => 'required|string',
                'wstart' => 'required|string',
                'wend' => 'required|string',
                'dhours' => 'required|string',
                'whours' => 'required|string',
                'designation' => 'required|string',
                'jdate' => 'required|string',
                'status' => 'required|string',
            ],
            [
                'firstname.required' => 'First Name Required',
                'lastname.required' => 'Last Name Required',
                'workemail.required' => 'Work Email Required',
                'workemail.email' => 'Work Email should be valid',
                'workemail.unique' => 'Work Email already exist',
                'personalemail.required' => 'Work Email Required',
                'personalemail.email' => 'Work Email should be valid',
                'personalemail.unique' => 'Work Email already exist',
                'country.required' => 'Country Required',
                'phone.required' => 'Mobile Number Required',
                'role.required' => 'Employee role Required',
                'type.required' => 'Employee Type Required',
                'wstart.required' => 'Work Start Time Required',
                'wend.required' => 'Work End Time Required',
                'dhours.required' => 'Daily Work Hours Required',
                'whours.required' => 'Weekly Work Hours Required',
                'designation.required' => 'Designation Required',
                'jdate.required' => 'Joining Date Required',
                'status.required' => 'Status Required',
            ]
        );
        User::where('id', $employee_data->user_id)->update([
            'name' => $request->firstname . ' ' . $request->lastname,
            'role' => $request->role,
            'email' => $request->workemail,
        ]);
        Employee::findOrFail($request->id)->update([
            'fname' => $request->firstname,
            'lname' => $request->lastname,
            'workemail' => $request->workemail,
            'personalemail' => $request->personalemail,
            'country' => $request->country,
            'phone' => $request->phone,
            'role' => $request->role,
            'type' => $request->type,
            'wstart' => $request->wstart,
            'wend' => $request->wend,
            'dhours' => $request->dhours,
            'whours' => $request->whours,
            'jdate' => $request->jdate,
            'designation' => $request->designation,
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->route('admin.employee')->with('message', 'Employee Updated Successfully');
    }

    public function deleteemployee($id)
    {
        $employee = Employee::where('id', $id)->first();
        User::findOrFail($employee->user_id)->delete();
        Employee::findOrFail($id)->delete();
        return response('Employee deleted successfully');
    }
}
