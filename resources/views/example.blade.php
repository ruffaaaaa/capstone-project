<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facility Booking</title>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        /* Basic styling for form steps */
        .form-step {
            display: none;
        }
        .form-step.active {
            display: block;
        }
        /* Styling for navigation buttons at the bottom */
        .navigation-buttons {
            position: fixed;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
        }
        .navigation-buttons button {
            margin: 0 10px;
        }
        /* Error message styling */
        .error-message {
            color: red;
            font-weight: bold;
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Facility Booking</h1>
    <form id="facility-form">
        <!-- Step 1: Select Facilities -->
        <div class="form-step active" id="step-1">
            <h2>Select Facilities</h2>
            @foreach($facilities as $facility)
                <div>
                    <input type="checkbox" id="facility-{{ $facility->facilityID }}" value="{{ $facility->facilityID }}" class="facility-checkbox">
                    <label for="facility-{{ $facility->facilityID }}">{{ $facility->facilityName }}</label>
                </div>
            @endforeach
        </div>

        <!-- Step 2: Select Event Start Date -->
        <div class="form-step" id="step-2">
            <h2>Event Start Date</h2>
            <input type="datetime-local" id="event-start-date">
        </div>

        <!-- Step 3: Review and Submit -->
        <div class="form-step" id="step-3">
            <h2>Review & Submit</h2>
            <p><strong>Selected Facilities:</strong> <span id="selected-facilities"></span></p>
            <p><strong>Event Start Date:</strong> <span id="selected-date"></span></p>
        </div>
    </form>

    <!-- Separate Navigation Buttons -->
    <div class="navigation-buttons">
        <button type="button" onclick="previousStep()" id="prevBtn" style="display:none;">Previous</button>
        <button type="button" onclick="nextStep()" id="nextBtn">Next</button>
    </div>

    <script>
        let unavailableDates = [];
        let currentStep = 1;
        const totalSteps = 3;

        function showStep(step) {
            console.log("Showing step:", step);
            document.querySelectorAll('.form-step').forEach((element, index) => {
                element.classList.toggle('active', index + 1 === step);
            });
            updateButtons();
        }

        function nextStep() {
            if (currentStep === 2) {
                console.log("Updating review on step 2...");
                updateReview();
            }
            if (currentStep < totalSteps) {
                currentStep++;
                console.log("Advancing to step:", currentStep);
                showStep(currentStep);
            }
        }

        function previousStep() {
            if (currentStep > 1) {
                currentStep--;
                console.log("Going back to step:", currentStep);
                showStep(currentStep);
            }
        }

        function updateButtons() {
            console.log("Updating buttons. Current step:", currentStep);
            document.getElementById('prevBtn').style.display = currentStep > 1 ? 'inline' : 'none';
            document.getElementById('nextBtn').textContent = currentStep === totalSteps ? 'Submit' : 'Next';
            document.getElementById('nextBtn').setAttribute("type", currentStep === totalSteps ? "submit" : "button");
        }

        function updateReview() {
            const selectedFacilities = Array.from(document.querySelectorAll('.facility-checkbox:checked'))
                .map(checkbox => checkbox.nextElementSibling.innerText)
                .join(', ');
            const eventStartDate = document.getElementById('event-start-date').value;

            console.log("Selected Facilities:", selectedFacilities);
            console.log("Event Start Date:", eventStartDate);

            document.getElementById('selected-facilities').textContent = selectedFacilities || 'None';
            document.getElementById('selected-date').textContent = eventStartDate || 'Not selected';
        }

        function updateDatePicker() {
            flatpickr("#date-input", {
                enable: [], // Allow all dates initially
                disable: unavailableDates.map(date => new Date(date)), // Disable unavailable dates
            });
        }

        function fetchUnavailableDates() {
            const selectedFacilities = Array.from(document.querySelectorAll('.facility-checkbox:checked'))
                .map(checkbox => checkbox.value)
                .join(',');
            const eventStartDate = document.getElementById('event-start-date').value;

            console.log("Fetching unavailable dates for facilities:", selectedFacilities, "and date:", eventStartDate);

            if (selectedFacilities && eventStartDate) {
                fetch(`/api/unavailable-dates?facilityIds=${selectedFacilities}&eventStartDate=${eventStartDate}`)
                    .then(response => response.json())
                    .then(data => {
                        unavailableDates = data.unavailableDates;
                        console.log("API returned unavailable dates:", unavailableDates);
                        updateDatePicker();

                        // Check if the selected date is unavailable
                        const selectedDateObj = new Date(eventStartDate + "Z");
                        const unavailableDateObjects = unavailableDates.map(date => new Date(date));
                        const isDateUnavailable = unavailableDateObjects.some(unavailableDate =>
                            unavailableDate.getTime() === selectedDateObj.getTime()
                        );

                        if (isDateUnavailable) {
                        alert('Sorry, this date is unavailable for the selected facility. Please select another date.');
                        document.getElementById('event-start-date').value = ''; // Clear the date input
                        } else {
                        console.log('Date is available.');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching unavailable dates:', error);
                        document.getElementById('date-error').textContent = 'An error occurred while fetching dates. Please try again later.';
                        document.getElementById('date-error').style.display = 'block';
                    });
            }
        }

        document.querySelectorAll('.facility-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', fetchUnavailableDates);
        });

        document.getElementById('event-start-date').addEventListener('change', fetchUnavailableDates);

        showStep(currentStep); 
    </script>
</body>
</html>
