@extends('layouts.app')

@section('title', 'Schedule')

@section('content')

    <div id="loading-overlay">
        <div class="spinner"></div>
    </div>

     <!-- Sidebar -->
     <div id="sidebar" class="sidebar">
        <button id="close-sidebar-btn">&times;</button>
        <h5 class="sidebar-username">Logged in as: {{ Auth::user()->name }}</h5>
        <a href="{{ route('logout') }}" class="logout-btn">Logout</a>
    </div>

    <!-- Page Content -->
    <div id="content">
        <button id="open-sidebar-btn">Open Sidebar</button>
    <div class="container mt-2" >
        <h1 class="text-center fs-3 mb-4">Appointments List</h1>

        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex" style="justify-content: space-between; margin-bottom: 10px; margin-right: 60px;">
            <span></span> 
            <a href="appointment/schedule" class="btn btn-primary btn-create-appointment">
                <i class="fa-solid fa-circle-plus"></i> Create Appointment
            </a>
        </div>

        <div class="table-container">
            <div class="table-responsive" style="text-align: center;">
                <table class="table table-bordered" style="margin: 0 auto; width: 90%;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Service Name</th>
                            <th scope="col">Service Type</th>
                            <th scope="col">Office</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date Booked</th>
                            <th scope="col">Time Booked</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($appointments as $appointment)
                            <tr>
                                <th>{{ $appointment->id }}</th>
                                <td>{{ $appointment->service_name }}</td>
                                <td>{{ $appointment->service_type }}</td>
                                <td>{{ $appointment->office }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>{{ date('Y-m-d', strtotime($appointment->booked_at)) }}</td>
                                <td>{{ date('h:i A', strtotime($appointment->created_at)) }}</td>
                                <td>
                                    <a href="{{ route('appointment.edit', ['id' => $appointment]) }}"
                                        class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button type="button" class="btn btn-danger"
                                        onclick="openDeleteModal({{ $appointment->id }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="" style="margin: 20px;">
                    {{ $appointments->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 text-left mt-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Logged in as: {{ Auth::user()->name }}</h5>
            </div>
        </div>
    </div>

    <div class="col-md-12 text-left mt-4">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link"><i class="fa-solid fa-right-from-bracket">Logout</i></button>
        </form>
    </div>

    @include('appointment.modal.delete')
@endsection
