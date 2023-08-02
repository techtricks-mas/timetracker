<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cinterview;
use App\Models\Employee;
use App\Models\Interview;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{
    public function interview(Request $request)
    { 
        $page = 'interview';
        $dates = Interview::select('date')->distinct()->orderBy('date', 'desc')->get();
        $currentdate = Carbon::now()->format('Y-m-d');
        if($request->has('statusSearch')) {
                $searchTerm = $request->statusSearch;
                $data = Interview::where('status', 'LIKE', "%{$searchTerm}%")->get();
                return view('Pages.Admin.Interview.Interview', compact('page', 'data', 'dates', 'searchTerm', 'currentdate'));    
        } elseif  ($request->filled('dateSearch')) {
                $searchTerm = $request->dateSearch;
                $dateSelected = Carbon::parse($searchTerm)->format('Y-m-d');
                $data = Interview::where('created_at', 'LIKE', "%{$dateSelected}%")->get();
                return view('Pages.Admin.Interview.Interview', compact('page', 'data', 'dates', 'searchTerm', 'currentdate'));
        } else  {
                $data = Interview::orderBy('id', 'desc')->get();
                return view('Pages.Admin.Interview.Interview', compact('page', 'data', 'dates', 'currentdate'));
        }
    }

    public function addinterview()
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        return view('Pages.Admin.Interview.AddInterview', compact('page', 'employees', 'candidates'));
    }

    public function viewinterview($id)
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        $data = Interview::where('id', $id)->first();
        return view('Pages.Admin.Interview.ViewInterview', compact('page', 'employees', 'candidates', 'data'));
    }

    public function interviewedit($id)
    {
        $page = 'interview';
        $employees = Employee::where('status', '1')->where('role', 'employee')->get();
        $candidates = Employee::where('status', '1')->where('role', 'candidate')->get();
        $data = Interview::where('id', $id)->first();
        return view('Pages.Admin.Interview.EditInterview', compact('page', 'employees', 'candidates', 'data'));
    }

    public function submitinterview(Request $request)
    {
        // Validate Interview Fields
        $request->validate(
            [
                // 'employee' => 'required',
                'candidate' => 'required',
                'company' => 'required',
                'role' => 'required',
                'remail' => 'required',
                'rphone' => 'required',
                'date' => 'required'
            ],
            [
                // 'employee.required' => 'Select An Employee',
                'candidate.required' => 'Select A Candidate',
                'company.required' => 'Company Field Required',
                'role.required' => 'Role Field Required',
                'remail.required' => 'Recruiter Email Required',
                'rphone.required' => 'Recruiter Phone Required.',
                'date.required' => 'Date Field Required.'
            ]
        );

        Interview::insert([
            // 'employee_id' => $request->employee,
            'employee_id' => Auth::user()->id,
            'name' => $request->candidate,
            'company' => $request->company,
            'role' => $request->role,
            'remail' => $request->remail,
            'rphone' => $request->rphone,
            'status' => $request->status,
            'comment' => $request->comment,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.interview')->with('message', 'Interview Inserted Successfully');
    }

    public function updateinterview(Request $request)
    {
        // Validate Interview Fields
        $request->validate(
            [
                // 'employee' => 'required',
                'candidate' => 'required',
                'company' => 'required',
                'role' => 'required',
                'remail' => 'required',
                'rphone' => 'required',
                'date' => 'required',
            ],
            [
                // 'employee.required' => 'Select An Employee',
                'candidate.required' => 'Select A Candidate',
                'company.required' => 'Company Field Required',
                'role.required' => 'Role Field Required',
                'remail.required' => 'Recruiter Email Required',
                'rphone.required' => 'Recruiter Phone Required',
                'date.required' => 'Date Field Required'
            ]
        );

        Interview::findOrFail($request->id)->update([
            // 'employee_id' => $request->employee,
            'employee_id' => Auth::user()->id,
            'name' => $request->candidate,
            'company' => $request->company,
            'role' => $request->role,
            'remail' => $request->remail,
            'rphone' => $request->rphone,
            'status' => $request->status,
            'comment' => $request->comment,
            'date' => $request->date,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.interview')->with('message', 'Interview Updated Successfully');
    }

    public function deletinterview($id)
    {
        Interview::findOrFail($id)->delete();
        return response('Interview deleted successfully');
    }

    // *******************************

    // Candidate Interview Codes

    // *******************************

    public function candidate_interview(Request $request)
    {
        $page = 'candidate_interview';
        $Interviewdates = Cinterview::select('time')->get();
        $currentdate = Carbon::now()->format('Y-m-d');
        $dates = $Interviewdates->map(function ($date) {
            return Carbon::parse($date->time)->format('Y-m-d');
        });

        if ($request->dateSearch) {
            $searchTerm = $request->dateSearch;
            $dateSelected = Carbon::parse($searchTerm)->format('Y-m-d');
            $data = Cinterview::where('created_at', 'LIKE', "%{$dateSelected}%")->get();
            return view('Pages.Admin.Cinterview.Interview', compact('page', 'data', 'dates', 'currentdate'));
        } else if ($request->statusSearch) {
            $searchTerm = $request->statusSearch;
            $data = Cinterview::where('status', 'LIKE', "%{$searchTerm}%")->get();
            return view('Pages.Admin.Cinterview.Interview', compact('page', 'data', 'dates', 'currentdate'));
        } else {
            $data = Cinterview::orderBy('id', 'desc')->get();
            return view('Pages.Admin.Cinterview.Interview', compact('page', 'data', 'dates', 'currentdate'));
        }
    }

    public function addcandidateinterview()
    {
        $page = 'candidate_interview';
        return view('Pages.Admin.Cinterview.AddInterview', compact('page'));
    }

    public function editcandidateinterview($id)
    {
        $page = 'candidate_interview';
        $data = Cinterview::where('id', $id)->first();
        return view('Pages.Admin.Cinterview.EditInterview', compact('page', 'data'));
    }

    public function viewcandidateinterview($id)
    {
        $page = 'candidate_interview';
        $data = Cinterview::where('id', $id)->first();
        return view('Pages.Admin.Cinterview.ViewInterview', compact('page', 'data'));
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
                // 'url' => 'required',
            ],
            [
                'name.required' => 'Candidate Name Required',
                'email.required' => 'Candidate Email ID Required',
                'role.required' => 'Role Field Required',
                'time.required' => 'Interview Timing Required',
                'description.required' => 'Job Description Required',
                // 'url.required' => 'URL Field Required',
            ]
        );

       
        Cinterview::insert([
            // 'user_id' => $userid ? $userid : 0,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'time' => $request->time,
            'description' => $request->description,
            // 'url' => $request->url,
            'status' => $request->status,
            'reason' => $request->reason,
            'comment' => $request->comment,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.candidate_interview')->with('message', 'Interview Inserted Successfully');
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
                // 'url' => 'required',
            ],
            [
                'name.required' => 'Candidate Name Required',
                'email.required' => 'Candidate Email ID Required',
                'role.required' => 'Role Field Required',
                'time.required' => 'Interview Timing Required',
                'description.required' => 'Job Description Required',
                // 'url.required' => 'URL Field Required',
            ]
        );

        Cinterview::findOrFail($request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'time' => $request->time,
            'description' => $request->description,
            // 'url' => $request->url, 
            'status' => $request->status,
            'reason' => $request->reason,
            'comment' => $request->comment,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.candidate_interview')->with('message', 'Interview Updated Successfully');
    }

    public function deletecandidateinterview($id)
    {
        Cinterview::findOrFail($id)->delete();
        return response('Interview deleted successfully');
    }
}
