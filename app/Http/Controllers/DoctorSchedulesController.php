<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Resources\DoctorScheduleCollection;

class DoctorSchedulesController extends Controller
{
    public function getDate($id, Request $request) {
        // return Schedule::select('date')->where('user_id', $user_id)->groupBy('date')->get();
        $query = Schedule::select('date')->where('user_id', $id)->groupBy('date')->get();
        if ($query->isEmpty()) {
            return response()->json(['data' => []], 404);
        }
        else {
            return new DoctorScheduleCollection($query);
        }
        
    }

    public function getTime($id, $date, Request $request) {
        // dd($id . " and " . $date);
        return new DoctorScheduleCollection(Schedule::select('start_time', 'end_time')->where('user_id', $id)->where('date', $date)->get());
    }
}
