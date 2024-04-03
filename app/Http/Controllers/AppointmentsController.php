<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    public function index()
    {
        $appointment = Appointment::paginate(10);
        return view('appointment.index', ['appointments' => $appointment]);
    }

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

    public function update(Appointment $appointment, Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:100',
            'service_type' => 'required|string|max:100',
            'office' => 'required|string|max:100',
            'status' => 'required|string|max:100',

        ]);

        $appointment->update($data);
        return redirect(route('appointment.index'))->with('success', 'Appointment updated Successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect(route('appointment.index'))->with('success', 'Appointment deleted Successfully');
    }
}
