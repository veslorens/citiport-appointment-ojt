<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function create()
    {
        return view('appointment.create');
    }

    public function schedule()
    {
        $appointments = Appointment::all();
        return view('appointment.schedule', [
            'appointments' => $appointments
        ]);
    }

    public function store(Request $request)
    {
        $booked_at = $request->input('booked_at');
        $service_name = $request->input('service_name');
        $service_type = $request->input('service_type');
        $office = $request->input('office');

        $data['service_name'] = $service_name;
        $data['service_type'] = $service_type;
        $data['office'] = $office;
        $data['status'] = 'status';
        $data['created_at'] = $booked_at;
        $data['booked_at'] = $booked_at;
        $data['updated_at'] = $booked_at;

        $newAppointment = Appointment::create($data);
        return redirect(route('appointment.schedule'));
    }
}
