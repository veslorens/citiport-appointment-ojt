
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
    Swal.fire({
        title: 'Empty Form',
        text: 'Please fill in all fields.',
        icon: 'error',
        confirmButtonText: 'OK'
    });
}


function emptyTimeSlots() {
    Swal.fire({
        title: 'Empty Time Slots!',
        text: 'Please select a time slot.',
        icon: 'error',
        confirmButtonText: 'OK'
    });
}

function emptyServiceDetails() {
    Swal.fire({
        title: 'Empty Service Details',
        text: 'Please complete service details before proceeding.',
        icon: 'warning',
        confirmButtonText: 'OK',
    });
}



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

                    var client_name;
                    var client_contact_no;
                    var currentUrl = window.location.href;
                    console.log(currentUrl);
                    var queryString = currentUrl.slice(currentUrl.indexOf('?') + 1);
                    var paramsArray = queryString.split('&');

                    paramsArray.forEach(function (param) {
                        try {
                            var pair = param.split('=');
                            var key = pair[0];
                            var value = decodeURIComponent(pair[1].replace(/\+/g, ' '));
                            if (key === "client_name") {
                                client_name = value.replace(/"/g, '');
                            } else if (key === "client_contact_no") {
                                client_contact_no = value.replace(/"/g, '');
                            }
                        } catch (error) {
                            // Handle error by setting the respective variable to null
                            if (key === "client_name") {
                                client_name = null;
                            } else if (key === "client_contact_no") {
                                client_contact_no = null;
                            }
                            console.error("Error decoding parameter:", error);
                        }
                    });

                    console.log("Client Name:", client_name);
                    console.log("Client Contact Number:", client_contact_no);

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
                        Swal.fire({
                            title: "Do you want to save the changes?",
                            showCancelButton: true,
                            confirmButtonText: "Save",
                            cancelButtonText: "Cancel",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var xhr = new XMLHttpRequest();
                                if (linkId === false) {
                                    xhr.open("POST", "/appointment/store", true);
                                    xhr.setRequestHeader("Content-Type", "application/json");
                                    xhr.setRequestHeader("X-CSRF-Token", csrfToken);
                                    xhr.onreadystatechange = function () {
                                        if (xhr.readyState === XMLHttpRequest.DONE) {
                                            if (xhr.status === 200) {
                                                var response = JSON.parse(xhr.responseText);
                                                var savedId = response.id;
                                                console.log("ID saved in the database:", savedId);
                                                document.getElementById("appointmentId").textContent = savedId;
                                                Swal.fire("Saved!", `Reference ID: ${savedId}`, "success")
                                                    .then(() => {
                                                        location.reload();
                                                    });
                                            }
                                        }
                                    };

                                    xhr.send(JSON.stringify({
                                        booked_at: booked_at,
                                        service_name: service_name,
                                        service_type: service_type,
                                        office: office,
                                        client_name: client_name,
                                        client_contact_no: client_contact_no,
                                    }));

                                } else if (linkId === true) {
                                    xhr.open("POST", `/appointment/${appointmentId}/update`, true);
                                    xhr.setRequestHeader("Content-Type", "application/json");
                                    xhr.setRequestHeader("X-CSRF-Token", csrfToken);
                                    var savedId = appointmentId
                                    console.log("ID saved in the database:", savedId);
                                    document.getElementById("appointmentId").textContent = savedId;
                                    Swal.fire("Saved!", `Reference ID: ${savedId}`, "success")
                                        .then(() => {
                                            location.reload();
                                        });
                                    xhr.send(JSON.stringify({
                                        booked_at: booked_at,
                                        service_name: service_name,
                                        service_type: service_type,
                                        office: office,
                                        client_name: client_name,
                                        client_contact_no: client_contact_no,
                                    }));
                                }
                            } else {
                                Swal.fire("Changes are not saved", "", "info");
                                window.location.reload();
                            }
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
