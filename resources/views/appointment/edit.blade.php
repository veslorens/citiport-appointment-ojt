@extends('layouts.app')
@section('title', 'Schedule')
@section('content')
    <div class="container mt-4 ">

        <div class="row justify-content-center">
            <div class="text-center">
                <h3>Edit Form</h3>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Service Details</h2>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-1">
                                <label for="service_name" class="form-label">Service Name:</label>
                                <select name="service_name" id="service_name" class="form-select">
                                    <option value="">Select Service Name</option>
                                    <option value="Business Permit Application"
                                        {{ $appointment->service_name == 'Business Permit Application' ? 'selected' : '' }}>
                                        Business
                                        Permit Application</option>
                                    <option value="Business Permit Renewal"
                                        {{ $appointment->service_name == 'Business Permit Renewal' ? 'selected' : '' }}>
                                        Business
                                        Permit Renewal</option>
                                    <option value="Payment of Business Permit"
                                        {{ $appointment->service_name == 'Payment of Business Permit' ? 'selected' : '' }}>
                                        Payment
                                        of Business Permit</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="service_type" class="form-label">Service Type:</label>
                                <select name="service_type" id="service_type" class="form-select">
                                    <option value="">Select Service Type</option>
                                    <option value="New" {{ $appointment->service_type == 'New' ? 'selected' : '' }}>New
                                    </option>
                                    <option value="Renewal" {{ $appointment->service_type == 'Renewal' ? 'selected' : '' }}>
                                        Renewal</option>
                                    <option value="Payment" {{ $appointment->service_type == 'Payment' ? 'selected' : '' }}>
                                        Payment</option>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label for="office" class="form-label">Office:</label>
                                <select name="office" id="office" class="form-select">
                                    <option value="">Select Office</option>
                                    <option value="BLPD" {{ $appointment->office == 'BLPD' ? 'selected' : '' }}>BLPD
                                    </option>
                                    <option value="CSWDO" {{ $appointment->office == 'CSWDO' ? 'selected' : '' }}>CSWDO
                                    </option>
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
                    <div class="card-header">
                        <h2 class="card-title">Date</h2>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col scheduleAvailable">Available</div>
                            <div class="col scheduleFullyBooked">Fully Booked</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title text-center">Time</h2>
                    <div id="EarliestAvailableAppointment"></div>
                </div>
                <div class="card-body">
                    <div id="radioForm" class="text-center"></div>
                </div>
                <div class="card-footer text-center">
                    <div id="submitButton"></div>
                </div>
            </div>
        </div>

    @endsection
