<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorSchedulesController;
use App\Models\Schedule;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('doctors', DoctorController::class)->only(['index','show']);
Route::get('doctors/{id}/schedule', [DoctorSchedulesController::class, 'getDate'])->name('doctors.shedule');
Route::get('doctors/{id}/schedule/{time}', [DoctorSchedulesController::class, 'getTime'])->name('doctors.schedule.time');