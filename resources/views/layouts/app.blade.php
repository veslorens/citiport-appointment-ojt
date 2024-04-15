<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointments List</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project/appointment.css') }}">
</head>

<header>

</header>

<body>

    <div class="content">
        @yield('content')
        @include('appointment.modal.confirmation-options')
        @include('appointment.modal.empty-All')
        @include('appointment.modal.empty-Service-Details')
        @include('appointment.modal.empty-TimeSlots')
        @include('appointment.modal.success')



    </div>

    <footer>

    </footer>

    <script>
        var appointments = @json($appointments);
        var appointmentId = @json($appointment->id ?? null);
    </script>

    <script src="{{ asset('js/project/schedule.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/core/index.global.min.js') }}" defer></script>
    <script src="{{ asset('js/fullcalendar/daygrid/index.global.min.js') }}" defer></script>
</body>

</html>
