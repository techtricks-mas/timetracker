<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cinterview;
use App\Models\Employee;
use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function interview()
    {
        $page = 'interview';
        $data = Interview::orderBy('id', 'desc')->paginate(15);
        return view('Pages.User.Interview.Interview', compact('page', 'data'));
    }

    public function addinterview()
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        return view('Pages.User.Interview.AddInterview', compact('page', 'employees', 'candidates'));
    }

    public function viewinterview($id)
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        $data = Interview::where('id', $id)->first();
        return view('Pages.User.Interview.ViewInterview', compact('page', 'employees', 'candidates', 'data'));
    }

    public function interviewedit($id)
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        $data = Interview::where('id', $id)->first();
        return view('Pages.User.Interview.EditInterview', compact('page', 'employees', 'candidates', 'data'));
    }

    public function submitinterview(Request $request)
    {
        // Validate Interview Fields
        $request->validate(
            [
                'employee' => 'required',
                'candidate' => 'required',
                'company' => 'required',
                'role' => 'required',
                'remail' => 'required',
                'rphone' => 'required',
            ],
            [
                'employee.required' => 'Select An Employee',
                'candidate.required' => 'Select A Candidate',
                'company.required' => 'Company Field Required',
                'role.required' => 'Role Field Required',
                'remail.required' => 'Recruiter Email Required',
                'rphone.required' => 'Recruiter Phone Required'
            ]
        );

        Interview::insert([
            'employee_id' => $request->employee,
            'name' => $request->candidate,
            'company' => $request->company,
            'role' => $request->role,
            'remail' => $request->remail,
            'rphone' => $request->rphone,
            'status' => $request->status,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('user.interview')->with('message', 'Interview Inserted Successfully');
    }

    public function updateinterview(Request $request)
    {
        // Validate Interview Fields
        $request->validate(
            [
                'employee' => 'required',
                'candidate' => 'required',
                'company' => 'required',
                'role' => 'required',
                'remail' => 'required',
                'rphone' => 'required',
            ],
            [
                'employee.required' => 'Select An Employee',
                'candidate.required' => 'Select A Candidate',
                'company.required' => 'Company Field Required',
                'role.required' => 'Role Field Required',
                'remail.required' => 'Recruiter Email Required',
                'rphone.required' => 'Recruiter Phone Required'
            ]
        );

        Interview::findOrFail($request->id)->update([
            'employee_id' => $request->employee,
            'name' => $request->candidate,
            'company' => $request->company,
            'role' => $request->role,
            'remail' => $request->remail,
            'rphone' => $request->rphone,
            'status' => $request->status,
            'comment' => $request->comment,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('user.interview')->with('message', 'Interview Updated Successfully');
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
        $page = 'candidate_interview';
        $data = Cinterview::orderBy('id', 'desc')->paginate(15);
        return view('Pages.User.Cinterview.Interview', compact('page', 'data'));
    }

    public function addcandidateinterview()
    {
        $page = 'candidate_interview';
        return view('Pages.User.Cinterview.AddInterview', compact('page'));
    }

    public function editcandidateinterview($id)
    {
        $page = 'candidate_interview';
        $data = Cinterview::where('id', $id)->first();
        return view('Pages.User.Cinterview.EditInterview', compact('page', 'data'));
    }

    public function viewcandidateinterview($id)
    {
        $page = 'candidate_interview';
        $data = Cinterview::where('id', $id)->first();
        return view('Pages.User.Cinterview.ViewInterview', compact('page', 'data'));
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
                'url' => 'required',
            ],
            [
                'name.required' => 'Candidate Name Required',
                'email.required' => 'Candidate Email ID Required',
                'role.required' => 'Role Field Required',
                'time.required' => 'Interview Timing Required',
                'description.required' => 'Job Description Required',
                'url.required' => 'URL Field Required',
            ]
        );

        Cinterview::insert([
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

        return redirect()->route('user.candidate_interview')->with('message', 'Interview Inserted Successfully');
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
                'url' => 'required',
            ],
            [
                'name.required' => 'Candidate Name Required',
                'email.required' => 'Candidate Email ID Required',
                'role.required' => 'Role Field Required',
                'time.required' => 'Interview Timing Required',
                'description.required' => 'Job Description Required',
                'url.required' => 'URL Field Required',
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

        return redirect()->route('user.candidate_interview')->with('message', 'Interview Inserted Successfully');
    }

    public function deletecandidateinterview($id)
    {
        Cinterview::findOrFail($id)->delete();
        return response('Interview deleted successfully');
    }
}
