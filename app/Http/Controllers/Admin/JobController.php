<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function job(Request $request)
    { 
        $page = 'job';
        $totalCount = Job::count();
        $waitCount = Job::where('status', 'waiting')->count();
        $approvedCount = Job::where('status', 'approved')->count();
        $rejectCount = Job::where('status', 'reject')->count();
        $dates = Job::select('created_at')->distinct()->orderBy('created_at', 'desc')->get();
        $currentdate = Carbon::now()->format('Y-m-d');
        if  ($request->has('jobSearch')) {
                $searchTerm = $request->jobSearch;
                $data = Job::where('title', 'LIKE', "%{$searchTerm}%")
                        ->paginate(15);
                return view('Pages.Admin.Job.Job', compact('page', 'data', 'dates', 'searchTerm', 'currentdate', 'totalCount', 'waitCount', 'approvedCount', 'rejectCount'));    
        }   elseif($request->has('statusSearch')) {
                $searchTerm = $request->statusSearch;
                $data = Job::where('status', 'LIKE', "%{$searchTerm}%")
                        ->paginate(15);
                return view('Pages.Admin.Job.Job', compact('page', 'data', 'dates', 'searchTerm', 'currentdate', 'totalCount', 'waitCount', 'approvedCount', 'rejectCount'));    
        } elseif  ($request->has('dateSearch')) {
                $searchTerm = $request->dateSearch;
                $dateSelected = Carbon::parse($searchTerm)->format('Y-m-d');
                $data = Job::where('created_at', 'LIKE', "%{$dateSelected}%")
                        ->paginate(15);
                return view('Pages.Admin.Job.Job', compact('page', 'data', 'dates', 'searchTerm', 'currentdate', 'totalCount', 'waitCount', 'approvedCount', 'rejectCount'));
        } else  {
                $data = Job::orderBy('id', 'desc')->paginate(15);
                return view('Pages.Admin.Job.Job', compact('page', 'data', 'dates', 'currentdate', 'totalCount', 'waitCount', 'approvedCount', 'rejectCount'));
        }
    }

    public function addjob()
    {
        $page = 'job';
        return view('Pages.Admin.Job.AddJob', compact('page'));
    }

    public function viewjob($id)
    {
        $page = 'job';
        $data = Job::where('id', $id)->first();
        return view('Pages.Admin.Job.ViewJob', compact('page', 'data'));
    }

    public function jobedit($id)
    {
        $page = 'job';
        $data = Job::where('id', $id)->first();
        return view('Pages.Admin.Job.EditJob', compact('page', 'data'));
    }

    public function submitjob(Request $request)
    {
        // Validate Job Fields
        $request->validate(
            [
                'company' => 'required',
                'plateform' => 'required',
                'title' => 'required',
                'url' => 'required',
                'date' => 'required',
                'salary' => 'required'
            ],
            [
                'company.required' => 'Company Field Required',
                'plateform.required' => 'Plateform Field Required',
                'title.required' => 'Job Title Required',
                'url.required' => 'Url Required.',
                'date.required' => 'Date Field Required.',
                'salary.required' => 'Salary Field Required.'
            ]
        );

        Job::insert([
            'user_id' => Auth::user()->id,
            'company_name' => $request->company,
            'plateform' => $request->plateform,
            'title' => $request->title,
            'url' => $request->url,
            'salary' => $request->salary,
            'status' => $request->status,
            'comment' => $request->comment,
            'job_posted_date' => $request->date,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.job')->with('message', 'Job Inserted Successfully');
    }

    public function updatejob(Request $request)
    {
        // Validate Job Fields
        $request->validate(
            [
                'company_name' => 'required',
                'plateform' => 'required',
                'title' => 'required',
                'url' => 'required',
                'job_posted_date' => 'required',
                'salary' => 'required'
            ],
            [
                'company_name.required' => 'Company Field Required',
                'plateform.required' => 'Plateform Field Required',
                'title.required' => 'Job Title Required',
                'url.required' => 'Url Required.',
                'job_posted_date.required' => 'Date Field Required.',
                'salary.required' => 'Salary Field Required.'
            ]
        );        

        Job::findOrFail($request->id)->update([
            'user_id' => Auth::user()->id,
            'company_name' => $request->company_name,
            'plateform' => $request->plateform,
            'title' => $request->title,
            'url' => $request->url,
            'salary' => $request->salary,
            'status' => $request->status,
            'comment' => $request->comment,
            'job_posted_date' => $request->job_posted_date,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('admin.job')->with('message', 'Job Updated Successfully');
    }

    public function deletjob($id)
    {
        Job::findOrFail($id)->delete();
        return response('Job deleted successfully');
    }
}
