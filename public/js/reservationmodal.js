document.addEventListener("DOMContentLoaded", function() {
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');
    const facilitiesForm = document.getElementById('facilitiesForm');
    const reservationDetailsForm = document.getElementById('reservationDetailsForm');
    const progressCircles = document.querySelectorAll('#progressCircles div');
    const storeReservationForm = document.getElementById('storeReservationForm');
    const submitButton = document.getElementById('submitButton');
    const checkbox = document.querySelector('.equipment-checkbox');
    const inputField = document.querySelector('.equipment-input');

    let currentStep = 1;

    facilitiesForm.style.display = 'block';

    updateButtonText();
    updateProgressCircles();

    nextButton.addEventListener('click', function() {
        navigateNext();
    });

    prevButton.addEventListener('click', function() {
        navigatePrevious();
    });

    submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        handleSubmit();
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
            nextButton.style.display = 'none'; // Hide next button
            submitButton.style.display = 'inline-block'; // Show submit button
        } else {
            prevButton.textContent = 'Previous';
            nextButton.textContent = 'Next';
            nextButton.style.display = 'inline-block'; // Show next button
            submitButton.style.display = 'none'; // Hide submit button
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
            if (data.message === 'Reservation saved successfully') {
                showModal(data.reservationCode);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function showModal(reservationCode) {
        var modal = document.getElementById('myModal');
        var reservationCodeSpan = document.getElementById('reservation-code');
        reservationCodeSpan.textContent = 'Reservation Code: ' + reservationCode;
        modal.style.display = 'block';
    }

    var closeBtn = document.querySelector('.close');
    closeBtn.addEventListener('click', function() {
        var modal = document.getElementById('myModal');
        modal.style.display = 'none';
    });

    window.onclick = function(event) {
        var modal = document.getElementById('myModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
});

// Add event listeners to equipment checkboxes
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

// Add event listeners to personnel checkboxes
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

// Add event listener to "Other, please specify" checkboxes for equipment and personnel
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

document.getElementById('other-personnel').addEventListener('change', function() {
    var nameInput = document.getElementById('other-personnel-name');
    var numberInput = document.getElementById('other-personnel-number');
    if (this.checked) {
        nameInput.style.display = 'inline-block';
        numberInput.style.display = 'inline-block';
    } else {
        nameInput.style.display = 'none';
        numberInput.style.display = 'none';
    }
});

function displayFiles() {
    const input = document.getElementById('attachments');
    const fileList = document.getElementById('fileList');
    fileList.innerHTML = ''; // Clear the previous file list
    
    for (let i = 0; i < input.files.length; i++) {
        const file = input.files[i];
        const listItem = document.createElement('div');
        listItem.textContent = file.name;
        fileList.appendChild(listItem);
    }
}
