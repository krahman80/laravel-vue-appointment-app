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

      
        // create doctor
        $doctorXXX = User::factory()->create([
            'name' => 'doctorXXX',
            'email' => 'doctorXXX@mail.com',
        ]);

        $doctorXXX->assignRole('doctor');

        //create time slot for doctor
        $timeSlotXXX = new TimeSlot('2023-03-01 08:30:00', '2023-03-01 12:00:00', 20);
        $resultXXX = $timeSlotXXX->generate();

        foreach ($resultXXX as $value) {
            Schedule::create([
                'user_id' => $doctorXXX->id,
                'date' => $value['date'],
                'start_time' => $value['start_time'],
                'end_time' => $value['end_time'],
            ]);
        }

        //create timeslot for doctor
        $timeSlotXXX2 = new TimeSlot('2023-03-02 08:30:00', '2023-03-02 12:00:00', 20);
        $resultXXX2 = $timeSlotXXX2->generate();

        foreach ($resultXXX2 as $value) {
            Schedule::create([
                'user_id' => $doctorXXX->id,
                'date' => $value['date'],
                'start_time' => $value['start_time'],
                'end_time' => $value['end_time'],
            ]);
        }

        //create new doctor
        $doctorYYY = User::factory()->create([
            'name' => 'doctorYYY',
            'email' => 'doctorYYY@mail.com',
        ]);

        $doctorYYY->assignRole('doctor');
        $timeSlotYYY = new TimeSlot('2023-03-01 12:30:00', '2023-03-01 17:00:00', 20);
        $resultYYY = $timeSlotYYY->generate();

        foreach ($resultYYY as $value) {
            Schedule::create([
                'user_id' => $doctorYYY->id,
                'date' => $value['date'],
                'start_time' => $value['start_time'],
                'end_time' => $value['end_time'],
            ]);
        }

        // create user
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
