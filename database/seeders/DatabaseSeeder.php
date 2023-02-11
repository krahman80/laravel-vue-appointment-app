<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Schedule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Services\TimeSlot;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit doctor profile']);
        Permission::create(['name' => 'approve appointment request']);
        Permission::create(['name' => 'reject appointment request']);
        Permission::create(['name' => 'submit appointment request']);
        
        // Create Role
        $patientRole = Role::create(['name' => 'patient']);
        $doctorRole = Role::create(['name' => 'doctor']);
        $administratorRole = Role::create(['name' => 'administrator']);

        // $patient->givePermissionTo('submit appointment request');
        $patientRole->givePermissionTo('submit appointment request');
        $administratorRole->givePermissionTo(['approve appointment request', 'reject appointment request', 'edit doctor profile']);

        $docResult = User::factory(10)->create()->each(function($user) {
            $user->assignRole('doctor');
        });

        
        /**
         * create doctor account and schedule
         */

        $str_start = date("Y-m-d 08:00",strtotime('tomorrow'));
        $start = strtotime($str_start);
        
        $str_end = date("Y-m-d 09:00", strtotime('+2 months', strtotime($str_start)));
        $end = strtotime($str_end);

        // $start = strtotime('2/12/2023 07:00');
        // $end = strtotime('3/23/2023 09:00');

        $dateResult = array();
        while ($start <= $end) {
            if (date('N', $start) <= 5) {
                $start_st = date('Y-m-d H:i', $start);
                $end_st = date('Y-m-d H:i', $end);
                $dateResult[] = [$start_st, $end_st];
            }
            $start += 86400;
        }

        foreach($dateResult as $key => $val){
            foreach ($docResult as $doc){
                // echo $val[0] . "--" . $val[1] ."-".$doc."\n";
                
                //add time
                $randStartTime = rand(0,2);
                $randEndTime = $randStartTime + 2;

                $initStart = date('Y-m-d H:i',strtotime('+'.$randStartTime.' hour',strtotime($val[0])));
                $initEnd = date('Y-m-d H:i',strtotime('+'.$randEndTime.' hour',strtotime($val[1])));

                //generate new timeslot
                $timeSlotXXX = new TimeSlot($initStart, $initEnd, 20);
                $resultXXX = $timeSlotXXX->generate();
                
                foreach($resultXXX as $fin) {
                    
                    Schedule::create([
                        'user_id' => $doc->id,
                        'date' => $fin['date'],
                        'start_time' => $fin['start_time'],
                        'end_time' => $fin['end_time'],
                    ]);

                }

            }
            
        }


        /**
         * create other user
         */
        $patientYYY = User::factory()->create([
            'name' => 'userYYY',
            'email' => 'userYYY@mail.com',
        ]);

        $patientYYY->assignRole('patient');
        $patientYYY->givePermissionTo('submit appointment request');

        $patientZZZ = User::factory()->create([
            'name' => 'userZZZ',
            'email' => 'userZZZ@mail.com',
        ]);

        $patientZZZ->assignRole('patient');
        $patientZZZ->givePermissionTo('submit appointment request');

        $administrator = User::factory()->create([
            'name' => 'adminZZZ',
            'email' => 'adminZZZ@mail.com',
        ]);

        $administrator->givePermissionTo(['approve appointment request', 'reject appointment request', 'edit doctor profile']);

    }

}
