<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Form</title>

    <!-- Bootstrap 5 CSS -->
     <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
     
  
</head>

<body>
    <div class="container mt-5">
        <h1>Appointment Form</h1>

        <!-- Bootstrap 5 Form -->
        <form id="createForm" method="post" action="{{ route('appointment.store') }}"
            onsubmit="return validateForm()">
            @csrf <!-- CSRF Token -->
            @method('post')

            <!-- Service Name Dropdown -->
            <div class="mb-3">
                <label for="service_name" class="form-label">Service Name:</label>
                <br>
                <select name="service_name" id="service_name" class="form-select">
                    <option value="Business Permit Application">Business Permit Application</option>
                    <option value="Business Permit Renewal">Business Permit Renewal</option>
                    <option value="Payment of Business Permit">Payment of Business Permit</option>
                </select>
                <div id="serviceNameError" class="error"></div>
            </div>

            <!-- Service Type Dropdown -->
            <div class="mb-3">
                <label for="service_type" class="form-label">Service Type:</label>
                <br>
                <select name="service_type" id="service_type" class="form-select">
                    <option value="New">New</option>
                    <option value="Renewal">Renewal</option>
                    <option value="Payment">Payment</option>
                </select>
                <div id="serviceTypeError" class="error"></div>
            </div>

            <!-- Office Dropdown -->
            <div class="mb-3">
                <label for="office" class="form-label">Office:</label>
                <br>
                <select name="office" id="office" class="form-select">
                    <option value="BLPD">BLPD</option>
                    <option value="CSWDO">CSWDO</option>
                </select>
                <div id="officeError" class="error"></div>
            </div>

            <!-- Input Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>
