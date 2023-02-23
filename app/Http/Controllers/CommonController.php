<?php

namespace App\Http\Controllers;

use App\Models\Cinterview;
use App\Models\DailyWork;
use App\Models\Employee;
use App\Models\Interview;
use App\Models\WeeklyUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function dashboard(){
        $page = 'dashboard';
        $dailywork = DailyWork::all();
        $cinterview = Interview::all();
        $candidateinterview = Cinterview::all();
        $employees_count = Employee::where('status', '1')->get()->count();
        $weeklUpdate = WeeklyUpdate::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('id', 'desc')->get();
        return view('Pages.Dashboard', compact('employees_count', 'page', 'dailywork', 'cinterview', 'candidateinterview', 'weeklUpdate'));
    }

    public function profile(){
        $page = 'profile';
        return view('livewire.profile', compact('page'));
    }

}
