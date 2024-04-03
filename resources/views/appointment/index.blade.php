@extends('layouts.app')

@section('title', 'Appointments List')

@section('content')

    <div class="container mx-auto mt-4">
        <div id="success-alert" class="alert alert-success alert-dismissible fade" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

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
                                <<<<<<< HEAD </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" style="width: 100px;"
                                        data-bs-toggle="modal" data-bs-target="#editAppointmentModal">
                                        Edit
                                    </button>

                                    <!-- Trigger modal on delete button click -->
                                    <button type="button" class="btn btn-danger"
                                        style="width: 100px; display: inline-block;"
                                        data-bs-target="#deleteAppointmentModal" data-bs-toggle="modal"
                                        onclick="showDeleteConfirmation({{ $appointment->id }})">Delete</button>
                                    =======
                                    <!-- Button trigger modal -->
                                    <div class="btn-group" role="actions">
                                        <button type="button" class="btn btn-primary editAppointmentButton"
                                            style="width: 60px; font-size: 15px;" data-bs-toggle="modal"
                                            data-bs-target="#editAppointmentModal" data-id="{{ $appointment->id }}"
                                            data-service-name="{{ $appointment->service_name }}"
                                            data-service-type="{{ $appointment->service_type }}"
                                            data-office="{{ $appointment->office }}"
                                            data-status="{{ $appointment->status }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger" style="width: 60px; font-size: 15px;"
                                            data-bs-target="#deleteAppointmentModal" data-bs-toggle="modal"
                                            onclick="showDeleteConfirmation({{ $appointment->id }})"><i
                                                class="fa-solid fa-trash"></i></button>
                                    </div>

                                    >>>>>>> 338e331cd78d8d82fa92d7a9d52af13352a9b2fd
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <<<<<<< HEAD {{ $appointments->links('pagination::bootstrap-4') }} </div>
        </div>




        {{-- Edit Modal --}}
        <div class="modal fade" id="editAppointmentModal" tabindex="-1" aria-labelledby="editAppointmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" method="post"
                            action="{{ route('appointment.update', ['appointment' => $appointment->id]) }}"
                            onsubmit="return validateForm()">
                            @csrf <!-- CSRF Token -->
                            @method('put')
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

                            <div class="mb-3">
                                <label for="service_type" class="form-label">Service Type:</label>
                                <br>
                                <select name="service_type" id="service_type" class="form-select">
                                    <option value="New" {{ $appointment->service_type == 'New' ? 'selected' : '' }}>New
                                    </option>
                                    <option value="Renewal"
                                        {{ $appointment->service_type == 'Renewal' ? 'selected' : '' }}>
                                        Renewal</option>
                                    <option value="Payment"
                                        {{ $appointment->service_type == 'Payment' ? 'selected' : '' }}>
                                        Payment</option>
                                </select>
                                <div id="serviceTypeError" class="error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="office" class="form-label">Office:</label>
                                <br>
                                <select name="office" id="office" class="form-select">
                                    <option value="BLPD" {{ $appointment->office == 'BLPD' ? 'selected' : '' }}>BLPD
                                    </option>
                                    <option value="CSWDO" {{ $appointment->office == 'CSWDO' ? 'selected' : '' }}>CSWDO
                                    </option>
                                </select>
                                <div id="officeError" class="error"></div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status:</label>
                                <br>
                                <select name="status" id="status" class="form-select">
                                    <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="InProgress"
                                        {{ $appointment->status == 'InProgress' ? 'selected' : '' }}>In
                                        Progress</option>
                                    <option value="Rejected" {{ $appointment->status == 'Rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                </select>
                                <div id="statusError" class="error"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>







        {{-- Create Appointment Modal --}}
        <div class="modal fade" id="createAppointmentModal" tabindex="-1" aria-labelledby="createAppointmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createForm" method="post" action="{{ route('appointment.store') }}"
                            onsubmit="return validateForm()">
                            @csrf <!-- CSRF Token -->
                            @method('post')
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

                            <div class="mb-3">
                                <label for="office" class="form-label">Office:</label>
                                <br>
                                <select name="office" id="office" class="form-select">
                                    <option value="BLPD">BLPD</option>
                                    <option value="CSWDO">CSWDO</option>
                                </select>
                                <div id="officeError" class="error"></div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>





        {{-- Delete Modal --}}
        <div class="modal" id="deleteAppointmentModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Appointment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this appointment?</p>
                    </div>
                    <div class="modal-footer">
                        <form id="delete-form" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    </div>
                    =======
                    <div class="d-flex justify-content-end">
                        {{ $appointments->links('pagination::bootstrap-4') }}
                        >>>>>>> 338e331cd78d8d82fa92d7a9d52af13352a9b2fd
                    </div>
                </div>
            </div>


            <script>
                // Function to handle edit appointment button clicks
                function handleEditAppointmentButtonClick() {
                    document.querySelectorAll('.editAppointmentButton').forEach(button => {
                        button.addEventListener('click', function() {
                            const id = this.getAttribute('data-id');
                            const serviceName = this.getAttribute('data-service-name');
                            const serviceType = this.getAttribute('data-service-type');
                            const office = this.getAttribute('data-office');
                            const status = this.getAttribute('data-status');

                            const editForm = document.getElementById('editForm');
                            editForm.action = `/appointment/update/${id}`;

                            setValue('service_name', serviceName);
                            setValue('service_type', serviceType);
                            setValue('office', office);
                            setValue('status', status);
                        });
                    });
                }

                // Function to set value of select element
                function setValue(name, value) {
                    const select = document.querySelector(`#editForm select[name="${name}"]`);
                    const option = select.querySelector(`option[value="${value}"]`);
                    if (option) {
                        option.selected = true;
                    }
                }

                // Call functions when DOM content is loaded
                document.addEventListener('DOMContentLoaded', function() {
                    const successMessage = "{{ session('success') }}";
                    const successAlert = document.getElementById('success-alert');

                    if (successMessage) {
                        showSuccessMessage(successMessage);
                    }

                    handleEditAppointmentButtonClick();
                });

                // Function to display success message
                function showSuccessMessage(message) {
                    const successAlert = document.getElementById('success-alert');
                    successAlert.innerHTML = message;
                    successAlert.classList.add('show');
                    setTimeout(() => {
                        successAlert.classList.remove('show');
                        successAlert.classList.add('fade');
                    }, 2000);
                }

                // Function to handle delete appointment confirmation
                function showDeleteConfirmation(appointmentId) {
                    const modal = new bootstrap.Modal(document.getElementById('deleteAppointmentModal'), {
                        keyboard: false
                    });

                    <<
                    << << < HEAD
                    var deleteForm = document.getElementById('delete-form');
                    deleteForm.action = "{{ route('appointment.destroy', ['appointment' => ':id']) }}".replace(':id', ===
                        === =
                        const deleteForm = document.getElementById('delete-form'); deleteForm.action =
                        `{{ route('appointment.destroy', ['appointment' => ':id']) }}`.replace(':id', >>>
                            >>> > 338e331 cd78d8d82fa92d7a9d52af13352a9b2fd appointmentId);

                        modal.show();
                    }
            </script>

            <<<<<<< HEAD {{-- Create Apppointment Modal Script --}} <script>
                document.addEventListener("DOMContentLoaded", function() {

                    var modal = document.querySelector('.modal');
                    var closeButton = modal.querySelector('.btn-close');
                    var createAppointmentBtn = document.getElementById('createAppointmentModal');

                    function openModal() {
                        modal.style.display = 'block';
                    }

                    function closeModal() {
                        modal.style.display = 'none';
                    }

                    // Add click event listener to the button that triggers the modal
                    createAppointmentBtn.addEventListener('click', openModal);

                    // Add click event listener to the close button inside the modal
                    closeButton.addEventListener('click', closeModal);

                    // Add click event listener to the modal backdrop (if clicked outside the modal, close it)
                    modal.addEventListener('click', function(event) {
                        if (event.target === modal) {
                            closeModal();
                        }
                    });

                    // Function to handle form validation
                    function validateForm() {
                        // Your form validation logic here
                    }
                });
            </script>


            {{-- Edit Modal Script --}}
            <script>
                // Function to handle submission of the edit form
                function submitEditForm() {
                    var form = document.getElementById('editForm');
                    if (validateForm()) {
                        // Get the selected values from the form
                        var serviceName = document.getElementById('service_name').value;
                        var serviceType = document.getElementById('service_type').value;
                        var office = document.getElementById('office').value;
                        var status = document.getElementById('status').value;

                        // Update the appointment details directly in the table
                        var appointmentRow = document.getElementById('appointment_row');
                        appointmentRow.cells[1].innerText = serviceName;
                        appointmentRow.cells[2].innerText = serviceType;
                        appointmentRow.cells[3].innerText = office;
                        appointmentRow.cells[4].innerText = status;

                        // Close the modal
                        hideEditModal();
                    }
                }

                // Function to show the edit modal and populate the form with appointment details
                function showEditModal(appointment) {
                    var editModal = new bootstrap.Modal(document.getElementById('editAppointmentModal'));

                    // Populate the form with appointment details
                    document.getElementById('service_name').value = appointment.service_name;
                    document.getElementById('service_type').value = appointment.service_type;
                    document.getElementById('office').value = appointment.office;
                    document.getElementById('status').value = appointment.status;

                    editModal.show();
                }

                // Attach event listener to show the modal and populate form on edit button click
                document.querySelectorAll('.editAppointmentButton').forEach(button => {
                    button.addEventListener('click', function() {
                        var appointmentId = this.dataset.appointmentId;
                        var appointment = getAppointDetailsById(appointmentId);
                        showEditModal(appointment);
                    });
                });

                // Function to hide the edit modal
                function hideEditModal() {
                    var editModal = new bootstrap.Modal(document.getElementById('editAppointmentModal'));
                    editModal.hide();
                }
            </script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            =======
            @include('appointment.modals.edit')
            @include('appointment.modals.create')
            @include('appointment.modals.delete')
            >>>>>>> 338e331cd78d8d82fa92d7a9d52af13352a9b2fd
        @endsection
