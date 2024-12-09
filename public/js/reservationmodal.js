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

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); 
            if (currentStep < 3) { 
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
            .map(checkbox => checkbox.value)
            .join(', ');
    
        console.log("Selected Facilities IDs:", selectedFacilities);
    }
    
    function updateReview() {
        const selectedFacilities = Array.from(document.querySelectorAll('.form-checkbox:checked'))
            .map(checkbox => checkbox.value) 
            .join(', ');
        
        console.log("Selected Facilities IDs:", selectedFacilities);
    }
    
    function fetchUnavailableDates() {
        const selectedFacilities = Array.from(document.querySelectorAll('.form-checkbox:checked'))
            .map(checkbox => checkbox.value)
            .join(',');
        const eventStartDate = document.getElementById('event-start-date').value;
        const eventEndDate = document.getElementById('event-end-date').value;
        const preparationStartDate = document.getElementById('preparation-start-date')?.value;
        const preparationEndDate = document.getElementById('preparation-end-date')?.value;
        const cleanupStartDate = document.getElementById('cleanup-start-date')?.value;
        const cleanupEndDate = document.getElementById('cleanup-end-date')?.value;
    
        if (selectedFacilities && (eventStartDate || preparationStartDate || cleanupStartDate)) {
            fetch(`/api/unavailable-dates?facilityIds=${selectedFacilities}&eventStartDate=${eventStartDate}&eventEndDate=${eventEndDate}&preparationStartDate=${preparationStartDate}&preparationEndDate=${preparationEndDate}&cleanupStartDate=${cleanupStartDate}&cleanupEndDate=${cleanupEndDate}`)
                .then(response => response.json())
                .then(data => {
                    const unavailableDatetimes = data.unavailableDatetimes || [];
                    const unavailableTimes = unavailableDatetimes.map(item => ({
                        startDate: new Date(item.reservation_detail.event_start_date),
                        endDate: new Date(item.reservation_detail.event_end_date),
                        preparationStartDate: item.reservation_detail.preparation_start_date ? new Date(item.reservation_detail.preparation_start_date) : null,
                        preparationEndDate: item.reservation_detail.preparation_end_date_time ? new Date(item.reservation_detail.preparation_end_date_time) : null,
                        cleanupStartDate: item.reservation_detail.cleanup_start_date_time ? new Date(item.reservation_detail.cleanup_start_date_time) : null,
                        cleanupEndDate: item.reservation_detail.cleanup_end_date_time ? new Date(item.reservation_detail.cleanup_end_date_time) : null,
                    }));
    
                    const selectedStartDateObj = eventStartDate ? new Date(eventStartDate) : null;
                    const selectedEndDateObj = eventEndDate ? new Date(eventEndDate) : null;
    
                    const isDateTimeRangeUnavailable = unavailableTimes.some(unavailable => (
                        // Event overlaps
                        (selectedStartDateObj && selectedEndDateObj &&
                            ((selectedStartDateObj.getTime() >= unavailable.startDate.getTime() && selectedStartDateObj.getTime() <= unavailable.endDate.getTime()) ||
                            (selectedEndDateObj.getTime() >= unavailable.startDate.getTime() && selectedEndDateObj.getTime() <= unavailable.endDate.getTime()) ||
                            (selectedStartDateObj.getTime() <= unavailable.startDate.getTime() && selectedEndDateObj.getTime() >= unavailable.endDate.getTime()))) ||
    
                        // Preparation overlaps
                        (preparationStartDate && preparationEndDate &&
                            unavailable.preparationStartDate && unavailable.preparationEndDate &&
                            ((new Date(preparationStartDate).getTime() >= unavailable.preparationStartDate.getTime() && new Date(preparationStartDate).getTime() <= unavailable.preparationEndDate.getTime()) ||
                            (new Date(preparationEndDate).getTime() >= unavailable.preparationStartDate.getTime() && new Date(preparationEndDate).getTime() <= unavailable.preparationEndDate.getTime()))) ||
    
                        // Cleanup overlaps
                        (cleanupStartDate && cleanupEndDate &&
                            unavailable.cleanupStartDate && unavailable.cleanupEndDate &&
                            ((new Date(cleanupStartDate).getTime() >= unavailable.cleanupStartDate.getTime() && new Date(cleanupStartDate).getTime() <= unavailable.cleanupEndDate.getTime()) ||
                            (new Date(cleanupEndDate).getTime() >= unavailable.cleanupStartDate.getTime() && new Date(cleanupEndDate).getTime() <= unavailable.cleanupEndDate.getTime())))
                    ));
    
                    if (isDateTimeRangeUnavailable) {
                        alert('Sorry, this date and time range is unavailable. Please select another range.');
                        resetFields();
                    }
                })
                .catch(error => {
                    console.error('Error fetching unavailable dates:', error);
                    const dateErrorElement = document.getElementById('date-error');
                    if (dateErrorElement) {
                        dateErrorElement.textContent = 'An error occurred while fetching dates. Please try again later.';
                        dateErrorElement.style.display = 'block';
                    }
                    resetFields();
                });
        }
    }
    
    function resetFields() {
        const fieldsToReset = [
            'event-start-date',
            'event-end-date',
            'preparation-start-date',
            'preparation-end-date',
            'cleanup-start-date',
            'cleanup-end-date',
        ];
    
        fieldsToReset.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.value = '';
            }
        });
    }

    document.querySelectorAll('.form-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', fetchUnavailableDates);
    });

    document.getElementById('event-start-date').addEventListener('change', fetchUnavailableDates);
    document.getElementById('event-end-date').addEventListener('change', fetchUnavailableDates);
    document.getElementById('preparation-start-date')?.addEventListener('change', fetchUnavailableDates);
    document.getElementById('preparation-end-date')?.addEventListener('change', fetchUnavailableDates);
    document.getElementById('cleanup-start-date')?.addEventListener('change', fetchUnavailableDates);
    document.getElementById('cleanup-end-date')?.addEventListener('change', fetchUnavailableDates);
    
    function handleSubmit() {
        const formData = new FormData(storeReservationForm);
        const controller = new AbortController();
        const signal = controller.signal;
    
        loadingSpinner.classList.remove('hidden');
    
        const timeout = setTimeout(() => {
            controller.abort(); 
            loadingSpinner.classList.add('hidden');
            alert('The request took too long. Please check your email for your reservation code instead.');
            window.location.href = '/';
        }, 30000); 
    
        fetch(storeReservationForm.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json',
            },
            body: formData,
            signal, 
        })
        .then(response => {
            clearTimeout(timeout); 
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            loadingSpinner.classList.add('hidden');
            if (data.message === 'Reservation saved successfully') {
                showModal();
            } else {
                alert('An error occurred: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            clearTimeout(timeout); 
            loadingSpinner.classList.add('hidden');
    
            if (error.name === 'AbortError') {
                console.error('Fetch request was aborted:', error);
            } else {
                console.error('Error:', error);
                alert('An error occurred while processing your request. Please try again.');
            }
        });
    }

    let isArtCenterSelected = false;

    function validateForm() {
        let valid = true;
        let inputs;

        facilitiesAlert.classList.add('hidden');
        equipmentAlert.classList.add('hidden');
        customerDetailsAlert.classList.add('hidden');
        radioErrorText.classList.add('hidden');
        captchaErrorText.classList.add('hidden');
        endorserError.classList.add('hidden');
        endorserEmailError.classList.add('hidden');
        attachmentErrorText.classList.add('hidden');  

        function addAlertListeners(input, alertElement) {
            input.addEventListener('focus', () => alertElement.classList.remove('hidden'));
            input.addEventListener('input', () => {
                if (input.value.trim()) {
                    alertElement.classList.add('hidden');
                }
            });
        }

        switch (currentStep) {
            case 1:  
                
                const artCenterCheckbox = document.querySelector('input[data-name="Art Center"]:checked');
                isArtCenterSelected = !!artCenterCheckbox;  
                console.log('Art Center Selected:', isArtCenterSelected);  

                inputs = facilitiesForm.querySelectorAll('input[required]');
                if (!validateCheckboxes(facilitiesForm)) {
                    facilitiesAlert.classList.remove('hidden');
                    valid = false;
                } else {
                    facilitiesAlert.classList.add('hidden');
                }
                break;

            case 2:  
                inputs = reservationDetailsForm.querySelectorAll('input[required]:not([type="checkbox"])');
                
                if (isArtCenterSelected) {
                    const fileList = document.getElementById('fileList');
                    
                    const files = document.getElementById('attachments').files;
                    console.log('Files Selected:', files.length);  

                    if (files.length === 0) {  
                        attachmentErrorText.classList.remove('hidden');
                        valid = false;
                    } else {
                        attachmentErrorText.classList.add('hidden');
                    }
                } else {
                  
                    attachmentErrorText.classList.add('hidden');
                }

                if (inputs.length && !validateInputs(inputs)) {
                    equipmentAlert.classList.remove('hidden');
                    valid = false;
                    inputs.forEach(input => addAlertListeners(input, equipmentAlert));
                }
                break;

            case 3:  
                inputs = Array.from(customerDetailsForm.querySelectorAll('input[required]:not([type="checkbox"])'))
                    .filter(input => input.name !== 'endorsed_by' && input.name !== 'endorser_email');

                if (inputs.length && !validateInputs(inputs)) {
                    customerDetailsAlert.classList.remove('hidden');
                    valid = false;
                    inputs.forEach(input => addAlertListeners(input, customerDetailsAlert));
                }


                const isUserNeedingEndorser =
                    document.getElementById('studentRadio').checked ||
                    document.getElementById('facultyRadio').checked ||
                    document.getElementById('staffRadio').checked;

                const endorserInput = document.getElementById('endorsed_by');
                const endorserEmailInput = document.getElementById('endorser_email');

                const radioErrorText = document.getElementById('radioErrorText');
                if (!document.querySelector('input[name="userType"]:checked')) {
                    radioErrorText.classList.remove('hidden');
                    valid = false;
                } else {
                    radioErrorText.classList.add('hidden');
                }

                if (isUserNeedingEndorser) {

                    if (!endorserInput.value.trim()) {
                        endorserError.classList.remove('hidden');
                        valid = false;
                        addAlertListeners(endorserInput, endorserError);
                    }

                    if (!endorserEmailInput.value.trim()) {
                        endorserEmailError.classList.remove('hidden');
                        valid = false;
                        addAlertListeners(endorserEmailInput, endorserEmailError);
                    }

                    if (!validateEmails()) {
                        valid = false; 
                    }
                }

      
                if (grecaptcha.getResponse().length === 0) {
                    captchaErrorText.classList.remove('hidden');
                    valid = false;
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
            const requiredText = input.previousElementSibling; 
            const emailErrorText = input.nextElementSibling; 
    
            if (!input.value.trim()) {
                allValid = false;
                input.classList.add('border-red-500');
    
                if (requiredText && requiredText.classList.contains('required-text')) {
                    requiredText.classList.remove('hidden'); 
                }
    
                if (emailErrorText) {
                    emailErrorText.classList.add('hidden'); 
                }
            } else {
                input.classList.remove('border-red-500');
    
                if (requiredText && requiredText.classList.contains('required-text')) {
                    requiredText.classList.add('hidden'); 
                }
    
                if (input.id === 'email' || input.id === 'endorser_email') {
                    if (!validateEmailDomain(input.value)) {
                        allValid = false;
                        input.classList.add('border-red-500'); 
                        emailErrorText.classList.remove('hidden'); 
                    } else {
                        emailErrorText.classList.add('hidden'); 
                    }
                } else {
                    if (emailErrorText) {
                        emailErrorText.classList.add('hidden'); 
                    }
                }
            }
        });
    
        return allValid;
    }

    function updateEndorserFields() {
        const isUserNeedingEndorser = 
            document.getElementById('studentRadio').checked || 
            document.getElementById('facultyRadio').checked || 
            document.getElementById('staffRadio').checked;
    
        const endorserFields = document.getElementById('endorserFields');
        const endorserEmailField = document.getElementById('endorserEmailField');
        const endorserInput = document.getElementById('endorsed_by');
        const endorserEmailInput = document.getElementById('endorser_email');
    
        if (isUserNeedingEndorser) {
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
    
    
    function validateEmailDomain(email) {
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

document.addEventListener('DOMContentLoaded', function() {
    const emailInput = document.getElementById('email');
    const endorserEmailInput = document.getElementById('endorser_email');
    
    emailInput.addEventListener('input', function() {
        const emailValue = emailInput.value;
        
        if (/^[a-zA-Z0-9._%+-]+@lsu\.edu\.ph$/.test(emailValue)) {
            emailInput.setCustomValidity(''); 
        } else {
            emailInput.setCustomValidity('Please use your LSU email address.'); 
        }
    });

    endorserEmailInput.addEventListener('input', function() {
        const endorserEmailValue = endorserEmailInput.value;
        const emailErrorText = endorserEmailInput.nextElementSibling; 
        
        if (/^[a-zA-Z0-9._%+-]+@lsu\.edu\.ph$/.test(endorserEmailValue)) {
            endorserEmailInput.setCustomValidity(''); 
            emailErrorText.classList.add('hidden');  
        } else {
            endorserEmailInput.setCustomValidity('Please use your LSU email address.');
            emailErrorText.classList.remove('hidden'); 
        }
    });
});

function validateEmails() {
    const emailInput = document.getElementById('email');
    const endorserEmailInput = document.getElementById('endorser_email');

    const emailValue = emailInput.value.trim();
    const endorserEmailValue = endorserEmailInput.value.trim();

    if (emailValue && endorserEmailValue && emailValue === endorserEmailValue) {
        alert("Email and Endorser Email must be different.");
        endorserEmailInput.classList.add('border-red-500');
        return false;
    }

    endorserEmailInput.classList.remove('border-red-500');
    return true;
}

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
    const otherEquipmentNameInput = document.getElementById('other-equipment-name');
    const otherEquipmentNumberInput = document.getElementById('other-equipment-number');
    if (this.checked) {
        otherEquipmentNameInput.style.display = 'block';
        otherEquipmentNumberInput.style.display = 'block';
    } else {
        otherEquipmentNameInput.style.display = 'none';
        otherEquipmentNumberInput.style.display = 'none';
    }
});

document.getElementById('other-personnel').addEventListener('change', function() {
    const otherPersonnelNameInput = document.getElementById('other-personnel-name');
    const otherPersonnelNumberInput = document.getElementById('other-personnel-number');
    if (this.checked) {
        otherPersonnelNameInput.style.display = 'block';
        otherPersonnelNumberInput.style.display = 'block';
    } else {
        otherPersonnelNameInput.style.display = 'none';
        otherPersonnelNumberInput.style.display = 'none';
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





