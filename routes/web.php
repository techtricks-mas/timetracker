<?php

use App\Http\Controllers\Admin\AdminHolidaysController;
use App\Http\Controllers\Admin\DailyworkController as AdminDailyworkController;
use App\Http\Controllers\Admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\Admin\FinancialController as AdminFinancialController;
use App\Http\Controllers\Admin\InterviewController as AdminInterviewController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\Admin\WeeklyUpdateController as AdminWeeklyUpdateController;
use App\Http\Controllers\AdminServerController;
use App\Http\Controllers\Candidate\DailyworkController as CandidateDailyworkController;
use App\Http\Controllers\Candidate\InterviewController as CandidateInterviewController;
use App\Http\Controllers\Candidate\JobController as CandidateJobController;
use App\Http\Controllers\Candidate\CandidateHolidaysController;
use App\Http\Controllers\Candidate\WeeklyUpdateController as CandidateWeeklyUpdateController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\User\DailyworkController as UserDailyworkController;
use App\Http\Controllers\User\InterviewController as UserInterviewController;
use App\Http\Controllers\User\JobController as UserJobController;
use App\Http\Controllers\User\UserHolidaysController;
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
require_once __DIR__ . '/jetstream.php';
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    // print out the role of the current logged in user
    if (Auth::user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role == 'employee') {
        return redirect()->route('user.weeklyupdate');
    } elseif (Auth::user()->role == 'superadmin') {
        return redirect()->route('admin.dashboard');
    } elseif (Auth::user()->role == 'candidate') {
        return redirect()->route('candidate.interview');
    }
});

Route::middleware(['auth', 'verified', 'checkactive', 'role:admin,superadmin,employee,candidate'])->group(function () {
    Route::get('/profile', [CommonController::class, 'profile'])->name('profile.show');
});


Route::name('admin.')->middleware(['auth', 'verified', 'checkactive', 'role:admin,superadmin,null,null'])->prefix('admin')->group(function () {
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

    //Financial Routes
    // add extra middleware to check if the logged in user is superadmin


    Route::get('/financial', [AdminFinancialController::class, 'financial'])->name('financial')->middleware('role:null,superadmin,null,null');
    Route::get('/addfinancial', [AdminFinancialController::class, 'addfinancial'])->name('addfinancial')->middleware('role:null,superadmin,null,null');
    Route::get('/financial/{id}', [AdminFinancialController::class, 'viewfinancial'])->name('viewfinancial')->middleware('role:null,superadmin,null,null');
    Route::get('/financialedit/{id}', [AdminFinancialController::class, 'financialedit'])->name('financialedit')->middleware('role:null,superadmin,null,null');
    Route::post('/financialstatus', [AdminFinancialController::class, 'financialstatus'])->name('financialstatus')->middleware('role:null,superadmin,null,null');
    Route::post('/addfinancial', [AdminFinancialController::class, 'submitfinancial'])->name('submitfinancial')->middleware('role:null,superadmin,null,null');
    Route::post('/updatefinancial', [AdminFinancialController::class, 'updatefinancial'])->name('updatefinancial')->middleware('role:null,superadmin,null,null');
    Route::get('/deletefinancial/{id}', [AdminFinancialController::class, 'deletefinancial'])->name('deletefinancial')->middleware('role:null,superadmin,null,null');

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
    Route::post('/updateHoliday', [AdminHolidaysController::class, 'updateHoliday'])->name('updateHoliday');
    Route::get('/getHoliday', [AdminHolidaysController::class, 'getHoliday'])->name('getHoliday');
    Route::post('/deleteholiday', [AdminHolidaysController::class, 'deleteholiday'])->name('deleteholiday');

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

    // Job Routes
    Route::get('/job', [AdminJobController::class, 'job'])->name('job');
    Route::get('/addjob', [AdminJobController::class, 'addjob'])->name('addjob');
    Route::get('/viewjob/{id}', [AdminJobController::class, 'viewjob'])->name('viewjob');
    Route::get('/jobedit/{id}', [AdminJobController::class, 'jobedit'])->name('jobedit');
    Route::post('/submitjob', [AdminJobController::class, 'submitjob'])->name('submitjob');
    Route::post('/updatejob', [AdminJobController::class, 'updatejob'])->name('updatejob');
    Route::get('/deletjob/{id}', [AdminJobController::class, 'deletjob'])->name('deletjob');

    // Database Settings
    Route::get('/database', [AdminServerController::class, 'database'])->name('database');
    Route::get('/addDatabase', [AdminServerController::class, 'addDatabase'])->name('addDatabase');
    Route::get('/importDatabase/{id}', [AdminServerController::class, 'importDatabase'])->name('importDatabase');
    Route::get('/deletDatabase/{id}', [AdminServerController::class, 'deletDatabase'])->name('deletDatabase');

    // Server Settings
    Route::get('/server', [AdminServerController::class, 'server'])->name('server');
    Route::post('/mail', [AdminServerController::class, 'mail'])->name('mail');
});

