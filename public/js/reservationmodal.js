document.addEventListener("DOMContentLoaded", function() {
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');
    const facilitiesForm = document.getElementById('facilitiesForm');
    const reservationDetailsForm = document.getElementById('reservationDetailsForm');
    const customerDetailsForm = document.getElementById('customerDetailsForm');
    const progressCircles = document.querySelectorAll('#progressCircles div');
    const storeReservationForm = document.getElementById('storeReservationForm');
    const submitButton = document.getElementById('submitButton');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const facilitiesAlert = document.getElementById('facilitiesAlert');
    const equipmentAlert = document.getElementById('equipmentAlert');
    const customerDetailsAlert = document.getElementById('customerDetailsAlert');
    
    let currentStep = 1;

    facilitiesForm.style.display = 'block';

    updateButtonText();
    updateProgressCircles();

    nextButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (validateForm()) {
            navigateNext();
            console.log("Updating review on step 2...");
                updateReview();
        }
    });

    prevButton.addEventListener('click', function(event) {
        event.preventDefault();
        navigatePrevious();
    });

    submitButton.addEventListener('click', function(event) {
        event.preventDefault();
        if (validateForm()) {
            handleSubmit();
        }
    });

    // Add this event listener to handle the Enter key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Prevent the default action (form submission)
            if (currentStep < 3) { // Only navigate if not on the last step
                if (validateForm()) {
                    navigateNext();
                }
            } else {
                if (validateForm()) {
                    handleSubmit();
                }
            }
        }
    });

    function navigateNext() {
        currentStep++;

        switch (currentStep) {
            case 2:
                facilitiesForm.style.display = 'none';
                reservationDetailsForm.style.display = 'block';
                customerDetailsForm.style.display = 'none';
                break;
            case 3:
                reservationDetailsForm.style.display = 'none';
                customerDetailsForm.style.display = 'block';
                break;
            default:
                break;
        }

        updateButtonText();
        updateProgressCircles();
    }

    function navigatePrevious() {
        if (currentStep === 1) {
            window.location.href = '/';
        } else {
            currentStep--;

            switch (currentStep) {
                case 1:
                    facilitiesForm.style.display = 'block';
                    reservationDetailsForm.style.display = 'none';
                    customerDetailsForm.style.display = 'none';
                    break;
                case 2:
                    facilitiesForm.style.display = 'none';
                    reservationDetailsForm.style.display = 'block';
                    customerDetailsForm.style.display = 'none';
                    break;
                default:
                    break;
            }

            updateButtonText();
            updateProgressCircles();
        }
    }

    function updateButtonText() {
        if (currentStep === 1) {
            prevButton.textContent = 'Back';
            nextButton.textContent = 'Next';
        } else if (currentStep === 3) {
            nextButton.style.display = 'none'; 
            submitButton.style.display = 'inline-block'; 
        } else {
            prevButton.textContent = 'Previous';
            nextButton.textContent = 'Next';
            nextButton.style.display = 'inline-block';
            submitButton.style.display = 'none';
        }
    }

    function updateProgressCircles() {
        progressCircles.forEach((circle, index) => {
            if (index < currentStep - 0) {
                circle.classList.remove('bg-gray-300');
                circle.classList.add('bg-green-950');
            } else {
                circle.classList.remove('bg-green-950');
                circle.classList.add('bg-gray-300');
            }
        });
    }


    function updateReview() {
        const selectedFacilities = Array.from(document.querySelectorAll('.form-checkbox:checked'))
            .map(checkbox => checkbox.value) // Get facilityID from the value attribute
            .join(', ');
    
        console.log("Selected Facilities IDs:", selectedFacilities);
    }
    

    function updateReview() {
        const selectedFacilities = Array.from(document.querySelectorAll('.form-checkbox:checked'))
            .map(checkbox => checkbox.value) // Get facilityID from the value attribute
            .join(', ');
        
        console.log("Selected Facilities IDs:", selectedFacilities);
    }
    
    let unavailableDatetimes = [];

