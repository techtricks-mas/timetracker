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
        return view('Pages.User.Holidays.holidays', compact('page', 'data'));
    }

    public function addholiday(Request $request) {
        $request->validate([
            'datestart' => 'required',
            'dateend' => 'required',
            'event' => 'required'
        ]);
        Holiday::insert([
            'user_id' => Auth::user()->id,
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'event' => $request->event,
            'created_at' => Carbon::now()
        ]);
        $holidays = Holiday::all();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646'
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
        Holiday::where('id', $request->edit)->update([
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'event' => $request->event,
            'updated_at' => Carbon::now()
        ]);
        $holidays = Holiday::all();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646'
            ];
        }
        return response()->json($data);
    }

    public function getHoliday() {
        $holidays = Holiday::all();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646'
            ];
        }
        return response()->json($data);
    }

    public function deleteholiday(Request $request) {
        Holiday::where('id', $request->edit)->delete();
        $holidays = Holiday::all();
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'backgroundColor' => $holiday->user_id == Auth::user()->id ? '#007eff' :'#464646'
            ];
        }
        return response()->json($data);
    }
}
