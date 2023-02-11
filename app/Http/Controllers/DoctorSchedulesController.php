<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use App\Http\Resources\DoctorScheduleCollection;
use DB;

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

        // dd($request->route()->parameter('time'));

        $request->merge([
            'id' => $request->route()->parameter('id'),
            'date' => $request->route()->parameter('time')
        ]);

        $data = $request->validate([
            'id' => 'required|exists:users,id', 
            'date'=> 'date|date_format:Y-m-d|after:now'
        ]);

        // dd($data);

        $query = Schedule::select('id', 'start_time', 'end_time')
                ->where('user_id', $id)
                ->where('date', $date)
                ->whereNotIn('id', DB::table('appointments')->get()->pluck('schedule_id')->toArray())->get();

        if ($query->isEmpty()) {
            return response()->json(['data' => []], 404);
        }
        else {
            return new DoctorScheduleCollection($query);
        }

        // return schedules that has not booked yet
        // by filtering from schedule data from appointment data

    }

    public function store(Request $request) {
        // dd($request->input());
        // save into appointment table
        // before save check if appointment from the same user exist with status not approved yet
        // schedule id : 21,  doctor id : 2, patient id: 3, date: 2023-02-05

        // select * from appointment where schedule_id = 16 and doctor_id = 1 and patient_id = 4 and status = 0
        // if true return 402 cannot process, if false insert query
        // $roles = User::find(1)->roles()->orderBy('name')->get();
        
        // input bukan query
        // $schedule = Schedule::find(21)->appointments()->where('user_id', '3')->where('status', 0)->get();
        // dd($schedule);

        //ngecek itu yang statusnya 0 dan usernya 3, masuknya dari user
        // $user_schedule = User::find(3)->appointments()->wherePivot('user_id', '3')->wherePivot('status', 0)->get();
        
        // $user_schedule = User::find(3)->appointments()->get();
        // dd($user_schedule);

        //cari doctor schedule
        // 
        $doctor_schedule = User::find($request->input('doctor_id'))->schedules()->where('date', '>=', $request->input('date'))->get('id');
        $query = User::find($request->input('patient_id'))->appointments()->wherePivotIn('schedule_id', $doctor_schedule)->wherePivot('status', '0')->get();

        // dd($appo);
        if ($query->isEmpty()) {
            //insert data to database
            $user = User::find($request->input('patient_id'));
            $schedule = Schedule::find($request->input('schedule_id'));
            $schedule->appointments()->attach($user, ['status' => '0']);

            //if success update flag inside schedule to indicate that the schedule is booked


            // on update or remove schedule remove the flag

            return response()->json(['data' => []], 200);
        }
        else {
            return response()->json(['data' => []], 422);
            // return new DoctorScheduleCollection($query);
        }
    }
}
