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
        @include('appointment.modal.sendReference')
    </div>

    <footer>

    </footer>


    <script>
        var appointments = @json($appointments);
        var appointmentId = @json($appointment->id ?? null);
        var booked_at = @json($appointment->booked_at ?? null);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('js/project/schedule.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/core/index.global.min.js') }}" defer></script>
    <script src="{{ asset('js/fullcalendar/daygrid/index.global.min.js') }}" defer></script>
</body>

</html>
