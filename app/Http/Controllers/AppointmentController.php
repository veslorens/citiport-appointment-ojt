<?php

namespace App\Http\Controllers;

use App\Models\appointment;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointment = appointment::paginate(10);
        return view('appointment.index', ['appointments' => $appointment]);
    }

    public function create()
    {
        return view('appointment.create');
    }

    public function schedule()
    {
        return view('appointment.schedule');
    }

    
   

    public function store(Request $request)
    {
        $data = $request->validate([
            'service_name' => 'required|string|max:100',
            'service_type' => 'required|string|max:100',
            'office' => 'required|string|max:100',
        ]);
        // Set default values and timestamps
        $data['status'] = 'Pending';
        $data['created_at'] = now();
        $data['booked_at'] = now();

        $NewAppointment = Appointment::create($data);
        return redirect(route('appointment.index'))->with('success', 'Appointment created successfully!');
    }

    public function edit(Appointment $appointment)
{
    return view('appointment.edit', compact('appointment'));
}

    

    public function update (Appointment $appointment, Request $request){
        $data = $request->validate([
            'service_name' => 'required|string|max:100',
            'service_type' => 'required|string|max:100',
            'office' => 'required|string|max:100',
            'status' => 'required|string|max:100',
            
        ]);

        $appointment->update($data);
        return redirect(route('appointment.index'))->with('success', 'Appointment updated Successfully');
    }

    public function destroy(Appointment $appointment){
        $appointment->delete();
        return redirect(route('appointment.index'))->with('success', 'Appointment deleted Successfully');

    }
    
}

