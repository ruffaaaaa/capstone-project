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
                inputs = customerDetailsForm.querySelectorAll('input[required]:not([type="checkbox"])');
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
    
            if (!input.value.trim()) {
                allValid = false;
                input.classList.add('border-red-500');
    
                // Check if requiredText exists and is the required text element
                if (requiredText && requiredText.classList.contains('required-text')) {
                    requiredText.classList.remove('hidden'); // Show the required text
                }
            } else {
                input.classList.remove('border-red-500');
    
                // Check if requiredText exists and is the required text element
                if (requiredText && requiredText.classList.contains('required-text')) {
                    requiredText.classList.add('hidden'); // Hide the required text
                }
            }
        });
        
        return allValid;
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


