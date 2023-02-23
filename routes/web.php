<?php

use App\Http\Controllers\Admin\AdminHolidaysController;
use App\Http\Controllers\Admin\DailyworkController as AdminDailyworkController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\InterviewController as AdminInterviewController;
use App\Http\Controllers\Admin\WeeklyUpdateController as AdminWeeklyUpdateController;
use App\Http\Controllers\Candidate\DailyworkController as CandidateDailyworkController;
use App\Http\Controllers\Candidate\InterviewController as CandidateInterviewController;
use App\Http\Controllers\Candidate\WeeklyUpdateController as CandidateWeeklyUpdateController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\User\DailyworkController as UserDailyworkController;
use App\Http\Controllers\User\InterviewController as UserInterviewController;
use App\Http\Controllers\User\WeeklyUpdateController as UserWeeklyUpdateController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role == 'employee') {
        return redirect()->route('user.dashboard');
    } elseif (Auth::user()->role == 'candidate') {
        return redirect()->route('candidate.interview');
    }
});

Route::middleware(['auth', 'verified', 'role:admin,employee,candidate'])->group(function () {
    Route::get('/profile', [CommonController::class, 'profile']);
});

Route::name('admin.')->middleware(['auth', 'verified', 'role:admin,null,null'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [CommonController::class, 'dashboard'])->name('dashboard');
    // Employee Routes
    Route::get('/employee', [AdminEmployeeController::class, 'employee'])->name('employee');
    Route::get('/addemployee', [AdminEmployeeController::class, 'addemployee'])->name('addemployee');
    Route::get('/employee/{id}', [AdminEmployeeController::class, 'viewemployee'])->name('viewemployee');
    Route::get('/employeeedit/{id}', [AdminEmployeeController::class, 'employeeedit'])->name('employeeedit');
    Route::post('/employeeStatus', [AdminEmployeeController::class, 'employeeStatus'])->name('employeeStatus');
    Route::post('/addemployee', [AdminEmployeeController::class, 'submitemployee'])->name('submitemployee');
    Route::post('/updateemployee', [AdminEmployeeController::class, 'updateemployee'])->name('updateemployee');
    Route::get('/deleteemployee/{id}', [AdminEmployeeController::class, 'deleteemployee'])->name('deleteemployee');

    // Daily Work Routes
    // Route::get('/dailywork', [AdminDailyworkController::class, 'dailywork'])->name('dailywork');
    // Route::get('/getDailyWork/{id}', [AdminDailyworkController::class, 'getDailyWork'])->name('getDailyWork');
    // Route::post('/dailystatus', [AdminDailyworkController::class, 'dailystatus'])->name('dailystatus');

    // Weekly Update Routes
    Route::get('/weeklyupdate', [AdminWeeklyUpdateController::class, 'weeklyupdate'])->name('weeklyupdate');
    Route::get('/weekUpdate/{id}', [AdminWeeklyUpdateController::class, 'weekUpdateView'])->name('weekUpdateView');
    Route::get('/weeklyupdate/{date}', [AdminWeeklyUpdateController::class, 'WeekDatadate'])->name('WeekDatadate');

    // Timesheet Routes
    Route::get('/holidays', [AdminHolidaysController::class, 'holidays'])->name('timesheet');
    Route::post('/addholiday', [AdminHolidaysController::class, 'addholiday'])->name('addholiday');

    // Interview Routes
    Route::get('/interview', [AdminInterviewController::class, 'interview'])->name('interview');
    Route::get('/addinterview', [AdminInterviewController::class, 'addinterview'])->name('addinterview');
    Route::get('/viewinterview/{id}', [AdminInterviewController::class, 'viewinterview'])->name('viewinterview');
    Route::get('/interviewedit/{id}', [AdminInterviewController::class, 'interviewedit'])->name('interviewedit');
    Route::post('/submitinterview', [AdminInterviewController::class, 'submitinterview'])->name('submitinterview');
    Route::post('/updateinterview', [AdminInterviewController::class, 'updateinterview'])->name('updateinterview');
    Route::get('/deletinterview/{id}', [AdminInterviewController::class, 'deletinterview'])->name('deletinterview');

    // Candidate Interview Routes
    Route::get('/candidate-interview', [AdminInterviewController::class, 'candidate_interview'])->name('candidate_interview');
    Route::get('/add-candidate-interview', [AdminInterviewController::class, 'addcandidateinterview'])->name('addcandidateinterview');
    Route::get('/view-candidate-interview/{id}', [AdminInterviewController::class, 'viewcandidateinterview'])->name('viewcandidateinterview');
    Route::get('/edit-candidate-interview/{id}', [AdminInterviewController::class, 'editcandidateinterview'])->name('editcandidateinterview');
    Route::post('/submitcandidatetinterview', [AdminInterviewController::class, 'submicandidatetinterview'])->name('submicandidatetinterview');
    Route::post('/updatecandidatetinterview', [AdminInterviewController::class, 'updatecandidatetinterview'])->name('updatecandidatetinterview');
    Route::get('/delete-candidate-interview/{id}', [AdminInterviewController::class, 'deletecandidateinterview'])->name('deletecandidateinterview');
});
Route::name('user.')->middleware(['auth', 'verified', 'role:null,employee,null'])->prefix('user')->group(function () {
    Route::get('/dashboard', [CommonController::class, 'dashboard'])->name('dashboard');
    // Daily Work Routes
    // Route::get('/dailywork', [UserDailyworkController::class, 'dailywork'])->name('dailywork');
    // Route::get('/getDailyWork/{id}', [UserDailyworkController::class, 'getDailyWork'])->name('getDailyWork');
    // Route::post('/dailystatus', [UserDailyworkController::class, 'dailystatus'])->name('dailystatus');

    // Weekly Update Routes
    Route::get('/weeklyupdate', [UserWeeklyUpdateController::class, 'weeklyupdate'])->name('weeklyupdate');
    Route::get('/addweeklyupdate', [UserWeeklyUpdateController::class, 'addweeklyupdate'])->name('addweeklyupdate');
    Route::post('/postweeklyupdate', [UserWeeklyUpdateController::class, 'postweeklyupdate'])->name('postweeklyupdate');
    Route::get('/weekUpdate/{id}', [UserWeeklyUpdateController::class, 'weekUpdateView'])->name('weekUpdateView');
    Route::get('/weeklyupdate/{date}', [UserWeeklyUpdateController::class, 'WeekDatadate'])->name('WeekDatadate');

    // Interview Routes
    Route::get('/interview', [UserInterviewController::class, 'interview'])->name('interview');
    Route::get('/addinterview', [UserInterviewController::class, 'addinterview'])->name('addinterview');
    Route::get('/viewinterview/{id}', [UserInterviewController::class, 'viewinterview'])->name('viewinterview');
    Route::get('/interviewedit/{id}', [UserInterviewController::class, 'interviewedit'])->name('interviewedit');
    Route::post('/submitinterview', [UserInterviewController::class, 'submitinterview'])->name('submitinterview');
    Route::post('/updateinterview', [UserInterviewController::class, 'updateinterview'])->name('updateinterview');
    Route::get('/deletinterview/{id}', [UserInterviewController::class, 'deletinterview'])->name('deletinterview');

    // Candidate Interview Routes
    Route::get('/candidate-interview', [UserInterviewController::class, 'candidate_interview'])->name('candidate_interview');
    Route::get('/add-candidate-interview', [UserInterviewController::class, 'addcandidateinterview'])->name('addcandidateinterview');
    Route::get('/view-candidate-interview/{id}', [UserInterviewController::class, 'viewcandidateinterview'])->name('viewcandidateinterview');
    Route::get('/edit-candidate-interview/{id}', [UserInterviewController::class, 'editcandidateinterview'])->name('editcandidateinterview');
    Route::post('/submitcandidatetinterview', [UserInterviewController::class, 'submicandidatetinterview'])->name('submicandidatetinterview');
    Route::post('/updatecandidatetinterview', [UserInterviewController::class, 'updatecandidatetinterview'])->name('updatecandidatetinterview');
    Route::get('/delete-candidate-interview/{id}', [UserInterviewController::class, 'deletecandidateinterview'])->name('deletecandidateinterview');
});
Route::name('candidate.')->middleware(['auth', 'verified', 'role:null,null,candidate'])->prefix('candidate')->group(function () {

    // Daily Work Routes
    // Route::get('/dailywork', [CandidateDailyworkController::class, 'dailywork'])->name('dailywork');
    // Route::get('/getDailyWork/{id}', [CandidateDailyworkController::class, 'getDailyWork'])->name('getDailyWork');
    // Route::post('/dailystatus', [CandidateDailyworkController::class, 'dailystatus'])->name('dailystatus');

    // Weekly Update Routes
    Route::get('/weeklyupdate', [CandidateWeeklyUpdateController::class, 'weeklyupdate'])->name('weeklyupdate');
    Route::get('/weekUpdate/{id}', [CandidateWeeklyUpdateController::class, 'weekUpdateView'])->name('weekUpdateView');
    Route::get('/weeklyupdate/{date}', [CandidateWeeklyUpdateController::class, 'WeekDatadate'])->name('WeekDatadate');

    // Interview Routes
    Route::get('/interview', [CandidateInterviewController::class, 'interview'])->name('interview');
    Route::get('/addinterview', [CandidateInterviewController::class, 'addinterview'])->name('addinterview');
    Route::get('/viewinterview/{id}', [CandidateInterviewController::class, 'viewinterview'])->name('viewinterview');
    Route::get('/interviewedit/{id}', [CandidateInterviewController::class, 'interviewedit'])->name('interviewedit');
    Route::post('/submitinterview', [CandidateInterviewController::class, 'submitinterview'])->name('submitinterview');
    Route::post('/updateinterview', [CandidateInterviewController::class, 'updateinterview'])->name('updateinterview');
    Route::get('/deletinterview/{id}', [CandidateInterviewController::class, 'deletinterview'])->name('deletinterview');

    // Candidate Interview Routes
    Route::get('/candidate-interview', [CandidateInterviewController::class, 'candidate_interview'])->name('candidate_interview');
    Route::get('/add-candidate-interview', [CandidateInterviewController::class, 'addcandidateinterview'])->name('addcandidateinterview');
    Route::get('/view-candidate-interview/{id}', [CandidateInterviewController::class, 'viewcandidateinterview'])->name('viewcandidateinterview');
    Route::get('/edit-candidate-interview/{id}', [CandidateInterviewController::class, 'editcandidateinterview'])->name('editcandidateinterview');
    Route::post('/submitcandidatetinterview', [CandidateInterviewController::class, 'submicandidatetinterview'])->name('submicandidatetinterview');
    Route::post('/updatecandidatetinterview', [CandidateInterviewController::class, 'updatecandidatetinterview'])->name('updatecandidatetinterview');
    Route::get('/delete-candidate-interview/{id}', [CandidateInterviewController::class, 'deletecandidateinterview'])->name('deletecandidateinterview');
});

require __DIR__ . '/auth.php';