// Function to update the displayed date and time selection based on unavailable datetimes
    function updateDatePicker() {
        flatpickr("#date-input", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            disable: unavailableDatetimes.map(dateTime => new Date(dateTime)), // Disable each unavailable datetime
            time_24hr: true, // Use 24-hour format if needed
        });
    }

    // Function to fetch unavailable dates based on selected facilities and event date range
    function fetchUnavailableDates() {
        const selectedFacilities = Array.from(document.querySelectorAll('.form-checkbox:checked'))
            .map(checkbox => checkbox.value)
            .join(',');
        const eventStartDate = document.getElementById('event-start-date').value;
        const eventEndDate = document.getElementById('event-end-date').value;

        // console.log("Fetching unavailable dates for facilities:", selectedFacilities, "with start date:", eventStartDate, "and end date:", eventEndDate);

        // Check that both selected facilities and date range are provided
        if (selectedFacilities && eventStartDate && eventEndDate) {
            fetch(`/api/unavailable-dates?facilityIds=${selectedFacilities}&eventStartDate=${eventStartDate}&eventEndDate=${eventEndDate}`)
                .then(response => response.json())
                .then(data => {
                    unavailableDatetimes = data.unavailableDatetimes;
                    // console.log("API returned unavailable datetimes:", unavailableDatetimes);
                    updateDatePicker();

                    const selectedStartDateObj = new Date(eventStartDate + "Z");
                    const selectedEndDateObj = new Date(eventEndDate + "Z");
                    const unavailableDateTimeObjects = unavailableDatetimes.map(dateTime => new Date(dateTime));

                    // Check if any of the unavailable datetimes fall within the selected start and end date-time range
                    const isDateTimeRangeUnavailable = unavailableDateTimeObjects.some(unavailableDateTime =>
                        unavailableDateTime >= selectedStartDateObj && unavailableDateTime <= selectedEndDateObj
                    );

                    if (isDateTimeRangeUnavailable) {
                        alert('Sorry, this date and time range is unavailable for the selected facility. Please select another range.');
                        document.getElementById('event-start-date').value = '';
                        document.getElementById('event-end-date').value = '';
                    } else {
                        // console.log('Date and time range is available.');
                    }
                })
                .catch(error => {
                    console.error('Error fetching unavailable datetimes:', error);
                    document.getElementById('date-error').textContent = 'An error occurred while fetching dates. Please try again later.';
                    document.getElementById('date-error').style.display = 'block';
                });
        }
    }

    // Attach event listeners to facility checkboxes and date inputs to fetch unavailable dates on change
    document.querySelectorAll('.form-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', fetchUnavailableDates);
    });

    document.getElementById('event-start-date').addEventListener('change', fetchUnavailableDates);
    document.getElementById('event-end-date').addEventListener('change', fetchUnavailableDates);

    
    document.querySelectorAll('.form-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', fetchUnavailableDates);
    });
    
    document.getElementById('event-start-date').addEventListener('change', fetchUnavailableDates);
    document.getElementById('event-end-date').addEventListener('change', fetchUnavailableDates);
    

    function handleSubmit() {
        const formData = new FormData(storeReservationForm);
    
        loadingSpinner.classList.remove('hidden');
    
        fetch(storeReservationForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            loadingSpinner.classList.add('hidden');
            if (data.message === 'Reservation saved successfully') {
                showModal(); // No need to pass the reservation code
            }
        })
        .catch(error => {
            loadingSpinner.classList.add('hidden');
            console.error('Error:', error);
        });
    }



    function validateForm() {
        let valid = true;
        let inputs;
    
        // Select inputs based on the current step
        switch (currentStep) {
            case 1:
                // Check for required inputs in facilitiesForm (excluding checkboxes)
                inputs = facilitiesForm.querySelectorAll('input[required]');
                if (!validateCheckboxes(facilitiesForm)) {
                    facilitiesAlert.classList.remove('hidden');
                    valid = false;
                } else {
                    facilitiesAlert.classList.add('hidden');
                }
                break;
    
            case 2:
                // Check for required inputs in reservationDetailsForm (excluding checkboxes)
                inputs = reservationDetailsForm.querySelectorAll('input[required]:not([type="checkbox"])');
                if (!validateInputs(inputs)) {
                    equipmentAlert.classList.remove('hidden'); // Show the main alert
                    valid = false;
                } else {
                    equipmentAlert.classList.add('hidden');
                }
                break;
    
            case 3:
                // Check for required inputs in customerDetailsForm (excluding checkboxes)
                 inputs = Array.from(customerDetailsForm.querySelectorAll('input[required]:not([type="checkbox"])'))
                .filter(input => input.name !== 'endorsed_by' && input.name !== 'endorser_email');
            
            if (!validateInputs(inputs)) {
                customerDetailsAlert.classList.remove('hidden');
                valid = false;
            } else {
                customerDetailsAlert.classList.add('hidden');
            }
            break;
    
            default:
                inputs = [];
        }
    
        return valid;
    }
    

    
    function validateInputs(inputs) {
        let allValid = true;
    
        inputs.forEach(input => {
            const requiredText = input.previousElementSibling; // Get the required text before the input
            const emailErrorText = input.nextElementSibling; // Get the email error message (span)
    
            if (!input.value.trim()) {
                allValid = false;
                input.classList.add('border-red-500');
    
                // Check if requiredText exists and is the required text element
                if (requiredText && requiredText.classList.contains('required-text')) {
                    requiredText.classList.remove('hidden'); // Show the required text
                }
    
                // Hide the email error message if the input is empty
                if (emailErrorText) {
                    emailErrorText.classList.add('hidden'); // Hide email error message
                }
            } else {
                input.classList.remove('border-red-500');
    
                // Check if requiredText exists and is the required text element
                if (requiredText && requiredText.classList.contains('required-text')) {
                    requiredText.classList.add('hidden'); // Hide the required text
                }
    
                // Email validation
                if (input.id === 'email' || input.id === 'endorser_email') {
                    if (!validateEmailDomain(input.value)) {
                        allValid = false;
                        input.classList.add('border-red-500'); // Add a red border if the email is invalid
                        emailErrorText.classList.remove('hidden'); // Show the custom email error message
                    } else {
                        emailErrorText.classList.add('hidden'); // Hide the email error message if valid
                    }
                } else {
                    // Hide email error message for other inputs
                    if (emailErrorText) {
                        emailErrorText.classList.add('hidden'); // Ensure it is hidden for other inputs
                    }
                }
            }
        });
    
        return allValid;
    }
    
    function validateEmailDomain(email) {
        // Check if the email ends with the allowed LSU domain
        const domain = 'lsu.edu.ph';
        const emailDomain = email.substring(email.lastIndexOf('@') + 1);
        return emailDomain.toLowerCase() === domain.toLowerCase();
    }
    
    
    function validateCheckboxes(section) {
        const checkboxes = section.querySelectorAll('input[type="checkbox"]');
        let checked = false;
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                checked = true;
            }
        });

        return checked;
    }

    
    function showModal() {
        var modal = document.getElementById('myModal');
    
        // Set the message directly in the modal        
        modal.style.display = 'block';
    }
    

    var closeBtn = document.querySelector('.close');
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        });
    }

    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    
    
});

