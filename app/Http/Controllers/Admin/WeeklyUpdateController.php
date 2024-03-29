<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeeklyUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeeklyUpdateController extends Controller
{
    public function weeklyupdate(Request $request)
    {
        $page = 'weeklyupdate';
        $dates = WeeklyUpdate::select('date')->distinct()->orderBy('date', 'desc')->get();
        if($request->has('dateSearch')) {
            $currentdate = Carbon::parse($request->dateSearch)->format('Y-m-d');
            $data = WeeklyUpdate::where('date', $currentdate)->get();
            return view('Pages.Admin.WeeklyUpdate.WeeklyUpdate', compact('page', 'data', 'dates', 'currentdate'));
        }
         else {
            $currentdate = Carbon::now()->format('Y-m-d');
            $data = WeeklyUpdate::orderBy('id', 'desc')->get();
            return view('Pages.Admin.WeeklyUpdate.WeeklyUpdate', compact('page', 'data', 'dates', 'currentdate'));
        }
    }

    public function weekUpdateView($id)
    {
        $page = 'weeklyupdate';
        $data = WeeklyUpdate::where('id', $id)->first();
        return view('Pages.Admin.WeeklyUpdate.viewWeeklyUpdate', compact('page', 'data'));
    }

    public function WeekDatadate($date)
    {
        $page = 'weeklyupdate';
        $currentdate = Carbon::parse($date)->format('Y-m-d');
        $data = WeeklyUpdate::where('date', $currentdate)->paginate(15);
        $dates = WeeklyUpdate::select('date')->distinct()->orderBy('date', 'desc')->get();
        return view('Pages.Admin.WeeklyUpdate.WeeklyUpdate', compact('page', 'data', 'dates', 'currentdate'));
    }
}
