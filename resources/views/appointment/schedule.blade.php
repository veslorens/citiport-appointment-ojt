@extends('layouts.app')

@section('title', 'Schedule')

@section('content')

<div id="sidebar" class="sidebar">
    <hr class="first-hr">
    <ul class="nav nav-pills flex-column mb-auto mt-9">
        <li class="nav-item">
            <a href="{{ route('appointment.index') }}" class="nav-link link-dark" >
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
    <div class="container">
        
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Service Details</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-1">
                                <label for="service_name" class="form-label">Service Name:</label>
                                <select name="service_name" id="service_name" class="form-select">
                                    <option value="">Select Service Name</option>
                                    <option value="Business Permit Application">Business Permit Application</option>
                                    <option value="Business Permit Renewal">Business Permit Renewal</option>
                                    <option value="Payment of Business Permit">Payment of Business Permit</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="service_type" class="form-label">Service Type:</label>
                                <select name="service_type" id="service_type" class="form-select">
                                    <option value="">Select Service Type</option>
                                    <option value="New">New</option>
                                    <option value="Renewal">Renewal</option>
                                    <option value="Payment">Payment</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="office" class="form-label">Office:</label>
                                <select name="office" id="office" class="form-select">
                                    <option value="">Select Office</option>
                                    <option value="BLPD">BLPD</option>
                                    <option value="CSWDO">CSWDO</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>

            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="card-title">Date</h5>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col selectedDate">Selected Date</div>
                            <div class="col scheduleAvailable">Available</div>
                            <div class="col scheduleFullyBooked">Fully Booked</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Time</h5>
                    </div>
                    <div class="card-body">
                        <div id="EarliestAvailableAppointment"></div>
                        <br>
                        <div id="radioForm" class="text-center"></div>
                    </div>
                    <div class="card-footer text-center">
                        <div id="submitButton"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection