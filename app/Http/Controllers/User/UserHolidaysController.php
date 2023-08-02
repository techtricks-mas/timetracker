<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHolidaysController extends Controller
{
    public function holidays() {
        $page = 'holidays';
        $holidays = Holiday::all();

        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
            ];
        }
        // dd($data);
        return view('Pages.User.Holidays.holidays', compact('page', 'data'));
    }

    public function addholiday(Request $request) {
        $request->validate([
            'datestart' => 'required',
            'dateend' => 'required',
            'event' => 'required'
        ]);
        // return error if datestart is greater than dateend
        if ($request->datestart > $request->dateend) {
            return response()->json(['error' => 'Date start must be less than date end']);
        }
        // return error if datestart and dateend are equal
        if ($request->datestart == $request->dateend) {
            return response()->json(['error' => 'Date start and date end cannot be the same']);
        }
        
        Holiday::insert([
            'user_id' => Auth::user()->id,
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'event' => $request->event,
            'created_at' => Carbon::now()
        ]);
        $id = Auth::user()->id;
        $currentDateTime = now(); // Get the current datetime

        $holidays = Holiday::where('user_id', $id)->where('dateend', '>=', $currentDateTime)->get();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646',
                'created_at' => $holiday->created_at,
            ];
        }
        return response()->json($data);
    }

    public function updateholiday(Request $request) {
        $request->validate([
            'datestart' => 'required',
            'dateend' => 'required',
            'event' => 'required'
        ]);
        // return error if datestart is greater than dateend
        if ($request->datestart > $request->dateend) {
            return response()->json(['error' => 'Date start must be less than date end']);
        }
        // return error if datestart and dateend are equal
        if ($request->datestart == $request->dateend) {
            return response()->json(['error' => 'Date start and date end cannot be the same']);
        }
        Holiday::where('id', $request->edit)->update([
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'event' => $request->event,
            'updated_at' => Carbon::now()
        ]);
        $id = Auth::user()->id;
        $currentDateTime = now(); // Get the current datetime

        $holidays = Holiday::where('user_id', $id)->where('dateend', '>=', $currentDateTime)->get();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646',
                'created_at' => $holiday->created_at,
            ];
        }
        return response()->json($data);
    }

    public function getHoliday() {
        $user_id = auth()->user()->id;
        $currentDateTime = now(); // Get the current datetime

        // Fetch the user's holiday records
        $holidays = Holiday::where('user_id', $user_id)->where('dateend', '>=', $currentDateTime)->get();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $created_at = date('Y-m-d H:i:s', strtotime($holiday->created_at));
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646',
                'status' => $holiday->status,
                'created_at' => $created_at,
            ];
        }
        return response()->json($data);
    }

    public function deleteholiday(Request $request) {
        Holiday::where('id', $request->edit)->delete();
        $id = Auth::user()->id;
        $currentDateTime = now(); // Get the current datetime

        $holidays = Holiday::where('user_id', $id)->where('dateend', '>=', $currentDateTime)->get();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646',
                'created_at' => $holiday->created_at,
            ];
        }
        return response()->json($data);
    }
}
