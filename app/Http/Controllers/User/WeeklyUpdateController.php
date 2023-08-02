<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WeeklyUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeeklyUpdateController extends Controller
{
    public function weeklyupdate()
    {
        $id = Auth::user()->id;
        $page = 'weeklyupdate';
        $currentdate = Carbon::now()->format('Y-m-d');
        $data = WeeklyUpdate::where('employee_id', $id)->orderBy('id', 'desc')->paginate(15);
        $dates = WeeklyUpdate::select('date')->distinct()->orderBy('date', 'desc')->get();
        return view('Pages.User.WeeklyUpdate.WeeklyUpdate', compact('page', 'data', 'dates', 'currentdate'));
    }

    public function weekUpdateView($id)
    {
        $page = 'weeklyupdate';
        $data = WeeklyUpdate::where('id', $id)->first();
        return view('Pages.User.WeeklyUpdate.viewWeeklyUpdate', compact('page', 'data'));
    }

    public function WeekDatadate($date)
    {
        $page = 'weeklyupdate';
        $currentdate = Carbon::parse($date)->format('Y-m-d');
        $data = WeeklyUpdate::where('date', $currentdate)->paginate(15);
        $dates = WeeklyUpdate::select('date')->distinct()->orderBy('date', 'desc')->get();
        return view('Pages.User.WeeklyUpdate.WeeklyUpdate', compact('page', 'data', 'dates', 'currentdate'));
    }

    public function addweeklyupdate() {
        $page = 'weeklyupdate';
        return view('Pages.User.WeeklyUpdate.addWeeklyUpdate', compact('page'));
    }
    public function postweeklyupdate(Request $request) {
        $request->validate([
            'done' => 'required|string',
            'priorities' => 'required|string',
            'concerns' => 'required|string',
            'summary' => 'required|string'
        ]);
        WeeklyUpdate::insert([
            'employee_id' => $request->id,
            'done' => $request->done,
            'priorities' => $request->priorities,
            'concerns' => $request->concerns,
            'summary' => $request->summary,
            'date' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('user.weeklyupdate')->with('message', 'Weekly Update Added Successfully');
    }
}