Route::name('user.')->middleware(['auth', 'verified', 'checkactive', 'role:null,null,employee,null'])->prefix('user')->group(function () {
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

    // Timesheet Routes
    Route::get('/holidays', [UserHolidaysController::class, 'holidays'])->name('timesheet');
    Route::post('/addholiday', [UserHolidaysController::class, 'addholiday'])->name('addholiday');
    Route::post('/updateholiday', [UserHolidaysController::class, 'updateholiday'])->name('updateholiday');
    Route::get('/getHoliday', [UserHolidaysController::class, 'getHoliday'])->name('getHoliday');
    Route::post('/deleteholiday', [UserHolidaysController::class, 'deleteholiday'])->name('deleteholiday');

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
    Route::get('/candidate-interview/{date}', [UserInterviewController::class, 'CWeekDatadate'])->name('CWeekDatadate');

    // Job Routes
    Route::get('/job', [UserJobController::class, 'job'])->name('job');
    Route::get('/addjob', [UserJobController::class, 'addjob'])->name('addjob');
    Route::get('/viewjob/{id}', [UserJobController::class, 'viewjob'])->name('viewjob');
    Route::get('/jobedit/{id}', [UserJobController::class, 'jobedit'])->name('jobedit');
    Route::post('/submitjob', [UserJobController::class, 'submitjob'])->name('submitjob');
    Route::post('/updatejob', [UserJobController::class, 'updatejob'])->name('updatejob');
    Route::get('/deletjob/{id}', [UserJobController::class, 'deletjob'])->name('deletjob');
});

Route::name('candidate.')->middleware(['auth', 'verified', 'checkactive', 'role:null,null,null,candidate'])->prefix('candidate')->group(function () {

    // Daily Work Routes
    // Route::get('/dailywork', [CandidateDailyworkController::class, 'dailywork'])->name('dailywork');
    // Route::get('/getDailyWork/{id}', [CandidateDailyworkController::class, 'getDailyWork'])->name('getDailyWork');
    // Route::post('/dailystatus', [CandidateDailyworkController::class, 'dailystatus'])->name('dailystatus');

    // Weekly Update Routes
    Route::get('/weeklyupdate', [CandidateWeeklyUpdateController::class, 'weeklyupdate'])->name('weeklyupdate');
    Route::get('/addweeklyupdate', [CandidateWeeklyUpdateController::class, 'addweeklyupdate'])->name('addweeklyupdate');
    Route::post('/postweeklyupdate', [CandidateWeeklyUpdateController::class, 'postweeklyupdate'])->name('postweeklyupdate');
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
    Route::get('/interview/{date}', [CandidateInterviewController::class, 'WeekDatadate'])->name('WeekDatadate');

    // Candidate Interview Routes
    Route::get('/candidate-interview', [CandidateInterviewController::class, 'candidate_interview'])->name('candidate_interview');
    Route::get('/add-candidate-interview', [CandidateInterviewController::class, 'addcandidateinterview'])->name('addcandidateinterview');
    Route::get('/view-candidate-interview/{id}', [CandidateInterviewController::class, 'viewcandidateinterview'])->name('viewcandidateinterview');
    Route::get('/edit-candidate-interview/{id}', [CandidateInterviewController::class, 'editcandidateinterview'])->name('editcandidateinterview');
    Route::post('/submitcandidatetinterview', [CandidateInterviewController::class, 'submicandidatetinterview'])->name('submicandidatetinterview');
    Route::post('/updatecandidatetinterview', [CandidateInterviewController::class, 'updatecandidatetinterview'])->name('updatecandidatetinterview');
    Route::get('/delete-candidate-interview/{id}', [CandidateInterviewController::class, 'deletecandidateinterview'])->name('deletecandidateinterview');
    Route::get('/candidate-interview/{date}', [CandidateInterviewController::class, 'CWeekDatadate'])->name('CWeekDatadate');

    // Job Routes
    Route::get('/job', [CandidateJobController::class, 'job'])->name('job');
    Route::get('/addjob', [CandidateJobController::class, 'addjob'])->name('addjob');
    Route::get('/viewjob/{id}', [CandidateJobController::class, 'viewjob'])->name('viewjob');
    Route::get('/jobedit/{id}', [CandidateJobController::class, 'jobedit'])->name('jobedit');
    Route::post('/submitjob', [CandidateJobController::class, 'submitjob'])->name('submitjob');
    Route::post('/updatejob', [CandidateJobController::class, 'updatejob'])->name('updatejob');
    Route::get('/deletjob/{id}', [CandidateJobController::class, 'deletjob'])->name('deletjob');

    // Timesheet Routes
    Route::get('/holidays', [CandidateHolidaysController::class, 'holidays'])->name('timesheet');
    Route::post('/addholiday', [CandidateHolidaysController::class, 'addholiday'])->name('addholiday');
    Route::post('/updateholiday', [CandidateHolidaysController::class, 'updateholiday'])->name('updateholiday');
    Route::get('/getHoliday', [CandidateHolidaysController::class, 'getHoliday'])->name('getHoliday');
    Route::post('/deleteholiday', [CandidateHolidaysController::class, 'deleteholiday'])->name('deleteholiday');
});

require __DIR__ . '/auth.php';
