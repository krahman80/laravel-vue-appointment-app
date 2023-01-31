<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Resources\DoctorScheduleCollection;

class DoctorSchedulesController extends Controller
{
    public function getDate(Request $request, $user_id) {
        // return Schedule::select('date')->where('user_id', $user_id)->groupBy('date')->get();
        return new DoctorScheduleCollection(Schedule::select('date')->where('user_id', $user_id)->groupBy('date')->get());
    }

    public function getTime() {
        return null;
    }
}
