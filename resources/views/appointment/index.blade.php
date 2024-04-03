<!-- views/tasks/index.blade.php -->
@extends('layouts.app')

@section('title', 'Appointments List')

@section('content')

    <div class="container mx-auto mt-4">

        <!-- Notification Success-->
        <div id="success-alert" class="alert alert-success alert-dismissible fade" role="alert">
            <!-- Success message will be inserted here dynamically -->
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


        <h1 class="text-3xl font-semibold mb-4 ">Appointments List</h1>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $appointments->links('pagination::bootstrap-4') }}
        </div>

    </div>


    <script>
        // JavaScript code
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = "{{ session('success') }}"; // Fetch success message from server

            if (successMessage) {
                var successAlert = document.getElementById('success-alert');
                successAlert.innerHTML = successMessage;
                successAlert.classList.add('show');

                // Automatically close the alert after a certain duration (e.g., 5 seconds)
                setTimeout(function() {
                    successAlert.classList.remove('show');
                    setTimeout(function() {
                        successAlert.classList.add('fade');
                    }, 300);
                }, 2000);
            }
        });
    </script>

@endsection
