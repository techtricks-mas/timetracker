<?php

namespace App\Http\Controllers;

use App\Models\Cinterview;
use App\Models\DailyWork;
use App\Models\Employee;
use App\Models\Interview;
use App\Models\WeeklyUpdate;
use App\Models\Financial;
use App\Models\Holiday;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function dashboard(){
        $page = 'dashboard';
      
        $cinterview = Interview::all();
        $candidateinterview = Cinterview::all();
        $allemployees = Employee::all();
        $allfinancials = Financial::all();
        $allweeklyupdates = WeeklyUpdate::all();
        $allholidays = Holiday::all();
        $thisweekholidays = Holiday::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        if(auth()->user()->role == 'employee'){
            $weeklUpdate = WeeklyUpdate::where('employee_id', auth()->user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        else {
            $weeklUpdate = WeeklyUpdate::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        }
        return view('Pages.Dashboard', compact( 'page', 'cinterview', 'candidateinterview', 'weeklUpdate','allemployees', 'allfinancials', 'allweeklyupdates', 'allholidays', 'thisweekholidays'));
    }

    public function profile(){
        $page = 'profile';
        return view('livewire.profile', compact('page'));
    }

}