document.querySelectorAll('.equipment-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var inputField = this.parentNode.querySelector('.equipment-input');
        if (this.checked) {
            inputField.style.display = 'inline-block';
        } else {
            inputField.style.display = 'none';
        }
    });
});


document.querySelectorAll('.personnel-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        var inputField = this.parentNode.querySelector('.personnel-input');
        if (this.checked) {
            inputField.style.display = 'inline-block';
        } else {
            inputField.style.display = 'none';
        }
    });
});

document.getElementById('other-equipment').addEventListener('change', function() {
    var nameInput = document.getElementById('other-equipment-name');
    var numberInput = document.getElementById('other-equipment-number');
    if (this.checked) {
        nameInput.style.display = 'inline-block';
        numberInput.style.display = 'inline-block';
    } else {
        nameInput.style.display = 'none';
        numberInput.style.display = 'none';
    }
});
document.getElementById('other-equipment').addEventListener('change', function () {
    const otherEquipmentName = document.getElementById('other-equipment-name');
    const otherEquipmentNumber = document.getElementById('other-equipment-number');

    if (this.checked) {
        otherEquipmentName.style.display = 'block';
        otherEquipmentNumber.style.display = 'block';
    } else {
        otherEquipmentName.style.display = 'none';
        otherEquipmentNumber.style.display = 'none';
        otherEquipmentName.value = '';
        otherEquipmentNumber.value = ''; 
    }
});



document.getElementById('other-personnel').addEventListener('change', function () {
    const otherPersonnelName = document.getElementById('other-personnel-name');
    const otherPersonnelNumber = document.getElementById('other-personnel-number');

    if (this.checked) {
        otherPersonnelName.style.display = 'block';
        otherPersonnelNumber.style.display = 'block';
    } else {
        otherPersonnelName.style.display = 'none';
        otherPersonnelNumber.style.display = 'none';
        otherPersonnelName.value = '';
        otherPersonnelNumber.value = ''; 
    }
});

