<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminHolidaysController extends Controller
{
    public function holidays() {
        $page = 'holidays';
        $employess = Employee::all();
        return view('Pages.Admin.Holidays.holidays', compact('page', 'employess'));
    }

    public function addholiday(Request $request) {
        $request->validate([
            'employee' => 'required',
            'datestart' => 'required',
            'dateend' => 'required',
            'event' => 'required'
        ]);
        $user = User::where('id', $request->employee)->first();
        Holiday::insert([
            'user_id' => $request->employee,
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
                'backgroundColor' => '#464646'
            ];
        }
        return response()->json($data);
    }

    public function updateHoliday(Request $request) {
        $request->validate([
            'employee' => 'required',
            'datestart' => 'required',
            'dateend' => 'required',
            'event' => 'required'
        ]);
        Holiday::where('id', $request->edit)->update([
            'user_id' => $request->employee,
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
                'backgroundColor' => '#464646'
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
                'backgroundColor' => '#464646'
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
                'backgroundColor' => '#464646'
            ];
        }
        return response()->json($data);
    }
}
