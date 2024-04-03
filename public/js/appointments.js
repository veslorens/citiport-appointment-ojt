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
            editForm.action = '/appointment/update/' + id;

            setValue('service_name', serviceName);
            setValue('service_type', serviceType);
            setValue('office', office);
            setValue('status', status);

        
        });
    });
}

// Function to set value of select element
function setValue(name, value) {
    const select = document.querySelector('#editForm select[name="' + name + '"]');
    const option = select.querySelector('option[value="' + value + '"]');
    if (option) {
        option.selected = true;
    }
}

// Call functions when DOM content is loaded
document.addEventListener('DOMContentLoaded', function() {
    handleEditAppointmentButtonClick();
});

// Function to handle delete appointment confirmation
function showDeleteConfirmation(appointmentId) {
    const modal = new bootstrap.Modal(document.getElementById('deleteAppointmentModal'), {
        keyboard: false
    });

    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = '/appointment/destroy/' + appointmentId;

    modal.show();
}
