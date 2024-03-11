<?php

namespace App\Http\Controllers;

use App\Models\appointments;

use Illuminate\Http\Request;

class appointmentsController extends Controller
{
    public function index()
    {
        $allAppointments = appointments::all();
        return view('appointments.index', ['appointments' => $allAppointments]);
    }

    public function create()
    {
        return view('appointments.create');
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

        $newAppointment = appointments::create($data);

        return redirect(route('appointments.index'))->with('success', 'Appointment created successfully!');
    }
}