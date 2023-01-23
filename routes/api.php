<?php

use App\Http\Controllers\ApiAuthentication;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'oauth'], function () {
    // Public Routes
    Route::post('login', [ApiAuthentication::class, 'login']);
    // Authenticated Routes
    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('/callback', [ApiController::class, 'callback']);
        Route::post('/getWorksUpdate', [ApiController::class, 'getWorksUpdate']);
        Route::post('/getWeekUpdate', [ApiController::class, 'getWeekUpdate']);
        Route::post('/dailyStart', [ApiController::class, 'dailyStart']);
        Route::post('/dailyStartUpdate', [ApiController::class, 'dailyStartUpdate']);
        Route::post('/dailyStartStop', [ApiController::class, 'dailyStartStop']);
        Route::post('/WeeklyUpdate', [ApiController::class, 'weeklyUpdate']);
    });
});
