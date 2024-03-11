<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Link to Bootstrap 5 CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Add the necessary Bootstrap JavaScript dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha384-GLhlTQ8iuboDFm49Kb4JSKlM+qzQ1LsL5PH8K6L5fGACC1/tbQeP2Jp5p6L4N2S"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"
            integrity="sha384-bC00J7pHEVdKvz87Z7v18avC79vphbqPLByAMaPFE/pfmfoD95rhe3L1LJZO"
            crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <title>Appointments</title>
</head>

<style>
    h1 {
        margin-top: 10px;
        background-color: #007bff;
        border-radius: 3px;
        padding-bottom: 5px;
        padding-left: 3px;
    }
</style>

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
        <h1 class="text-3xl font-semibold mb-4">Appointments</h1>
        <div class="table-responsive">
            <table class="table table-bordered">
                <!-- Your table structure remains the same -->
            </table>
        </div>
    </div>

    <script>
        // Automatically close the success alert after 2 seconds
        setTimeout(function () {
            $("#success-alert").alert('close');
        }, 2000);
    </script>

</body>

</html>
