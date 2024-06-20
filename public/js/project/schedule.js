
linkId = false;
if (appointmentId) {
    console.log("Appointment ID:", appointmentId);
    linkId = true;
} else {
    console.log("No appointment ID available.");
    linkId = false;
}

var workingDays = 20;
var slotsPerTime = 1;
var opening = 8;
var closing = 10;

function emptyAll() {
    var modal = document.getElementById("emptyAll");
    modal.classList.add("show");
    modal.style.display = "block";
}

function closeEmptyAll() {
    var modal = document.getElementById("emptyAll");
    modal.classList.remove("show");
    modal.style.display = "none";
}

function emptyTimeSlots() {
    var modal = document.getElementById("emptyTimeSlots");
    modal.classList.add("show");
    modal.style.display = "block";
}

function closeEmptyTimeSlots() {
    var modal = document.getElementById("emptyTimeSlots");
    modal.classList.remove("show");
    modal.style.display = "none";
}

function emptyServiceDetails() {
    var modal = document.getElementById("emptyServiceDetails");
    modal.classList.add("show");
    modal.style.display = "block";
}

function closeEmptyServiceDetails() {
    var modal = document.getElementById("emptyServiceDetails");
    modal.classList.remove("show");
    modal.style.display = "none";
}

function confirmationOptions() {
    var modal = document.getElementById("confirmationOptions");
    modal.classList.add("show");
    modal.style.display = "block";
}

function closeConfirmationOptions() {
    var modal = document.getElementById("confirmationOptions");
    modal.classList.remove("show");
    modal.style.display = "none";
}

function success() {
    var modal = document.getElementById("success");
    modal.classList.add("show");
    modal.style.display = "block";
}

function closeSuccess() {
    var modal = document.getElementById("success");
    modal.classList.remove("show");
    modal.style.display = "none";
    window.location.reload();
}

/////////////////////////////////////////

// Appointment Delete SweetAlert
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const appointmentId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + appointmentId).submit();
                }
            });
        });
    });
});

setTimeout(function() {
    var successAlert = document.getElementById('successAlert');
    successAlert.style.display = 'none';
}, 2000);

 /// Sidebar
 document.addEventListener('DOMContentLoaded', function() {
    var openSidebarBtn = document.getElementById('open-sidebar-btn');
    var sidebar = document.getElementById('sidebar');
    var content = document.getElementById('content');

    openSidebarBtn.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        content.classList.toggle('open');

        if (sidebar.classList.contains('open')) {
            openSidebarBtn.innerHTML = '<i class="fa-solid fa-times"></i>';
        } else {
            openSidebarBtn.innerHTML = '<i class="fa-solid fa-bars"></i>';
        }
    });
});


/// Search users for superadmin side
document.addEventListener('DOMContentLoaded', function () {
    var searchInputAdmin = document.getElementById('searchInputAdmin');
    searchInputAdmin.addEventListener('input', function () {
        var searchText = searchInputAdmin.value.toLowerCase();
        var adminTableBody = document.getElementById('adminTableBody');
        var rows = adminTableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var name = rows[i].getElementsByTagName('td')[1].innerText.toLowerCase();
            var email = rows[i].getElementsByTagName('td')[2].innerText.toLowerCase();
        }
    });
});

//// Search bar for appointments
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function () {
        var searchText = searchInput.value.toLowerCase();
        var appointmentTableBody = document.getElementById('AppointmentTableBody');
        var rows = appointmentTableBody.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var id = rows[i].getElementsByTagName('th')[0].innerText.toLowerCase();
            var serviceName = rows[i].getElementsByTagName('td')[0].innerText.toLowerCase();
            var office = rows[i].getElementsByTagName('td')[2].innerText.toLowerCase();
        }
    });
});


//// Admin Delete SweetAlert

document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const adminId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + adminId).submit();
                }
            });
        });
    });
});

