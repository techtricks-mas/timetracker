<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Cinterview;
use App\Models\Employee;
use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function interview()
    {
        $id = Auth::user()->id;
        $page = 'interview';
        $currentdate = Carbon::now()->format('Y-m-d');
        $data = Interview::where('employee_id',$id)->orderBy('id', 'desc')->paginate(15);
        return view('Pages.Candidate.Interview.Interview', compact('page', 'data', 'currentdate'));
    }
    public function WeekDatadate($date)
    {
        $id = Auth::user()->id;
        $page = 'interview';
        $currentdate = Carbon::parse($date)->format('Y-m-d');
        $data = Interview::where('employee_id',$id)->whereDate('created_at', $currentdate)->paginate(15);
        $dates = Interview::select('created_at')->distinct()->orderBy('created_at', 'desc')->get();
        return view('Pages.Candidate.Interview.Interview', compact('page', 'data', 'dates', 'currentdate'));
    }
    public function addinterview()
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        return view('Pages.Candidate.Interview.AddInterview', compact('page', 'employees', 'candidates'));
    }

    public function viewinterview($id)
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        $data = Interview::where('id', $id)->first();
        return view('Pages.Candidate.Interview.ViewInterview', compact('page', 'employees', 'candidates', 'data'));
    }

    public function interviewedit($id)
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        $data = Interview::where('id', $id)->first();
        return view('Pages.Candidate.Interview.EditInterview', compact('page', 'employees', 'candidates', 'data'));
    }

    public function submitinterview(Request $request)
    {
        // Validate Interview Fields
        $request->validate(
            [
                // 'employee' => 'required',
                // 'candidate' => 'required',
                'company' => 'required',
                'role' => 'required',
                'remail' => 'required',
                'rphone' => 'required',
            ],
            [
                // 'employee.required' => 'Select An Employee',
                // 'candidate.required' => 'Select A Candidate',
                'company.required' => 'Company Field Required',
                'role.required' => 'Role Field Required',
                'remail.required' => 'Recruiter Email Required',
                'rphone.required' => 'Recruiter Phone Required'
            ]
        );
        $employee = Employee::where('user_id', Auth::user()->id)->first();
        Interview::insert([
            // 'employee_id' => $request->employee,
            'employee_id' => Auth::user()->id,
            // 'name' => $request->candidate,
            'name' => $employee->profileName,
            'company' => $request->company,
            'role' => $request->role,
            'remail' => $request->remail,
            'rphone' => $request->rphone,
            'status' => $request->status,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('candidate.interview')->with('message', 'Interview Inserted Successfully');
    }

    public function updateinterview(Request $request)
    {
        // Validate Interview Fields
        $request->validate(
            [
                // 'employee' => 'required',
                // 'candidate' => 'required',
                'company' => 'required',
                'role' => 'required',
                'remail' => 'required',
                'rphone' => 'required',
            ],
            [
                // 'employee.required' => 'Select An Employee',
                // 'candidate.required' => 'Select A Candidate',
                'company.required' => 'Company Field Required',
                'role.required' => 'Role Field Required',
                'remail.required' => 'Recruiter Email Required',
                'rphone.required' => 'Recruiter Phone Required'
            ]
        );
        $employee = Employee::where('user_id', Auth::user()->id)->first();
        Interview::findOrFail($request->id)->update([
            // 'employee_id' => $request->employee,
            'employee_id' => Auth::user()->id,
            // 'name' => $request->candidate,
            'name' => $employee->profileName,
            'company' => $request->company,
            'role' => $request->role,
            'remail' => $request->remail,
            'rphone' => $request->rphone,
            'status' => $request->status,
            'comment' => $request->comment,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('candidate.interview')->with('message', 'Interview Updated Successfully');
    }

    public function deletinterview($id)
    {
        Interview::findOrFail($id)->delete();
        return response('Interview deleted successfully');
    }

    // *******************************

    // Candidate Interview Codes

    // *******************************

    public function candidate_interview()
    {
        $id = Auth::user()->id;
        $page = 'candidate_interview';
        $currentdate = Carbon::now()->format('Y-m-d');
        $data = Cinterview::where('user_id', $id)->orderBy('id', 'desc')->paginate(15);
        return view('Pages.Candidate.Cinterview.Interview', compact('page', 'data', 'currentdate'));
    }

    public function CWeekDatadate($date)
    {
        $id = Auth::user()->id;
        $page = 'candidate_interview';
        $currentdate = Carbon::parse($date)->format('Y-m-d');
        $data = Cinterview::where('user_id', $id)->whereDate('created_at', $currentdate)->paginate(15);
        $dates = Cinterview::select('created_at')->distinct()->orderBy('created_at', 'desc')->get();
        return view('Pages.Candidate.Cinterview.Interview', compact('page', 'data', 'dates', 'currentdate'));
    }

    public function addcandidateinterview()
    {
        $page = 'candidate_interview';
        return view('Pages.Candidate.Cinterview.AddInterview', compact('page'));
    }

    public function editcandidateinterview($id)
    {
        $page = 'candidate_interview';
        $data = Cinterview::where('id', $id)->first();
        return view('Pages.Candidate.Cinterview.EditInterview', compact('page', 'data'));
    }

    public function viewcandidateinterview($id)
    {
        $page = 'candidate_interview';
        $data = Cinterview::where('id', $id)->first();
        return view('Pages.Candidate.Cinterview.ViewInterview', compact('page', 'data'));
    }

    public function submicandidatetinterview(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
                'time' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'Candidate Name Required',
                'email.required' => 'Candidate Email ID Required',
                'role.required' => 'Role Field Required',
                'time.required' => 'Interview Timing Required',
                'description.required' => 'Job Description Required',
            ]
        );

        Cinterview::insert([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'time' => $request->time,
            'description' => $request->description,
            'url' => $request->url,
            'status' => $request->status,
            'reason' => $request->reason,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('candidate.candidate_interview')->with('message', 'Interview Inserted Successfully');
    }

    public function updatecandidatetinterview(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'role' => 'required',
                'time' => 'required',
                'description' => 'required',
            ],
            [
                'name.required' => 'Candidate Name Required',
                'email.required' => 'Candidate Email ID Required',
                'role.required' => 'Role Field Required',
                'time.required' => 'Interview Timing Required',
                'description.required' => 'Job Description Required',
            ]
        );

        Cinterview::findOrFail($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'time' => $request->time,
            'description' => $request->description,
            'url' => $request->url,
            'status' => $request->status,
            'reason' => $request->reason,
            'comment' => $request->comment,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('candidate.candidate_interview')->with('message', 'Interview Inserted Successfully');
    }

    public function deletecandidateinterview($id)
    {
        Cinterview::findOrFail($id)->delete();
        return response('Interview deleted successfully');
    }
}
