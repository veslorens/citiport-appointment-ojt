@extends('layouts.app')

@section('title', 'Schedule')

@section('content')
    <div class="container mt-3 ">
        <div class="row">
            <div class="col-md-3 text-center">
                <div class="mt-2">
                    <h2 for="service_name" class="form-label">Service Name:</h2>
                </div>
                <div class="">
                    <form id="form1">
                        <div class="mb-3">
                            <label for="service_name" class="form-label">Service Name:</label>
                            <select name="service_name" id="service_name" class="form-select">
                                <option value="Business Permit Application">Business Permit Application</option>
                                <option value="Business Permit Renewal">Business Permit Renewal</option>
                                <option value="Payment of Business Permit">Payment of Business Permit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="service_type" class="form-label">Service Type:</label>
                            <br>
                            <select name="service_type" id="service_type" class="form-select">
                                <option value="New">New</option>
                                <option value="Renewal">Renewal</option>
                                <option value="Payment">Payment</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="office" class="form-label">Office:</label>
                            <br>
                            <select name="office" id="office" class="form-select">
                                <option value="BLPD">BLPD</option>
                                <option value="CSWDO">CSWDO</option>
                            </select>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <div>
                    <h1>Date</h1>
                    <p>To the extent possible, additional slots are made regularly.</p>
                </div>
                <div>
                    <div id="calendar"></div>
                </div>

                <div class="row">

                    <div class="col scheduleAvailable">Available</div>
                    <div class="col scheduleFullyBooked">Fully Booked</div>

                </div>

            </div>
            <div class="col-md-3 ">
                <div class="text-center">
                    <h1>Time</h1>
                    <div id="EarliestAvailableAppointment"></div>
                </div>
                <div class="mt-5">
                    <div id="radioForm"></div>
                </div>
            </div>

        </div>
    </div>
@endsection
