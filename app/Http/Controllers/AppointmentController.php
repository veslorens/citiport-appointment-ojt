<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::paginate(10);
        return view('appointment.index', ['appointments' => $appointments]);
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
        $request->validate([
            'booked_at' => 'required|date',
            'service_name' => 'required|string',
            'service_type' => 'required|string',
            'office' => 'required|string',
        ]);

        $data = $request->only(['booked_at', 'service_name', 'service_type', 'office']);
        $data['status'] = 'Pending';
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();

        Appointment::create($data);

        return redirect(route('appointment.schedule'))->with('success', 'Appointment created successfully!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return redirect()->back()->with('success', 'Appointment deleted successfully!');
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

        $request->validate([
            'booked_at' => 'required|date',
            'service_name' => 'required|string',
            'service_type' => 'required|string',
            'office' => 'required|string',
        ]);

        $appointment->update($request->only(['booked_at', 'service_name', 'service_type', 'office']));

        return response()->json(['message' => 'Appointment updated successfully'], 200);
    }
}