/// Create admin
const form = document.getElementById('createAdminForm');
    if (form) {
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const nameFeedback = document.getElementById('nameFeedback');
        const emailFeedback = document.getElementById('emailFeedback');
        const passwordFeedback = document.getElementById('passwordFeedback');
        const passwordConfirmationFeedback = document.getElementById('passwordConfirmationFeedback');

        form.addEventListener('submit', function(event) {
            let valid = true;

            if (passwordInput.value.length < 8) {
                valid = false;
                passwordInput.classList.add('is-invalid');
                passwordFeedback.textContent = 'Password must be at least 8 characters long.';
            } else {
                passwordInput.classList.remove('is-invalid');
                passwordFeedback.textContent = '';
            }

            if (passwordInput.value !== passwordConfirmationInput.value) {
                valid = false;
                passwordConfirmationInput.classList.add('is-invalid');
                passwordConfirmationFeedback.textContent = 'Passwords do not match.';
            } else {
                passwordConfirmationInput.classList.remove('is-invalid');
                passwordConfirmationFeedback.textContent = '';
            }

            if (!valid) {
                event.preventDefault();
            }
        });

        emailInput.addEventListener('blur', function() {
            fetch(`/check-email?email=${encodeURIComponent(emailInput.value)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        emailInput.classList.add('is-invalid');
                        emailFeedback.textContent = 'Email is already taken.';
                    } else {
                        emailInput.classList.remove('is-invalid');
                        emailFeedback.textContent = '';
                    }
                });
        });
    }

///Edit Modal
document.addEventListener('DOMContentLoaded', function () {
    var editAdminModal = document.getElementById('editAdminModal');
    if (editAdminModal) {
        editAdminModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            var email = button.getAttribute('data-email');

            var modalTitle = editAdminModal.querySelector('.modal-title');
            var modalForm = editAdminModal.querySelector('#editAdminForm');
            var modalName = editAdminModal.querySelector('#modal-name');
            var modalEmail = editAdminModal.querySelector('#modal-email');

            modalTitle.textContent = 'Edit Admin: ' + name;
            modalForm.action = `/superadmin/${id}/update`;
            modalName.value = name;
            modalEmail.value = email;
        });
    }
});

/////DropDown
document.addEventListener('DOMContentLoaded', function () {
    var dropdownToggle = document.querySelector('.dropdown-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    dropdownToggle.addEventListener('click', function () {
        dropdownMenu.classList.toggle('show');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!dropdownToggle.contains(event.target)) {
            dropdownMenu.classList.remove('show');
        }
    });
});

///////////////////////
var timeSlots = [];
for (var i = opening; i < closing; i++) {
    var start = (i < 10 ? "0" : "") + i + ":00";
    var end = (i < 10 ? "0" : "") + i + ":59";
    timeSlots.push({ start: start, end: end, count: slotsPerTime });
}

var countTimeSlots = timeSlots.length;
var slotsPerDay = slotsPerTime * countTimeSlots;

var datesArray = [];
for (var i = 0; datesArray.length < workingDays; i++) {
    var futureDate = new Date();
    futureDate.setDate(futureDate.getDate() + i);
    if (futureDate.getDay() !== 6 && futureDate.getDay() !== 0) {
        var formattedDate = futureDate.toISOString().slice(0, 10);
        datesArray.push([formattedDate, slotsPerDay]);
    }
}

var dateCounts = [];
var identifiedByCounts = [];
appointments.forEach(function (appointment) {
    var appointmentDate = new Date(appointment.booked_at);
    var formattedDate = appointmentDate.toISOString().slice(0, 10);
    var options = {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
        hour12: false,
    };

    var formattedDateTime = appointmentDate
        .toLocaleString("en-US", options)
        .replace(/\//g, "-")
        .replace(",", "");

    if (dateCounts.hasOwnProperty(formattedDate)) {
        dateCounts[formattedDate]++;
    } else {
        dateCounts[formattedDate] = 1;
    }

    identifiedByCounts[formattedDateTime] = appointmentDate;
});

var eventsArray = [];
for (var i = 0; i < datesArray.length; i++) {
    var date = datesArray[i][0];
    var count = datesArray[i][1];

    if (dateCounts.hasOwnProperty(date)) {
        count -= dateCounts[date];

        delete dateCounts[date];
    }
    eventsArray.push({
        title: count,
        start: date,
    });
}

document.addEventListener("DOMContentLoaded", function () {
    let firstNonZeroTitle = null;
    let firstNonZeroStart = null;

    eventsArray.forEach((event) => {
        if (event.title > 0 && firstNonZeroTitle === null) {
            firstNonZeroTitle = event.title;
            firstNonZeroStart = event.start;
        } else if (event.title <= 0) {
            event.color = "red";
        }
    });

    const EarliestAvailableAppointment = document.getElementById(
        "EarliestAvailableAppointment"
    );

    if (firstNonZeroTitle !== null && firstNonZeroStart !== null) {
        var appointmentDate = new Date(firstNonZeroStart);
        var formattedDate = appointmentDate.toLocaleDateString("en-US", {
            month: "long",
            day: "numeric",
            year: "numeric",
        });
        EarliestAvailableAppointment.innerHTML = `Earliest Appointment: ${formattedDate}<br> Available lots: ${firstNonZeroTitle}`;
    }
});

var appointmentsArray = [];
for (var i = 0; i < appointments.length; i++) {
    var appointmentDate = new Date(appointments[i].booked_at);
    if (appointmentDate > -new Date()) {
        appointmentsArray.push(appointments[i]);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    let previousClickedEvent = null;
    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        events: eventsArray,

        eventClick: function (info) {
            if (info.event.title === "0" || parseInt(info.event.title) < 0) {
                return false;
            }

            if (previousClickedEvent) {
                if (previousClickedEvent.style.backgroundColor !== "red") {
                    previousClickedEvent.style.backgroundColor = "";
                }
            }

            if (info.el.style.backgroundColor !== "red") {
                info.el.style.backgroundColor = "#6CB4EE";
            }
            previousClickedEvent = info.el;

            timeSlots.forEach((slot) => {
                slot.count = slotsPerTime;
            });

            formattedDate = `${info.event.start.getFullYear()}-${(
                info.event.start.getMonth() + 1
            )
                .toString()
                .padStart(2, "0")}-${info.event.start
                    .getDate()
                    .toString()
                    .padStart(2, "0")}`;

            var matchingAppointments = [];
            appointmentsArray.forEach(function (appointment) {
                var bookedDate = appointment.booked_at.split(" ")[0];
                if (bookedDate === formattedDate) {
                    matchingAppointments.push(appointment);
                }
            });

            function isTimeInRange(time, start, end) {
                return time >= start && time <= end;
            }

            matchingAppointments.forEach((appointment) => {
                var bookedTime = new Date(appointment.booked_at);
                var bookedTimeString =
                    ("0" + bookedTime.getHours()).slice(-2) +
                    ":" +
                    ("0" + bookedTime.getMinutes()).slice(-2) +
                    ":" +
                    ("0" + bookedTime.getSeconds()).slice(-2);

                timeSlots.forEach((slot) => {
                    if (isTimeInRange(bookedTimeString, slot.start, slot.end)) {
                        slot.count -= 1;
                    }
                });
            });

            var formContainer = document.getElementById("radioForm");
            formContainer.innerHTML = "";
            timeSlots.forEach(function (slot) {
                var input = document.createElement("input");
                input.setAttribute("type", "radio");
                input.setAttribute("name", "timeSlot");
                input.setAttribute("value", slot.start);
                var label = document.createElement("label");

                if (slot.count === 0 || slot.count < 0) {
                    label.textContent =
                        slot.start +
                        " - " +
                        slot.end +
                        "\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0" +
                        " Fully Booked: " +
                        "\u00A0\u00A0\u00A0" +
                        slot.count;
                    label.style.color = "red";
                    label.style.fontSize = "16px";
                    label.style.fontWeight = "bold";
                    input.setAttribute("disabled", "disabled");
                } else {
                    input.addEventListener("click", function () {
                        selectedRadioValue = this.value;
                        booked_at = formattedDate + " " + selectedRadioValue;
                    });
                    label.textContent =
                        slot.start +
                        " - " +
                        slot.end +
                        "\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0\u00A0" +
                        " Available Slots: " +
                        slot.count;
                    label.style.color = "green";
                    label.style.fontSize = "16px";
                    label.style.fontWeight = "bold";
                }
                input.style.marginRight = "5px";
                input.style.marginBottom = "15px";
                label.insertBefore(input, label.firstChild);
                formContainer.appendChild(label);
                formContainer.appendChild(document.createElement("br"));
            });

            var mediaQuery = window.matchMedia("(max-width: 768px)");
            if (mediaQuery.matches) {
                var labels = document.querySelectorAll("label");
                labels.forEach(function (label) {
                    label.style.fontSize = "13px";
                });
            }

            var existingSubmitButton = document
                .getElementById("submitButton")
                .querySelector("input[type='button']");
            if (!existingSubmitButton) {
                var submitButton = document.createElement("input");
                submitButton.setAttribute("type", "button");
                submitButton.setAttribute("value", "Submit");
                submitButton.classList.add("custom-button");

                submitButton.addEventListener("click", function () {
                    var csrfToken = document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content");
                    var service_name =
                        document.getElementById("service_name").value;
                    var service_type =
                        document.getElementById("service_type").value;
                    var office = document.getElementById("office").value;

                    var selectedRadioButton = document.querySelector(
                        'input[name="timeSlot"]:checked'
                    );

                    if (
                        (!service_name || !service_type || !office) &&
                        !selectedRadioButton
                    ) {
                        emptyAll();
                    } else if (
                        !selectedRadioButton &&
                        service_name &&
                        service_type &&
                        office
                    ) {
                        emptyTimeSlots();
                    } else if (
                        selectedRadioButton &&
                        (!service_name || !service_type || !office)
                    ) {
                        emptyServiceDetails();
                    } else {
                        confirmationOptions();
                        document.getElementById("confirmButton").addEventListener("click", function () {
                            if (confirm) {
                                var xhr = new XMLHttpRequest();
                                if (linkId === false) {
                                    xhr.open("POST", "/appointment/store", true);
                                    xhr.setRequestHeader("Content-Type", "application/json");
                                    xhr.setRequestHeader("X-CSRF-Token", csrfToken);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                console.log("ID saved in the database:", response.id);
                                                document.getElementById("appointmentId").textContent = response.id;
                                            } else {
                                                console.error("Failed to save appointment");
                                            }
                                        }
                                    };
                                    xhr.send(JSON.stringify({
                                        booked_at: booked_at,
                                        service_name: service_name,
                                        service_type: service_type,
                                        office: office,
                                    }));

                                    closeConfirmationOptions();
                                    success();

                                } else if (linkId === true) {
                                    xhr.open("POST", `/appointment/${appointmentId}/update`, true);
                                    xhr.setRequestHeader("Content-Type", "application/json");
                                    xhr.setRequestHeader("X-CSRF-Token", csrfToken);
                                    document.getElementById("appointmentId").textContent = appointmentId;

                                    xhr.send(JSON.stringify({
                                        booked_at: booked_at,
                                        service_name: service_name,
                                        service_type: service_type,
                                        office: office,
                                    }));

                                    closeConfirmationOptions();
                                    success();
                                }
                            }
                        });

                        document
                            .getElementById("cancelButton")
                            .addEventListener("click", function () {
                                location.reload();
                            });
                    }
                });

                var submitButtonDiv = document.getElementById("submitButton");
                submitButtonDiv.appendChild(submitButton);
            }
        },
    });
    calendar.render();
});
