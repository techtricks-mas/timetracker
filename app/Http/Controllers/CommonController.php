<?php

namespace App\Http\Controllers;

use App\Models\Cinterview;
use App\Models\DailyWork;
use App\Models\Employee;
use App\Models\Interview;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function dashboard(){
        $page = 'dashboard';
        $dailywork = DailyWork::all();
        $cinterview = Interview::all();
        $candidateinterview = Cinterview::all();
        $employees_count = Employee::where('status', '1')->get()->count();
        return view('Pages.Dashboard', compact('employees_count', 'page', 'dailywork', 'cinterview', 'candidateinterview'));
    }

    public function profile(){
        $page = 'profile';
        return view('livewire.profile', compact('page'));
    }

}