function displayFiles() {
    const input = document.getElementById('attachments');
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = '';
    
    for (let i = 0; i < input.files.length; i++) {
        const file = input.files[i];
        const listItem = document.createElement('div');
        listItem.textContent = file.name;
        fileList.appendChild(listItem);
    }
}

function checkRequiredFields() {
    const requiredFields = document.querySelectorAll('.required-field');
    let allFieldsFilled = true;

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            allFieldsFilled = false;
        }
    });

    document.getElementById('captchaSection').classList.toggle('hidden', !allFieldsFilled);
}

document.querySelectorAll('.required-field').forEach(field => {
    field.addEventListener('input', checkRequiredFields);
});


document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');

    const endorserEmailInput = document.getElementById('endorser_email');

    // Email Validation
    emailInput.addEventListener('input', function() {
        const emailValue = emailInput.value;
        
        if (/^[a-zA-Z0-9._%+-]+@lsu\.edu\.ph$/.test(emailValue)) {
            emailInput.setCustomValidity(''); // Reset custom validity message
        } else {
            emailInput.setCustomValidity('Please use your LSU email address.'); // Set custom validity message
        }
    });

    endorserEmailInput.addEventListener('input', function() {
        const endorserEmailValue = endorserEmailInput.value;

        if (/^[a-zA-Z0-9._%+-]+@lsu\.edu\.ph$/.test(endorserEmailValue)) {
            endorserEmailInput.setCustomValidity(''); 
            endorserEmailInput.setCustomValidity('Please use your LSU email address.');
        }
    });
});

document.getElementById('facilitySearch').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase();
    const facilities = document.querySelectorAll('.facility-item');
    let hasVisibleFacilities = false;

    facilities.forEach(facility => {
        const facilityName = facility.querySelector('label').textContent.toLowerCase();
        if (facilityName.includes(searchValue)) {
            facility.style.display = 'block';
            hasVisibleFacilities = true;
        } else {
            facility.style.display = 'none';
        }
    });

    document.getElementById('noFacilitiesAlert').style.display = hasVisibleFacilities ? 'none' : 'block';
});


function updateEndorserFields() {
    const isStudent = document.getElementById('studentRadio').checked;
    const endorserFields = document.getElementById('endorserFields');
    const endorserEmailField = document.getElementById('endorserEmailField');
    const endorserInput = document.getElementById('endorsed_by');
    const endorserEmailInput = document.getElementById('endorser_email');

    if (isStudent) {
        endorserFields.classList.remove('hidden');
        endorserEmailField.classList.remove('hidden');
        endorserInput.setAttribute('required', 'required');
        endorserEmailInput.setAttribute('required', 'required');
        endorserInput.removeAttribute('disabled');
        endorserEmailInput.removeAttribute('disabled');
    } else {
        endorserFields.classList.add('hidden');
        endorserEmailField.classList.add('hidden');
        endorserInput.removeAttribute('required');
        endorserEmailInput.removeAttribute('required');
        endorserInput.setAttribute('disabled', 'disabled');
        endorserEmailInput.setAttribute('disabled', 'disabled');
    }
}

document.getElementById('studentRadio').addEventListener('change', updateEndorserFields);
document.getElementById('facultyRadio').addEventListener('change', updateEndorserFields);
document.getElementById('staffRadio').addEventListener('change', updateEndorserFields);


function checkEventFields() {
    const eventStartDate = document.getElementById('event-start-date').value;
    const eventEndDate = document.getElementById('event-end-date').value;

    // Show preparation and cleanup fields only if both event start and end dates are filled
    if (eventStartDate && eventEndDate) {
        document.getElementById('preparation-fields').classList.remove('hidden');
        document.getElementById('cleanup-fields').classList.remove('hidden');
    } else {
        document.getElementById('preparation-fields').classList.add('hidden');
        document.getElementById('cleanup-fields').classList.add('hidden');
    }
}

// Attach event listeners to the event date inputs to trigger the check
document.getElementById('event-start-date').addEventListener('input', checkEventFields);
document.getElementById('event-end-date').addEventListener('input', checkEventFields);

// Initial check when the page loads (in case the form is pre-filled or edited)
checkEventFields();
