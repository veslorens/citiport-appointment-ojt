<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
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
        $client_name = $request->input('client_name'); // Add this line to retrieve client_name
        $client_contact_no = $request->input('client_contact_no'); // Add this line to retrieve client_contact_no

        $data['service_name'] = $service_name;
        $data['service_type'] = $service_type;
        $data['office'] = $office;
        $data['client_name'] = $client_name; // Add client_name to the data array
        $data['client_contact_no'] = $client_contact_no; // Add client_contact_no to the data array
        $data['status'] = 'Pending';
        $data['booked_at'] = $booked_at;
        $data['updated_at'] = Carbon::now()->toDateTimeString();
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $newAppointment = Appointment::create($data);
        return response()->json(['id' => $newAppointment->id]);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointments = Appointment::all();
        return view("appointment.edit", ['appointment' => $appointment, 'appointments' => $appointments]);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->booked_at = $request->input('booked_at');
        $appointment->service_name = $request->input('service_name');
        $appointment->service_type = $request->input('service_type');
        $appointment->office = $request->input('office');
        $appointment->updated_at = date('Y-m-d H:i:s');
        $appointment->save();
        return response()->json(['message' => 'Appointment updated successfully'], 200);
    }
}
