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
