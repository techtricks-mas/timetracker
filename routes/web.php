<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\DaiyworkController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\InterviewController;
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


Route::middleware(['auth', 'verified', 'role:admin,employee,candidate'])->group(function () {
    Route::get('/dashboard', [CommonController::class, 'dashboard']);
    Route::get('/profile', [CommonController::class, 'profile']);
});

Route::middleware(['auth', 'verified', 'role:admin,null,null'])->group(function () {
    // Employee Routes
    Route::get('/employee', [EmployeeController::class, 'employee']);
    Route::get('/addemployee', [EmployeeController::class, 'addemployee']);
    Route::get('/employee/{id}', [EmployeeController::class, 'viewemployee']);
    Route::get('/employeeedit/{id}', [EmployeeController::class, 'employeeedit']);
    Route::post('/addemployee', [EmployeeController::class, 'submitemployee']);
    Route::post('/updateemployee', [EmployeeController::class, 'updateemployee']);
    Route::get('/deleteemployee/{id}', [EmployeeController::class, 'deleteemployee']);
    // Daily Work Routes
    Route::get('/dailywork', [DaiyworkController::class, 'dailywork']);
    Route::get('/adddailywork', [DaiyworkController::class, 'adddailywork']);
    Route::get('/dailywork/{id}', [DaiyworkController::class, 'viewdailywork']);
    Route::post('/submitdailywork', [DaiyworkController::class, 'submitdailywork']);
    Route::post('/dailystatus', [DaiyworkController::class, 'dailystatus']);
    Route::get('/dailyworkedit/{id}', [DaiyworkController::class, 'dailyworkedit']);
    Route::post('/updatedailywork', [DaiyworkController::class, 'updatedailywork']);
    Route::get('/deletework/{id}', [DaiyworkController::class, 'deletework']);

    // Interview Routes
    Route::get('/interview', [InterviewController::class, 'interview']);
    Route::get('/addinterview', [InterviewController::class, 'addinterview']);
    Route::get('/viewinterview/{id}', [InterviewController::class, 'viewinterview']);
    Route::get('/interviewedit/{id}', [InterviewController::class, 'interviewedit']);
    Route::post('/submitinterview', [InterviewController::class, 'submitinterview']);
    Route::post('/updateinterview', [InterviewController::class, 'updateinterview']);
    Route::get('/deletinterview/{id}', [InterviewController::class, 'deletinterview']);

    // Candidate Interview Routes
    Route::get('/candidate-interview', [InterviewController::class, 'candidate_interview']);
    Route::get('/add-candidate-interview', [InterviewController::class, 'addcandidateinterview']);
    Route::get('/view-candidate-interview/{id}', [InterviewController::class, 'viewcandidateinterview']);
    Route::get('/edit-candidate-interview/{id}', [InterviewController::class, 'editcandidateinterview']);
    Route::post('/submitcandidatetinterview', [InterviewController::class, 'submicandidatetinterview']);
    Route::post('/updatecandidatetinterview', [InterviewController::class, 'updatecandidatetinterview']);
    Route::get('/delete-candidate-interview/{id}', [InterviewController::class, 'deletecandidateinterview']);

});

require __DIR__.'/auth.php';
