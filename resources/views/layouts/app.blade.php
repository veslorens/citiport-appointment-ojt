<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Appointments List</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
</head>

<header>

</header>

<body>


    <div class="content">

        @yield('content')

    </div>

    <footer>

    </footer>

    <script>
        var appointments = @json($appointments);
    </script>

    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/core/index.global.min.js') }}" defer></script>
    <script src="{{ asset('js/fullcalendar/daygrid/index.global.min.js') }}" defer></script>

    {{-- @isset($appointments)
    @endisset --}}



    <script src="{{ asset('js/project/schedule.js') }}"></script>

</body>

</html>
