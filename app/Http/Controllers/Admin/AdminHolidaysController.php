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
        $employess = Employee::whereHas('user', function ($query) {
            $query->where('role', '<>', 'superadmin')->where('status', 1);
        })->get();
        return view('Pages.Admin.Holidays.holidays', compact('page', 'employess'));
    }

    public function addholiday(Request $request) {
        $request->validate([
            'employee' => 'required',
            'datestart' => 'required',
            'dateend' => 'required',
            'event' => 'required',
            'statusCreate' => 'required'
        ]);
        // return error if datestart is greater than dateend
        if ($request->datestart > $request->dateend) {
            return response()->json(['error' => 'Date start must be less than date end']);
        }
        // return error if datestart and dateend are equal
        if ($request->datestart == $request->dateend) {
            return response()->json(['error' => 'Date start and date end cannot be the same']);
        }

        $user = User::where('id', $request->employee)->first();
        Holiday::insert([
            'user_id' => $request->employee,
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'event' => $request->event,
            'status' => $request->statusCreate,
            'created_at' => Carbon::now()
        ]);

        $currentDateTime = now(); // Get the current datetime
    
        $holidays = Holiday::whereHas('user', function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('status', '=', 1);
            });
        })->where('dateend', '>=', $currentDateTime)->get(); // Exclude holidays with dateend less than current datetime
        
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'status' => $holiday->status,
                'created_at' => $holiday->created_at->format('Y-m-d H:i:s'),
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
            'event' => 'required',
            'status' => 'required'
        ]);
        // return error if datestart is greater than dateend
        if ($request->datestart > $request->dateend) {
           // return error
            return response()->json(['error' => 'Date start must be less than date end']);
        }
        // return error if datestart and dateend are equal
        if ($request->datestart == $request->dateend) {
            return response()->json(['error' => 'Date start and date end cannot be the same']);
        }
        Holiday::where('id', $request->edit)->update([
            'user_id' => $request->employee,
            'datestart' => $request->datestart,
            'dateend' => $request->dateend,
            'event' => $request->event,
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ]);

        $currentDateTime = now(); // Get the current datetime
    
        $holidays = Holiday::whereHas('user', function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('status', '=', 1);
            });
        })->where('dateend', '>=', $currentDateTime)->get(); // Exclude holidays with dateend less than current datetime
        
        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'status' => $holiday->status,
                'created_at' => $holiday->created_at->format('Y-m-d H:i:s'),
                'backgroundColor' => '#464646'
            ];
        }
        return response()->json($data);
    }

    public function getHoliday() {
        $currentDateTime = now(); // Get the current datetime
    
        $holidays = Holiday::whereHas('user', function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('status', '=', 1);
            });
        })->where('dateend', '>=', $currentDateTime)->get(); // Exclude holidays with dateend less than current datetime

        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'status' => $holiday->status,
                'customColor' => $holiday-> user->employee->color->color,
                'created_at' => $holiday->created_at->format('Y-m-d H:i:s'),
                'backgroundColor' => '#464646'
            ];
        }
        return response()->json($data);
    }
    public function deleteholiday(Request $request) {
        Holiday::where('id', $request->edit)->delete();
        
        $currentDateTime = now(); // Get the current datetime
        $holidays = Holiday::whereHas('user', function ($query) {
            $query->whereHas('employee', function ($query) {
                $query->where('status', '=', 1);
            });
        })->where('dateend', '>=', $currentDateTime)->get(); // Exclude holidays with dateend less than current datetime

        $data = [];
        foreach ($holidays as $key => $holiday) {
            $data[] = [
                'editId' => $holiday->id,
                'userId' => $holiday->user_id,
                'name' => $holiday->user->name,
                'start' => $holiday->datestart,
                'end' => $holiday->dateend,
                'title' => $holiday->event,
                'status' => $holiday->status,
                'created_at' => $holiday->created_at->format('Y-m-d H:i:s'),
                'backgroundColor' => '#464646'
            ];
        }
        return response()->json($data);
    }
}
