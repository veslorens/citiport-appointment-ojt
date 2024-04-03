@extends('layouts.app')

@section('title', 'Appointments List')

@section('content')

    <div class="container mx-auto mt-4">

        @if (session('success'))
            <div id="success-alert" class="alert alert-success mx-auto mt-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="error-alert" class="alert alert-danger mx-auto mt-4">
                {{ session('error') }}
            </div>
        @endif


        <h1 class="text-3xl font-semibold mb-4">Appointments List</h1>

        <div class="button-container">
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createAppointmentModal" style="margin: 10px;">
                        <i class="fa-solid fa-circle-plus"></i> Create Appointment
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">

                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Service Name</th>
                        <th scope="col">Service Type</th>
                        <th scope="col">Office</th>
                        <th scope="col">Status</th>
                        <th scope="col">Booked At</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Updated At</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->service_name }}</td>
                            <td>{{ $appointment->service_type }}</td>
                            <td>{{ $appointment->office }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>{{ $appointment->booked_at }}</td>
                            <td>{{ $appointment->created_at }}</td>
                            <td>{{ $appointment->updated_at }}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <div class="btn-group" role="actions">
                                    <button type="button" class="btn btn-primary editAppointmentButton"
                                        style="width: 60px; font-size: 15px;" data-bs-toggle="modal"
                                        data-bs-target="#editAppointmentModal" data-id="{{ $appointment->id }}"
                                        data-service-name="{{ $appointment->service_name }}"
                                        data-service-type="{{ $appointment->service_type }}"
                                        data-office="{{ $appointment->office }}" data-status="{{ $appointment->status }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <button type="button" class="btn btn-danger" style="width: 60px; font-size: 15px;"
                                        data-bs-target="#deleteAppointmentModal" data-bs-toggle="modal"
                                        onclick="showDeleteConfirmation({{ $appointment->id }})">
                                        <i class="fa-solid fa-trash"></i></button>
                                </div>



                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $appointments->appends(['page' => $currentPage])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    <script>
    setTimeout(function() {
        const alertElement = document.querySelector('.alert');
        if (alertElement) {
            alertElement.classList.add('fade-out');
            setTimeout(function() {
                alertElement.style.display = 'none';
                window.scrollTo(0, 0); // Scrolls to the top of the page
            }, 2000); // Adjust the timeout based on your animation duration
        }
    }, 2000);
</script>
    <script src="{{ asset('js/appointments.js') }}"></script>

    @include('appointment.modals.edit')
    @include('appointment.modals.create')
    @include('appointment.modals.delete')
@endsection
