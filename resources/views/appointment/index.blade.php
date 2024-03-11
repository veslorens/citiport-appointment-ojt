<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Link to Bootstrap 5 CSS -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    
    <title>Appointment</title>
</head>


<body>
   @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    
 <div class="container mx-auto">
    <h1 class="text-3xl font-semibold mb-4 ">Appointments</h1>
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
                @foreach($appointments as $appointment)
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
    </div>
</div>


    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Automatically close the success alert after 2 seconds
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.getElementById("success-alert").style.display = "none";
            }, 2000);
        });
    </script>

</body>

</html>
