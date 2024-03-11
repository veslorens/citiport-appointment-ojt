<?php

namespace App\Http\Controllers;

use App\Models\appointment;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // $AllAppointment = appointment::all();
        // return view('appointment.index', ['appointments' => $AllAppointment]);

        $appointments = Appointment::paginate(10); // 10 items per page
        return view('appointment.index', ['appointments' => $appointments]);
    }



    public function create()
    {
        return view('appointment.create');
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

        $newAppointment = appointment::create($data);

        return redirect(route('appointment.index'))->with('success', 'Appointment created successfully!');
    }
}