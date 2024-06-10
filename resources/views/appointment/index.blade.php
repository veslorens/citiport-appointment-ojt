@extends('layouts.app')

@section('title', 'Schedule')

@section('content')

    <div id="sidebar" class="sidebar">
        <hr class="first-hr">
        <ul class="nav nav-pills flex-column mb-auto mt-9">
            <li class="nav-item">
                <a href="{{ route('appointment.index') }}" class="nav-link link-dark">
                    <i class="fa-solid fa-list-ol me-2"></i> Appointments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('appointment.schedule') }}" class="nav-link link-dark">
                    <i class="fa-solid fa-calendar-check me-2"></i> Book an Appointment
                </a>
            </li>
            @if (Auth::user()->isSuperAdmin())
                <li class="nav-item">
                    <a href="{{ route('superadmin.users') }}" class="nav-link link-dark">
                        <i class="fa-solid fa-users me-2"></i> Admins
                    </a>
                </li>
            @endif
        </ul>
        <hr class="second-hr">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                id="dropdownUser1" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow custom-dropdown-menu"
                aria-labelledby="dropdownUser1" style="">
                <li>
                    <form id="logout-form-dropdown" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div id="content">
        <button id="open-sidebar-btn" class="btn btn-primary"><i class="fa-solid fa-bars"></i></button>
        <div class="container mt-2">
            <h1 class="text-center fs-3 mb-4">Appointments List</h1>

            @if (session('success'))
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('appointment.schedule') }}" class="btn btn-primary btn-create-appointment">
                    <i class="fa-solid fa-circle-plus"></i> Create Appointment
                </a>
                <div class="col-md-4">
                    <form action="{{ route('appointment.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="query" id="searchInput" class="form-control search-input"
                            placeholder="Search by ID, service name, or office" value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                    </form>
                </div>
            </div>

            <div class="table-container" style="width:100%">
                <div class="table-responsive text-center">
                    <table class="table table-bordered mx-auto">
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
                        <tbody id="AppointmentTableBody">
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
                                            class="btn btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST"
                                            style="display: inline;" id="deleteForm{{ $appointment->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-btn"
                                                data-id="{{ $appointment->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-4">
                        {{ $appointments->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
