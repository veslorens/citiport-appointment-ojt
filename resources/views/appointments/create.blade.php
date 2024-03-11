<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Appointment Form</title>

    <!-- Bootstrap 5 CSS -->
     <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
     
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: auto;
        }

        .form-label {
            font-weight: bold;
        }

        .form-select option {
            letter-spacing: normal;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 5px;
        }

        .form-select {
            width: 100%;
            height: 40px;
            border-radius: 10px
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Appointment Form</h1>

        <!-- Bootstrap 5 Form -->
        <form id="createForm" method="post" action="{{ route('appointments.store') }}"
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

    <script>
        function validateForm() {
            // Reset error messages
            document.getElementById('serviceNameError').innerHTML = '';
            document.getElementById('serviceTypeError').innerHTML = '';
            document.getElementById('officeError').innerHTML = '';

            // Get form values
            var serviceName = document.getElementById('service_name').value;
            var serviceType = document.getElementById('service_type').value;
            var office = document.getElementById('office').value;

            // Validation logic (you can customize this according to your requirements)
            if (serviceName === '') {
                document.getElementById('serviceNameError').innerHTML = 'Please select a service name.';
                return false;
            }

            if (serviceType === '') {
                document.getElementById('serviceTypeError').innerHTML = 'Please select a service type.';
                return false;
            }

            if (office === '') {
                document.getElementById('officeError').innerHTML = 'Please select an office.';
                return false;
            }

            // Form is valid
            return true;
        }
    </script>
</body>

</html>
