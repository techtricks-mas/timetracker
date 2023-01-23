<?php

namespace App\Http\Controllers;

use App\Models\DailyWork;
use App\Models\WeeklyUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function timeToSeconds($time)
    {
        $arr = explode(':', $time);
        if (count($arr) === 3) {
            return $arr[0] * 3600 + $arr[1] * 60 + $arr[2];
        }
        return $arr[0] * 60 + $arr[1];
    }

    public function callback(Request $request)
    {
        return response()->json([
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'role' => Auth::user()->role,
            'email' => Auth::user()->email,
            'photo' => Auth::user()->profile_photo_url,
            'created_at' => Auth::user()->created_at,
            'updated_at' => Auth::user()->updated_at,
        ], 200);
    }

    public function getWorksUpdate(Request $request)
    {
        $id = $request->id;
        $current = DailyWork::where('employee_id', $id)->where('running', 'yes')->first();
        $all = DailyWork::where('employee_id', $id)->count();
        if ($request->get == 1) {
            $weekData = DailyWork::where('employee_id', $id)->where('running', 'no')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        } elseif ($request->get == 2) {
            $weekData = DailyWork::where('employee_id', $id)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        } elseif ($request->get == 3) {
            $weekData = DailyWork::where('employee_id', $id)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        $currentSeconds = 0;
        foreach ($weekData as $key => $value) {
            $currentSeconds = $currentSeconds + $this->timeToSeconds($value->hours);
        }
        $data = [
            "dataHave" => $all,
            "running" => $current,
            "current" => $weekData,
            "currentHour" => gmdate("H:i:s", $currentSeconds),
        ];
        return response()->json($data, 200);
    }

    public function getWeekUpdate(Request $request)
    {
        $id = $request->id;
        if ($request->get == 1) {
            $weekData = DailyWork::where('employee_id', $id)->where('running', 'no')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        } elseif ($request->get == 2) {
            $weekData = DailyWork::where('employee_id', $id)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        } elseif ($request->get == 3) {
            $weekData = DailyWork::where('employee_id', $id)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        $currentSeconds = 0;
        foreach ($weekData as $key => $value) {
            $currentSeconds = $currentSeconds + $this->timeToSeconds($value->hours);
        }
        $data = [
            "current" => $weekData,
            "currentHour" => gmdate("H:i:s", $currentSeconds),
        ];
        return response()->json($data, 200);
    }

    public function dailyStart(Request $request)
    {
        $dailyID = DailyWork::insertGetId([
            "employee_id" => $request->id,
            "vpn" => $request->vpn ? 'yes' : 'no',
            "work" => $request->work ? 'yes' : 'no',
            "ip" => $request->ip,
            "time" => Carbon::now(),
            "start" => Carbon::now(),
            "created_at" => Carbon::now()
        ]);
        return response()->json($dailyID, 200);
    }
    public function dailyStartUpdate(Request $request)
    {
        DailyWork::findOrFail($request->id)->update([
            "project" => $request->pname,
            "turl" => $request->url,
            "tdescription" => $request->desc,
            "updated_at" => Carbon::now()
        ]);
        $current = DailyWork::where('id', $request->id)->where('running', 'yes')->first();
        $all = DailyWork::where('employee_id', $current->employee_id)->count();
        if ($request->current == 1) {
            $currentweek = DailyWork::where('employee_id', $current->employee_id)->where('running', 'no')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        } elseif ($request->current == 2) {
            $currentweek = DailyWork::where('employee_id', $current->employee_id)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        } elseif ($request->current == 3) {
            $currentweek = DailyWork::where('employee_id', $current->employee_id)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        $currentSeconds = 0;
        foreach ($currentweek as $key => $value) {
            $currentSeconds = $currentSeconds + $this->timeToSeconds($value->hours);
        }
        $data = [
            "dataHave" => $all,
            "running" => $current,
            "current" => $currentweek,
            "currentHour" => gmdate("H:i:s", $currentSeconds),
        ];
        return response()->json($data, 200);
    }
    public function dailyStartStop(Request $request)
    {
        DailyWork::findOrFail($request->id)->update([
            "end" => Carbon::now(),
            "hours" => $request->hour,
            "running" => 'no',
            "updated_at" => Carbon::now()
        ]);
        $current = DailyWork::where('employee_id', $request->client)->where('running', 'yes')->first();
        $all = DailyWork::where('employee_id', $request->client)->count();
        if ($request->current == 1) {
            $currentweek = DailyWork::where('employee_id', $request->client)->where('running', 'no')->whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->get();
        } elseif ($request->current == 2) {
            $currentweek = DailyWork::where('employee_id', $request->client)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        } elseif ($request->current == 3) {
            $currentweek = DailyWork::where('employee_id', $request->client)->where('running', 'no')->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        $currentSeconds = 0;
        foreach ($currentweek as $key => $value) {
            $currentSeconds = $currentSeconds + $this->timeToSeconds($value->hours);
        }
        $data = [
            "dataHave" => $all,
            "running" => $current,
            "current" => $currentweek,
            "currentHour" => gmdate("H:i:s", $currentSeconds),
        ];
        return response()->json($data, 200);
    }

    public function weeklyUpdate(Request $request)
    {
        WeeklyUpdate::insert([
            'employee_id' => $request->id,
            'done' => $request->important,
            'priorities' => $request->priorities,
            'concerns' => $request->concerns,
            'summary' => $request->summary,
            'date' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
        return response()->json('Inserted Successfully', 200);
    }
}
