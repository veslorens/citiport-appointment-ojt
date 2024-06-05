@extends('layouts.app')

@section('title', 'Schedule')

@section('content')

    <div class="container mt-5">
        <h1 class="text-center fs-3 mb-4">Appointments List</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-light">
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
                                <form action="{{ route('appointment.destroy', $appointment->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this appointment?')">Delete</button>
                                </form>
                                <a href="{{ route('appointment.edit', ['id' => $appointment]) }}"
                                    class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $appointments->links('pagination::bootstrap-4') }}
    </div>


@endsection
