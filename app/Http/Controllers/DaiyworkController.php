<?php

namespace App\Http\Controllers;

use App\Mail\WorkUpdate;
use App\Models\DailyWork;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DaiyworkController extends Controller
{
    public function dailywork(){
        $page = 'dailywork';
        $data = DailyWork::all();
        return view('Pages.Admin.DailyWork.Dailywork', compact('data', 'page'));
    }

    public function adddailywork(){
        $page = 'dailywork';
        $employees = Employee::where('status', '1')->get();
        return view('Pages.Admin.DailyWork.AddDailyWork', compact('employees', 'page'));
    }

    public function viewdailywork($id){
        $page = 'dailywork';
        $data = DailyWork::where('id', $id)->first();
        return view('Pages.Admin.DailyWork.ViewWork', compact('data', 'page'));
    }

    public function submitdailywork(Request $request){
        $request->validate([
            'employee' => 'required|numeric',
            'date' => 'required',
            'project' => 'required',
            'turl' => 'required',
            'tdescription' => 'required',
            'tsdate' => 'required',
            'tedate' => 'required',
            'hours' => 'required|numeric',
        ],
        [
            'employee.required' => 'Select An Employee',
            'employee.numeric' => 'Employee Id Isn\'t Valid',
            'date.required' => 'Date Required',
            'project.required' => 'Project Name Required',
            'turl.required' => 'Task Url Required',
            'tdescription.required' => 'Task Description Required',
            'tsdate.required' => 'Task Start Date Required',
            'tedate.required' => 'Task End Date Required',
            'hours.required' => 'Spent Hours Required',
            'hours.numeric' => 'Spent Hours Should Be A Number ',
        ]);
        DailyWork::insert([
            'employee_id' => $request->employee,
            'date' => $request->date,
            'project' => $request->project,
            'turl' => $request->turl,
            'tdescription' => $request->tdescription,
            'tsdate' => $request->tsdate,
            'tedate' => $request->tedate,
            'hours' => $request->hours,
            'created_at' => Carbon::now(),
        ]);
        $employee = Employee::where('id', $request->employee)->first();
        $admin = User::first();
        $testMailData = [
            'name' => $employee->fname. ' ' .$employee->lname,
            'text' => $employee->fname. ' ' .$employee->lname .' has submitted daily work update of '.$request->date.' : <br> Project: '.$request->project.' <br> URL: <a href="'.$request->turl.'">'.$request->turl.'</a>'
        ];
        Mail::to($admin->email)->send(new WorkUpdate($testMailData));
        return redirect('/dailywork')->with('message', 'Daily Work Added Successfully');
    }
    public function dailystatus(Request $request){
        DailyWork::findOrFail($request->id)->update([
            'status' => $request->status,
            'ypdated_at' => Carbon::now()
        ]);
        return response()->json(['Status Updated Successfully']);
    }

    public function dailyworkedit($id){
        $page = 'dailywork';
        $employees = Employee::where('status', '1')->get();
        $data = DailyWork::where('id', $id)->first();
        return view('Pages.Admin.DailyWork.EditDailyWork', compact('employees', 'data', 'page'));
    }

    public function deletework($id){
        $data = DailyWork::where('id', $id)->delete();
        return response('Work Data Successfully Removed');
    }

    public function updatedailywork(Request $request){
        $request->validate([
            'employee' => 'required|numeric',
            'date' => 'required',
            'project' => 'required',
            'turl' => 'required',
            'tdescription' => 'required',
            'tsdate' => 'required',
            'tedate' => 'required',
            'hours' => 'required|numeric',
        ],
        [
            'employee.required' => 'Select An Employee',
            'employee.numeric' => 'Employee Id Isn\'t Valid',
            'date.required' => 'Date Required',
            'project.required' => 'Project Name Required',
            'turl.required' => 'Task Url Required',
            'tdescription.required' => 'Task Description Required',
            'tsdate.required' => 'Task Start Date Required',
            'tedate.required' => 'Task End Date Required',
            'hours.required' => 'Spent Hours Required',
            'hours.numeric' => 'Spent Hours Should Be A Number ',
        ]);
        DailyWork::findOrFail($request->id)->update([
            'employee_id' => $request->employee,
            'date' => $request->date,
            'project' => $request->project,
            'turl' => $request->turl,
            'tdescription' => $request->tdescription,
            'tsdate' => $request->tsdate,
            'tedate' => $request->tedate,
            'hours' => $request->hours,
            'created_at' => Carbon::now(),
        ]);

        return redirect('/dailywork')->with('message', 'Daily Work Updated Successfully');
    }

}
